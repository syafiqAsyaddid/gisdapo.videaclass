<x-layout-index>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style type="text/css">
        .col-25{
            padding: 15px;
        }
        .container{
            width: 700px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        h1{
            font-size: 24px;
            margin-bottom: 20px;
        }
        .container input[type="submit"], .back{
            padding: 15px 30px;
            float: right;
        }
        hr{
            margin: 40px 0;
        }
    </style>
    </head>
    <body style="background-color: #fff;">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Left Side: Form -->
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
                <div style="width: 80%; max-width: 500px;">
                    <div class="text-start mb-4">
                        @if(isset($profil_lembaga) && $profil_lembaga->logo)
                            <img src="{{ Storage::url($profil_lembaga->logo) }}" alt="Logo" width="80" height="auto" class="mb-3">
                        @else
                            <img src="{{ asset('images/jabar.png') }}" alt="Logo" width="80" height="auto" class="mb-3">
                        @endif
                        
                        <h2 class="fw-bold">
                            {{ isset($profil_lembaga) && $profil_lembaga->nama_lembaga ? $profil_lembaga->nama_lembaga : 'Welcome back!' }}
                        </h2>
                    </div>

                    <form action="/sekolah/sessions" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label fw-bold">Kecamatan <span class="text-danger">*</span></label>
                            <select name="kecamatan_id" id="kecamatan" class="form-control" required style="width: 100%;">
                                <option value="" hidden>Pilih Kecamatan</option>
                                @foreach ( $kecamatan as $kecamatan )
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sekolah" class="form-label fw-bold">Sekolah <span class="text-danger">*</span></label>
                            <select name="sekolah_id" id="sekolah" class="form-control" required style="width: 100%;">
                                @foreach ( $sekolah as $sekolah )
                                    <option value="{{ $sekolah->id }}">{{ $sekolah->nama }}</option>
                                @endforeach
                            </select>
                            @error('sekolah_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" autocomplete="off" required>
                            @error('username') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="pass" class="form-control" placeholder="Enter password" autocomplete="off" required>
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="submit-sekolah" class="btn btn-primary btn-lg" style="background-color: #4e46e5; border: none;">Log In</button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="/login-kcd" class="text-decoration-none" style="color: #4e46e5;">Login sebagai Admin/KCD</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side: Image -->
            <div class="col-md-6 d-none d-md-block p-0">
                <div style="background: url({{ isset($profil_lembaga) && $profil_lembaga->background_image ? Storage::url($profil_lembaga->background_image) : asset('./images/kcd.jpg') }}) center center no-repeat; background-size: cover; height: 100vh; width: 100%;">
                    <div style="background: rgba(78, 70, 229, 0.2); height: 100%; width: 100%;"></div> 
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
</x-layout-index>
<script>
    $('#kecamatan').select2();
    $('#sekolah').select2();
</script>



