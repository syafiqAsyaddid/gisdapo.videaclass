<div class="modal fade" id="school" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi Sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="sekolah/sessions" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-25">
                                <label for="sekolah">Kecamatan</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="kecamatan" id="kecamatan" value="" disabled {{ old('kecamatan') }}>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="sekolah">Sekolah</label>
                            </div>
                            <div class="col-75">
                                <select name="sekolah_id" id="sekolah" required></select>
                            </div>
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-25">--}}
{{--                                <label for="username">Username</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-75">--}}
{{--                                <input type="text" name="username" autocomplete="off" class="login" id="username"--}}
{{--                                    required="" value="{{ old('username') }}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-25">--}}
{{--                                <label for="password">Password</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-75">--}}
{{--                                <input type="password" name="password" autocomplete="off" class="login" id="pass"--}}
{{--                                    required="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @error('password')
                            <div class="invalid">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="kecamatan_id" id="kecamatan_id" value="{{ old('kecamatan_id') }}">
                        <div class="modal-footer" style="margin-top: 15px;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
{{--                            <button type="submit" id="btn-login" class="btn btn-primary" name="submit-sekolah" disabled>Login</button>--}}
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


{{--modal info--}}
<div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
{{--                form--}}
                <div class="row">
{{--                    info--}}
                    <h2 class="text-center" id="sekolahnama"> </h2>
                    <hr>
{{--                    table--}}
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">NPSN</th>
                            <td><h4 id="npsn"></h4></td>
                        </tr>
                        <tr>
                            <th scope="col">Kepsek</th>
                            <td><h4 id="kepsek"></h4></td>
                        </tr>
                        <tr>
                            <th scope="col">Alamat</th>
                            <td><h4 id="alamat"></h4></td>
                        </tr>
                        <tr>
                            <th scope="col">Email</th>
                            <td><h4 id="email"></h4></td>
                        </tr>
                        <tr>
                            <th scope="col">Telepon</th>
                            <td><h4 id="telepon"></h4></td>
                        </tr>
                        </thead>
                        <tbody id="table">
                        </tbody>
                    </table>


{{--                    <div class="col-md-6 col-lg-12 col-xl-6">--}}
{{--                        <div class="label">Kecamatan</div>--}}
{{--                        <input type="text" name="kecamatan" id="kecamatan" value="" disabled class="form-control">--}}
{{--                    </div>--}}
{{--                    npsn--}}
{{--                    <div class="col-md-6 col-lg-12 col-xl-6">--}}
{{--                        <div class="label">NPSN</div>--}}
{{--                        <input type="text" name="npsn" id="npsn" value="" disabled class="form-control">--}}
{{--                    </div>--}}
{{--                    alamat--}}
{{--                    <div class="col-md-6 col-lg-12 col-xl-6">--}}
{{--                        <div class="label">Alamat</div>--}}
{{--                        <input type="text" name="alamat" id="alamat" value="" disabled class="form-control">--}}
{{--                    </div>--}}
{{--                    email--}}
{{--                    <div class="col-md-6 col-lg-12 col-xl-6">--}}
{{--                        <div class="label">Email</div>--}}
{{--                        <input type="text" name="email" id="email" value="" disabled class="form-control">--}}
{{--                    </div>--}}
{{--                    no telp--}}
{{--                    <div class="col-md-6 col-lg-12 col-xl-6">--}}
{{--                        <div class="label">No Telp</div>--}}
{{--                        <input type="text" name="no_telp" id="no_telp" value="" disabled class="form-control">--}}
{{--                    </div>--}}
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>