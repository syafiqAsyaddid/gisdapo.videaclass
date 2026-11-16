<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
<div class="container" id="form-display">
<div class="header">
    <h2>Ganti Password</h2>
    <form action="user/update" method="POST">
      @csrf
      @method('PATCH')
      <div class="row">
        <div class="col-25">
          <label for="old_password">Password Lama</label>
        </div>
        <div class="col-75">
          <input type="password" name="old_password">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="new_password">Password Baru</label>
        </div>
        <div class="col-75">
          <input type="password" name="new_password">
        </div>
      </div>
      <div class="row">
        <input type="submit" value="submit">
      </div>
    </form>
</div>
</div>
</x-layout-sekolah>