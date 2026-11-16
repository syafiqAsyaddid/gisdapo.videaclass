<x-layout-index>
<body style="background-color: #fff;">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Left Side: Form -->
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
                <div style="width: 80%; max-width: 500px;">
                    <div class="text-start mb-4">
                         @if(isset($profil_lembaga) && $profil_lembaga->logo)
                            <img src="{{ Storage::url($profil_lembaga->logo) }}" alt="Logo" width="100" height="auto" class="mb-3">
                        @else
                            <img src="{{ asset('images/jabar.png') }}" alt="Logo" width="80" height="auto" class="mb-3">
                        @endif
                        <h2 class="fw-bold">Forgot Password?</h2>
                        <p class="text-muted">Silahkan masukkan email anda untuk kami kirimkan password baru.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/kcd/forgot-password" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" style="background-color: #4e46e5; border: none;">Kirim</button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="/login-kcd" class="text-decoration-none text-muted">Back to Login</a>
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
</x-layout-index>
