<?php
$json = file_get_contents('public/data/Kecamatan_1.js');
// Remove "var json_Kecamatan_1 = " prefix if present to get valid JSON
$json = preg_replace('/^var\s+json_Kecamatan_1\s*=\s*/', '', $json);
// Remove trailing semicolon if present
$json = rtrim($json, ';');

$data = json_decode($json, true);

if (!$data) {
    die("Failed to decode JSON");
}

$kecamatans = [];
foreach ($data['features'] as $feature) {
    $props = $feature['properties'];
    $kecamatans[] = [
        'id' => $props['id'] ?? null, // Use ID from GeoJSON if available
        'nama_kecamatan' => $props['KECAMATAN']
    ];
}

// Sort by ID or Name
usort($kecamatans, function($a, $b) {
    return $a['nama_kecamatan'] <=> $b['nama_kecamatan'];
});

echo "[\n";
foreach ($kecamatans as $k) {
    echo "    ['id' => " . ($k['id'] ? $k['id'] : 'null') . ", 'nama_kecamatan' => '" . addslashes($k['nama_kecamatan']) . "'],\n";
}
echo "];\n";
