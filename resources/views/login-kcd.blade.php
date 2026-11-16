<x-layout-index>
	<style type="text/css">
		.col-25{
			padding: 15px;
		}
		.container{
			width: 400px;
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
                            {{ isset($profil_lembaga) && $profil_lembaga->nama_lembaga ? $profil_lembaga->nama_lembaga : 'Admin Login' }}
                        </h2>
                    </div>

                    <form action="/kcd/sessions" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" autocomplete="off" required value="{{ old('username') }}">
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="pass" class="form-control" placeholder="Enter password" autocomplete="off" required>
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="/kcd/forgot-password" class="text-decoration-none" style="color: #4e46e5;">Forgot your password?</a>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="submit-kcd" class="btn btn-primary btn-lg" style="background-color: #4e46e5; border: none;">Log In</button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="/" class="text-decoration-none text-muted">Back to Home</a>
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