
<div class="container-map">
    <div id="map"></div>
</div>

<!-- Leaflet & Dependencies -->
<script src="{{ asset('js/qgis2web_expressions.js') }}"></script>
<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/leaflet.rotatedMarker.js') }}"></script>
<script src="{{ asset('js/leaflet.pattern.js') }}"></script>
<script src="{{ asset('js/Autolinker.min.js') }}"></script>
<script src="{{ asset('js/rbush.min.js') }}"></script>
<script src="{{ asset('js/labelgun.min.js') }}"></script>
<script src="{{ asset('js/labels.js') }}"></script>
<script src="{{ asset('js/leaflet-search.js') }}"></script>
<script src="{{ asset('js/L.Control.Locate.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. Konfigurasi Map & Tile Layer ---
        var map = L.map('map', {
            zoomControl: true, 
            maxZoom: 28, 
            minZoom: 10
        });

        // Set default view (will be updated when data loads)
        map.setView([-6.9175, 107.6191], 10); // Default Bandung

        var osmLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        L.control.locate({locateOptions: {maxZoom: 19}}).addTo(map);

        // --- 2. Data dari Backend (Profil Lembaga & Active Kecamatan) ---
        // List nama kecamatan yang aktif di database (Normalized untuk matching)
        var activeKecamatanNames = [
            @foreach($kecamatan as $k)
                "{{ strtoupper(trim($k->nama_kecamatan)) }}",
            @endforeach
        ];

        var cityId = "{{ $profil_lembaga->city_id ?? '' }}"; 
        
        // Remove Dot if exists (clean numeric ID)
        cityId = cityId.replace('.', '');
        
        console.log("Loading Map for City ID:", cityId);

        // --- 3. Fungsi Style & Interaction ---
        function styleFeature(feature) {
            return {
                opacity: 1,
                color: 'rgba(35,35,35,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1.0, 
                fill: true,
                fillOpacity: 0.6,
                fillColor: 'rgba(163,163,163,1.0)', // Default Gray
                interactive: true,
            }
        }

        var highlightLayer;
        function highlightFeature(e) {
            highlightLayer = e.target;
            highlightLayer.setStyle({
                fillColor: '#ffff00',
                fillOpacity: 0.8
            });
        }

        function resetHighlight(e) {
            e.target.setStyle(styleFeature(e.target.feature));
        }

        function processGeoJson(data) {
             // Debug Names
             console.log("Active Database Names:", activeKecamatanNames);
             
             // Mark features as Active/Inactive instead of removing them
             data.features.forEach(feature => {
                var props = feature.properties;
                // Normalize: Check standard keys
                var geoKecName = (props.NAMOBJ || props.WADMKC || props.MAMA_KEC || props.KECAMATAN || props.kecamatan || "").toUpperCase().trim();
                
                // Try fuzzy match if exact match fails
                var cleanGeo = geoKecName.replace(/[\s\-_]/g, '');
                var isActive = activeKecamatanNames.some(dbName => {
                    var cleanDb = dbName.replace(/[\s\-_]/g, '');
                    return cleanDb === cleanGeo || cleanDb.includes(cleanGeo) || cleanGeo.includes(cleanDb);
                });

                feature.properties.MATCHED_NAME = geoKecName; 
                feature.properties.IS_ACTIVE = isActive;
                
                if(isActive) {
                    console.log("Matched:", geoKecName);
                } else {
                    console.log("Unmatched Geo Name:", geoKecName);
                }
            });

            // We do NOT filter data.features anymore, so map always shows full city.
            // data.features = filteredFeatures; 

            var geoJsonLayer = L.geoJson(data, {
                style: function(feature) {
                    if (feature.properties.IS_ACTIVE) {
                        return styleFeature(feature); // Active Style
                    } else {
                        // Inactive Style (Grayed out)
                        return {
                            opacity: 1,
                            color: 'rgba(200,200,200,1.0)',
                            weight: 1, 
                            fill: true,
                            fillOpacity: 0.3, 
                            fillColor: 'rgba(240,240,240,1.0)',
                            interactive: true // Now Clickable!
                        };
                    }
                },
                onEachFeature: function(feature, layer) {
                    // All features are now interactive

                    layer.on({
                        mouseover: highlightFeature,
                        mouseout: resetHighlight,
                        click: function(e) {
                            var clickedName = feature.properties.MATCHED_NAME;
                            
                            var found = false;

                            // 1. Admin/KCD Mode (Redirect to Detail)
                            if (typeof isAdmin !== 'undefined' && isAdmin && typeof kecamatanMap !== 'undefined') {
                                var dbId = kecamatanMap[clickedName];
                                if(!dbId) {
                                    var cleanClicked = clickedName.replace(/[\s\-_]/g, '');
                                    Object.keys(kecamatanMap).forEach(key => {
                                        var cleanKey = key.replace(/[\s\-_]/g, '');
                                        if(cleanKey === cleanClicked || cleanKey.includes(cleanClicked) || cleanClicked.includes(cleanKey)) {
                                            dbId = kecamatanMap[key];
                                        }
                                    });
                                }

                                if(dbId) {
                                    window.location.href = "/kcd/kecamatan/" + dbId + "/sekolah";
                                    return; // Stop here
                                } else {
                                    // Alert only if actively clicking an unknown district
                                    alert("Kecamatan " + clickedName + " belum terdaftar di sistem.");
                                    return;
                                }
                            }

                            // 2. Guest Mode (Show Popup with School Dropdown)
                            // We need to resolve the DB ID first (Same logic as Admin)
                            var dbId = undefined;
                            if (typeof kecamatanMap !== 'undefined') {
                                dbId = kecamatanMap[clickedName];
                                if(!dbId) {
                                    var cleanClicked = clickedName.replace(/[\s\-_]/g, '');
                                    Object.keys(kecamatanMap).forEach(key => {
                                        var cleanKey = key.replace(/[\s\-_]/g, '');
                                        if(cleanKey === cleanClicked || cleanKey.includes(cleanClicked) || cleanClicked.includes(cleanKey)) {
                                            dbId = kecamatanMap[key];
                                        }
                                    });
                                }
                            }

                            if(!dbId) {
                                console.warn("District ID not found for Name:", clickedName);
                                return; // Cannot fetch schools without ID
                            }

                            // Fetch Schools for this District
                            fetch(`/api/kecamatan/${dbId}/sekolah`)
                                .then(res => res.json())
                                .then(schools => {
                                    if(schools.length === 0) {
                                        layer.bindPopup(`<strong>${feature.properties.MATCHED_NAME}</strong><br>Belum ada data sekolah.`).openPopup();
                                        return;
                                    }

                                    // Build Dropdown HTML
                                    var html = `<div style="min-width: 200px;">
                                        <strong>${feature.properties.MATCHED_NAME}</strong><hr style="margin: 5px 0;">
                                        <select class="form-select form-select-sm school-popup-select" data-target="detail-${dbId}" style="width:100%">
                                            <option value="">-- Pilih Sekolah --</option>`;
                                    
                                    schools.forEach(s => {
                                        html += `<option value="${s.id}">${s.nama}</option>`;
                                    });

                                    html += `</select>
                                        <div id="detail-${dbId}" style="margin-top: 10px; font-size: 0.9em;"></div>
                                    </div>`;

                                    layer.bindPopup(html).openPopup();
                                })
                                .catch(err => console.error("Error fetching schools:", err));
                        }
                    });
                    
                    layer.bindTooltip(feature.properties.MATCHED_NAME, {
                        permanent: false, 
                        direction: 'center',
                        className: 'map-label'
                    });
                }
            }).addTo(map);

            // Re-enable fitBounds with safety
            if (data.features.length > 0) {
                try {
                    var bounds = geoJsonLayer.getBounds();
                    if (bounds.isValid()) {
                        map.fitBounds(bounds);
                    }
                } catch(e) {
                    console.warn("FitBounds failed:", e);
                }
            }
        }

        // --- Event Delegation for Popup Interaction ---
        document.addEventListener('change', function(e) {
            if(e.target && e.target.classList.contains('school-popup-select')) {
                var schoolId = e.target.value;
                var targetId = e.target.getAttribute('data-target');
                var targetDiv = document.getElementById(targetId);

                if(!schoolId) {
                    if(targetDiv) targetDiv.innerHTML = '';
                    return;
                }

                if(targetDiv) {
                    targetDiv.innerHTML = '<em>Loading...</em>';
                    
                    fetch(`/getsekolah/${schoolId}`)
                        .then(r => r.json())
                        .then(s => {
                            var detailHtml = `
                                <div class="card card-body p-2 bg-light">
                                    <h6 class="mb-2 text-center" style="font-size: 1em;"><strong>${s.nama}</strong></h6>
                                    <table class="table table-sm table-borderless mb-0" style="font-size: 0.85em;">
                                        <tr><td class="p-0 pe-2"><strong>NPSN</strong></td><td class="p-0">: ${s.npsn || '-'}</td></tr>
                                        <tr><td class="p-0 pe-2"><strong>Kepala Sekolah</strong></td><td class="p-0">: ${s.kepala_sekolah || '-'}</td></tr>
                                        <tr><td class="p-0 pe-2"><strong>Alamat</strong></td><td class="p-0">: ${s.alamat || '-'}</td></tr>
                                        <tr><td class="p-0 pe-2"><strong>No. Telp</strong></td><td class="p-0">: ${s.telepon || '-'}</td></tr>
                                    </table>
                                </div>
                            `;
                            targetDiv.innerHTML = detailHtml;
                        })
                        .catch(err => {
                            console.error(err);
                            targetDiv.innerHTML = '<span class="text-danger">Gagal memuat data.</span>';
                        });
                }
            }
        });

        // --- 4. Fetch Detailed Map (Kecamatan Level) ---
        // Strategy: 
        // 1. Bridge ID (Emsifa -> NusantaraKita)
        // 2. Fetch List of Kecamatan (NusantaraKita)
        // 3. Fetch GeoJSON for *each* Kecamatan
        // 4. Combine into FeatureCollection
        
        if(cityId) {
            var rawCityId = cityId.replace('.', ''); // 1107
            var provId = rawCityId.substring(0, 2); // 11
            
            console.log("Starting Detailed Map Sequence for ID:", rawCityId);
            
            // Step 1: Get City Name from Emsifa
            var emsifaUrl = `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`;
            
            fetch(emsifaUrl)
                .then(res => res.json())
                .then(cities => {
                    var myCity = cities.find(c => c.id == rawCityId);
                    if(!myCity) throw new Error("ID Kota tidak ditemukan di Database Emsifa.");
                    
                    var cityName = myCity.name; 
                    console.log("City Name Identified:", cityName);
                    
                    // Step 2: Find City in NusantaraKita
                    var nusantaraUrl = `https://api-nusantarakita.vercel.app/v2/${provId}/kab-kota?limit=100`;
                    
                    return fetch(nusantaraUrl)
                        .then(res => res.json())
                        .then(nusaData => {
                            var target = nusaData.data.find(item => {
                                return item.nama.toUpperCase().trim() === cityName.toUpperCase().trim();
                            });
                            
                            if(!target) {
                                var cleanName = cityName.replace('KABUPATEN ', '').replace('KOTA ', '').trim();
                                target = nusaData.data.find(item => {
                                    return item.nama.toUpperCase().includes(cleanName.toUpperCase());
                                });
                            }
                            
                            if(!target) throw new Error("Peta untuk " + cityName + " tidak ditemukan di NusantaraKita API.");
                            
                            console.log("Found Nusantara City Target:", target);
                            return target.kode; // e.g. "11.05"
                        });
                })
                .then(nusaCityCode => {
                    // Step 3: Get List of Kecamatan
                    console.log("Fetching Kecamatan List for:", nusaCityCode);
                    return fetch(`https://api-nusantarakita.vercel.app/v2/${nusaCityCode}/kecamatan?limit=100`)
                        .then(res => res.json());
                })
                .then(kecData => {
                    // Step 4: Fetch GeoJSON for ALL Kecamatan
                    var kecamatanList = kecData.data;
                    console.log(`Found ${kecamatanList.length} Kecamatan. Fetching geometries...`);
                    
                    var promises = kecamatanList.map(kec => {
                        return fetch(kec.geojson_url)
                            .then(res => {
                                if(!res.ok) return null;
                                return res.json();
                            })
                            .then(geo => {
                                if(!geo) return null;
                                
                                // --- STRICT VALIDATION ---
                                
                                // 1. Unwrap FeatureCollection if needed
                                if (geo.type === 'FeatureCollection') {
                                    if(geo.features && geo.features.length > 0) {
                                        geo = geo.features[0];
                                    } else {
                                        return null; 
                                    }
                                }
                                
                                // 2. Check if valid Feature or Geometry
                                var geometry = null;
                                if (geo.type === 'Feature') {
                                    geometry = geo.geometry;
                                } else if (geo.type === 'Polygon' || geo.type === 'MultiPolygon') {
                                    geometry = geo;
                                    // Wrap in Feature
                                    geo = { type: "Feature", geometry: geometry, properties: {} };
                                } else {
                                    return null; 
                                }

                                // --- FIX MALFORMED GEOMETRY ---
                                // Detect MultiPolygon labeled but having Polygon coordinates (Depth 3)
                                if (geometry.type === 'MultiPolygon') {
                                    var c = geometry.coordinates;
                                    // Valid MultiPolygon: [ [ [ [x,y] ] ] ] -> Depth 4
                                    // Malformed (Polygon): [ [ [x,y] ] ] -> Depth 3
                                    if (Array.isArray(c) && c.length > 0 && 
                                        Array.isArray(c[0]) && c[0].length > 0 && 
                                        Array.isArray(c[0][0]) && c[0][0].length > 0 && 
                                        typeof c[0][0][0] === 'number') {
                                        
                                        console.warn("Fixing malformed MultiPolygon -> Polygon", kec.nama);
                                        geometry.type = 'Polygon';
                                    }
                                }

                                // 3. Validate Coordinates exist
                                if (!geometry || !geometry.coordinates || geometry.coordinates.length === 0) {
                                    return null;
                                }

                                // 4. Inject Name
                                if(!geo.properties) geo.properties = {};
                                geo.properties.NAMOBJ = kec.nama; 
                                
                                return geo;
                            })
                            .catch(err => null); // Skip failed ones
                    });
                    
                    return Promise.all(promises);
                })
                .then(features => {
                    // Filter out nulls
                    var validFeatures = features.filter(f => f !== null);
                    
                    console.log(`Valid Features Created: ${validFeatures.length}`);

                    if(validFeatures.length === 0) {
                        throw new Error("Gagal mengambil geometri kecamatan. Tidak ada data valid.");
                    }
                    
                    // Step 5: Construct FeatureCollection
                    var featureCollection = {
                        type: "FeatureCollection",
                        features: validFeatures
                    };
                    
                    console.log("Map Construction Complete. Rendering...");
                    processGeoJson(featureCollection);
                })
                .catch(error => {
                    console.error("Map Sequence Error:", error);
                    alert("Gagal memuat peta: " + error.message);
                });

        } else {
            console.warn("City ID belum disetting di Profil Lembaga.");
        }
        
    });
</script>

<style>
    .map-label {
        background: transparent;
        border: none;
        box-shadow: none;
        font-weight: bold;
        color: #333;
        text-shadow: 1px 1px 0px #fff;
    }
</style>

<script>
    // Logic lama untuk error modal
    document.addEventListener("DOMContentLoaded", function() {
        @if($errors->has('npsn') || $errors->has('password'))
            var myModal = new bootstrap.Modal(document.getElementById('modal-kosong'));
            myModal.show();
        @endif
    });
</script>


