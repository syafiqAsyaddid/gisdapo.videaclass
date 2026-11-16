<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<title>Login</title>
	<style type="text/css">
		.col-25{
			padding: 15px;
		}
		.container{
			width: 640px;
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
	.invalid{
		cursor: pointer;
		background: rgba(255, 25, 60, 0.4);
		color: black;
		font-weight: bold;
		padding: 5px;
		border-radius: 10px;
		margin-top: 5px;
		text-transform: uppercase;
		font-size: 14px;
		display: none;
	}
	</style>
</head>
    <div class="container">
        <h1 align="center">Informasi Sekolah</h1>
        {{-- <div class="row">
            <div class="col-25">
                <label for="kecamatan">Kecamatan</label>
            </div>
            <div class="col-75">
                <select name="kecamatan" id="kecamatan" required>
                    <option value="" hidden>Pilih Kecamatan</option>
                    @foreach ( $kecamatan as $kecamatan )
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        <form action="/sekolah/sessions" method="post">
            @csrf
            <div class="row">
                <div class="col-25">
                    <label for="sekolah_id">Sekolah</label>
                </div>
                @error('sekolah_id')
                    {{ $message }}
                @enderror
                <div class="col-75">
                    <select name="sekolah_id" id="sekolah" required>
                        @foreach ( $sekolah as $sekolah )
                            <option value="{{ $sekolah->id }}">{{ $sekolah->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <hr> --}}
            {{-- <h1 align="center">Login</h1> --}}
            @csrf
{{--            <div class="row">--}}
{{--                <div class="col-25">--}}
{{--                    <label for="username">Username</label>--}}
{{--                </div>--}}
{{--                <div class="col-75">--}}
{{--                    <input type="text" name="username" autocomplete="off" class="login" id="username"--}}
{{--                        required="">--}}
{{--                    <div class="invalid"></div>--}}
{{--                </div>--}}
{{--                @error('username')--}}
{{--                    {{ $message }}--}}
{{--                @enderror--}}
{{--                @error('password')--}}
{{--                    {{ $message }}--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-25">--}}
{{--                    <label for="password">Password</label>--}}
{{--                </div>--}}
{{--                <div class="col-75">--}}
{{--                    <input type="password" name="password" autocomplete="off" class="login" id="pass"--}}
{{--                        required="">--}}
{{--                    <div class="invalid"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row buttons">
{{--                <input type="submit" name="submit-sekolah" value="Login">--}}
                <a href="index.php" class="back">back</a>
            </div>
        </form>
    </div>
</body>
</html>