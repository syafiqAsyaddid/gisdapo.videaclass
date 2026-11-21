# Aplikasi Satuan Data Mandiri & Peta Sebaran Sekolah (Cadisdik)

Aplikasi berbasis web untuk pemetaan geografis (GIS) sebaran sekolah dan pengelolaan satuan data pendidikan mandiri pada wilayah kerja **Cabang Dinas Pendidikan (Cadisdik)**. Sistem ini mengintegrasikan peta interaktif berbasis **Leaflet.js & GeoJSON** per kecamatan dengan manajemen data sekolah terpadu (Profil Sekolah, PTK, Guru, Sarana & Prasarana, Rombongan Belajar, Siswa, Mata Pelajaran, Kompetensi Keahlian, dan Prestasi).

---

## Fitur Utama

### 1. Peta Sebaran Geografis Interaktif (WebGIS)
- **Polygon Wilayah Kecamatan Dinamis:** Menampilkan batas wilayah kerja per kecamatan secara otomatis mengikuti Kota/Kabupaten yang diatur pada **Profil Lembaga** (terintegrasi dengan API Wilayah Emsifa & GeoJSON NusantaraKita).
- **Filter Wilayah Aktif/Non-Aktif:** Hanya menampilkan sorotan interaktif pada kecamatan yang diaktifkan oleh Admin KCD.
- **Informasi Sekolah pada Peta:** Klik pada polygon kecamatan untuk memilih sekolah dan melihat ringkasan informasi (NPSN, Kepala Sekolah, Alamat, Kontak) secara langsung pada *popup* peta.

### 2. Panel Admin / Operator KCD (Cabang Dinas)
- **Dashboard Peta Wilayah Kerja:** Navigasi cepat ke daftar sekolah per kecamatan langsung dari peta.
- **Pengelolaan Profil Lembaga:** Konfigurasi identitas instansi/KCD, logo, gambar latar login, serta pemilihan Provinsi & Kota/Kabupaten wilayah kerja.
- **Manajemen Master Data:**
  - **Wilayah Kerja (Kecamatan):** Sinkronisasi otomatis daftar kecamatan berdasarkan Kota/Kabupaten pada Profil Lembaga serta pengaturan status *Aktif / Non-Aktif*.
  - **Jenjang Pendidikan:** Pengelolaan jenjang sekolah (SMA, SMK, SLB, dll.).
  - **Kategori Sekolah:** Pengelolaan status sekolah (Negeri, Swasta, dll.).
- **Manajemen Akun & Data Sekolah:**
  - Pembuatan akun sekolah baru (otomatis membuat akun *Operator Sekolah* dan *Kepala Sekolah*), impor massal via Excel, dan fitur *Reset Password*.
  - Monitoring lengkap seluruh data sekolah (Profil, PTK, Guru, Ruangan & Sarpras, Rombel, Siswa, Mapel, Kompetensi Keahlian, Prestasi).
  - Cetak PDF Surat Rekomendasi dan Laporan Detail/Profil Sarpras.
- **Statistik & Ekspor Data:**
  - Grafik dan rekapitulasi Statistik Sarana & Prasarana sekolah.
  - Ekspor laporan Excel (`.xlsx`) untuk Data Akun User, PTK, Guru, Rombel, Ruangan, Sarpras, dan Prestasi.
- **Verifikasi & Approval Data (Admin KCD & Supervisor):**
  - Pengelolaan akun **Supervisor** khusus oleh Admin KCD.
  - Peninjauan (*Approve / Reject*) pengajuan verifikasi perubahan data dari sekolah.

### 3. Panel Sekolah (Operator Sekolah & Kepala Sekolah)
- **Profil Sekolah:** Pengelolaan identitas sekolah, NPSN, NSS, Kepala Sekolah, foto profil, alamat, kontak, dan jenjang yang dilayani.
- **Manajemen PTK & Guru:** CRUD dan impor/ekspor Excel data Pendidik & Tenaga Kependidikan beserta pembagian jam mengajar dan mata pelajaran.
- **Manajemen Sarana & Prasarana (Sarpras):**
  - Pengelolaan ruangan, kondisi sarpras (baik, rusak sedang, rusak berat), unit, subkategori, parameter sarpras, serta unggah dokumentasi foto detail sarpras.
  - Cetak laporan PDF Sarpras.
- **Manajemen Akademik & Kesiswaan:**
  - Data Rombongan Belajar (Rombel) dan rekapitulasi jumlah siswa per tingkat kelas.
  - Data Mata Pelajaran Umum dan Kompetensi Keahlian (khusus SMA/SMK).
  - Pencatatan Prestasi Guru dan Prestasi Siswa sesuai tingkat kejuaraan (Kecamatan hingga Internasional).

---

## Teknologi yang Digunakan

- **Backend:** PHP 8.x, Laravel 8.x
- **Database:** MySQL / MariaDB
- **Frontend:** Blade Templates, Bootstrap 5, jQuery, Select2, Chart.js, FontAwesome
- **GIS & Peta:** Leaflet.js, QGIS2Web, Emsifa Wilayah API, NusantaraKita GeoJSON API
- **Utilitas Laporan:**
  - `maatwebsite/excel` (Impor & Ekspor Excel)
  - `barryvdh/laravel-dompdf` (Cetak Laporan & Surat PDF)
  - `realrashid/sweet-alert` (Notifikasi Interaktif)

---

## Persyaratan Sistem

- **PHP** >= 7.4 atau 8.x (dengan ekstensi `pdo_mysql`, `mbstring`, `gd`, `zip`, `xml`, `fileinfo`)
- **Composer**
- **MySQL / MariaDB** (misalnya melalui XAMPP / Laragon)
- Koneksi internet (untuk memuat *tile* peta OpenStreetMap dan API batas wilayah GeoJSON)

---

## Panduan Instalasi Lokal

1. **Clone repositori utama dari GitHub:**
   Buka terminal/CMD di folder `htdocs` XAMPP (misalnya `C:\xampp\htdocs` atau `D:\xampp\htdocs`), lalu jalankan:
   ```bash
   git clone https://github.com/syafiqAsyaddid/gisdapo.videaclass.git
   cd gisdapo.videaclass
   ```

   > **Catatan untuk Website 2 (`cadisdik`):**
   > Karena folder `cadisdik` terhubung ke repositori terpisah, jika folder `cadisdik` kosong setelah proses clone, jalankan perintah berikut di dalam folder project:
   > ```bash
   > git clone https://github.com/VideaClass/cadisdik.git cadisdik
   > ```

2. **Instal dependensi PHP melalui Composer:**
   ```bash
   composer install
   ```

3. **Salin file konfigurasi environment:**
   ```bash
   copy .env.example .env
   ```
   *(Untuk macOS/Linux gunakan `cp .env.example .env`)*

4. **Buat & konfigurasi database MySQL:**
   - Jalankan **Apache** dan **MySQL** melalui **XAMPP Control Panel**.
   - Buka `http://localhost/phpmyadmin` lalu buat database baru bernama **`sebaran_sekolah`**.
   - Pastikan pengaturan database di `.env` sudah sesuai:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=sebaran_sekolah
     DB_USERNAME=root
     DB_PASSWORD=
     ```
   *(Konfigurasi database untuk Website 2 di `cadisdik/application/config/database.php` juga mengarah ke database `sebaran_sekolah` dengan user `root` tanpa password.)*

5. **Generate Application Key & Storage Symlink:**
   ```bash
   php artisan key:generate
   php artisan storage:link
   ```

6. **Jalankan Migrasi dan Seeder Database:**
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Server Lokal (Website 1):**
   ```bash
   php artisan serve
   ```
   *(Di Windows, Anda juga dapat mengklik dua kali file `start.bat` untuk menyalakan MySQL, menjalankan server Laravel, dan membuka browser secara otomatis.)*

---

## Link Akses & Akun Default (2 Website)

### 1. Website Utama — Satuan Data Mandiri & Peta Sebaran Sekolah (Laravel 8)
Pastikan `php artisan serve` sedang berjalan.

- **Beranda / Peta Sebaran Sekolah (WebGIS):** `http://127.0.0.1:8000`
- **Login Admin KCD & Supervisor:** `http://127.0.0.1:8000/login-kcd`
- **Login Sekolah (Operator & Kepala Sekolah):** `http://127.0.0.1:8000/login-sekolah`

Sistem memiliki **4 hak akses (role)** default hasil seeder dengan pembagian wewenang sebagai berikut:

| Role | Halaman Login | Kecamatan & Sekolah | Username | Password | Hak Akses |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Admin / Operator KCD (Dinas)** | `/login-kcd` | *(Langsung login)* | `kcd` | `admin` | Akses penuh pengaturan profil lembaga, sinkronisasi wilayah kerja, master data, kelola sekolah, kelola supervisor, verifikasi, statistik, & ekspor seluruh data |
| **Supervisor** | `/login-kcd` | *(Langsung login)* | `supervisor` | `123456` | Akses monitoring data sekolah serta verifikasi (*approve/reject*) pengajuan data sekolah |
| **Operator Sekolah** | `/login-sekolah` | Pilih Kecamatan & Sekolah terkait | `operator12345678` | `123456` | Akses penuh **Lihat & Kelola (Tambah/Edit/Hapus/Impor/Ekspor)** seluruh data pada sekolahnya & ajukan verifikasi |
| **Kepala Sekolah (Kepsek)** | `/login-sekolah` | Pilih Kecamatan & Sekolah terkait | `kepsek12345678` | `123456` | Akses **Monitoring (Read-Only)** seluruh data sekolah dan unduh laporan/ekspor data sekolahnya |

> **Catatan:** Saat Admin KCD menambahkan sekolah baru dengan NPSN tertentu, sistem secara otomatis membuat dua akun default:
> - **Operator Sekolah:** username `operator<NPSN>`, password default `123456`
> - **Kepala Sekolah:** username `kepsek<NPSN>`, password default `123456`

### 2. Website Portal — Website Profil Cadisdik (CodeIgniter 3 — folder `cadisdik/`)
Pastikan **Apache** di XAMPP aktif dan folder project berada di dalam `htdocs`.

- **Beranda Portal Publik:** `http://localhost/gisdapo.videaclass/cadisdik/`
- **Login Administrator Portal:** `http://localhost/gisdapo.videaclass/cadisdik/administrator`
- **Registrasi / Login Tamu (Guest):** `http://localhost/gisdapo.videaclass/cadisdik/guest/register`

*(Sesuaikan bagian `gisdapo.videaclass` dengan nama folder tempat project di-clone di dalam `htdocs`.)*

| Role | Halaman Login | Username | Password |
| :--- | :--- | :--- | :--- |
| **Administrator Portal** | `/cadisdik/administrator` | `admin` | `admin123` |
| **Admin Sekolah (Portal)** | Login Sekolah Portal | `sekolah1` | `123456` |

*(Jika akun portal belum tersedia di database lokal, jalankan `php create_admin.php` dan `php create_school_admin.php` dari dalam folder `cadisdik/`.)*

---

## Cara Mengatur Peta Wilayah Kerja Baru

1. Login sebagai **Admin KCD** melalui `/login-kcd`.
2. Buka menu **Pengaturan -> Profil Lembaga** (`/profil-lembaga`).
3. Pilih **Provinsi** dan **Kota/Kabupaten** pada kolom Alamat & Wilayah, lalu klik **Simpan Perubahan**.
4. Buka menu **Pengaturan -> Wilayah Kerja** (`/kcd/wilayah`).
5. Klik tombol **Sinkronisasi** di kanan atas. Sistem akan menarik seluruh daftar kecamatan di Kota/Kabupaten terpilih dan menonaktifkan kecamatan dari wilayah sebelumnya.
6. Buka halaman beranda (`/`) atau Dashboard KCD (`/kcd/kecamatan`) untuk melihat peta interaktif dengan polygon kecamatan wilayah kerja yang baru.

---

## Lisensi

Proyek ini menggunakan kerangka kerja [Laravel](https://laravel.com) yang dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).
