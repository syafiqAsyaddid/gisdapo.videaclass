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

1. **Clone repositori ini:**
   ```bash
   git clone <url-repository-anda>
   cd sebaran-sekolah-main1
   ```

2. **Instal dependensi PHP melalui Composer:**
   ```bash
   composer install
   ```

3. **Salin file konfigurasi environment:**
   ```bash
   cp .env.example .env
   ```

4. **Konfigurasi database di file `.env`:**
   Buat database baru di MySQL/phpMyAdmin (misalnya `sebaran_sekolah`), lalu sesuaikan pengaturan pada `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sebaran_sekolah
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate Application Key & Storage Symlink:**
   ```bash
   php artisan key:generate
   php artisan storage:link
   ```

6. **Jalankan Migrasi dan Seeder Database:**
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Akses aplikasi di browser melalui: `http://127.0.0.1:8000`

---

## Daftar Role & Akun Default (Hasil Seeder)

Sistem memiliki **3 hak akses (role)** dengan pembagian wewenang sebagai berikut:

| Role | Halaman Login | Kecamatan & Sekolah | Username | Password | Hak Akses |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Admin / Operator KCD (Dinas)** | `/login-kcd` | *(Langsung login)* | `kcd` | `admin` | Akses penuh pengaturan profil lembaga, sinkronisasi wilayah kerja, master data, kelola sekolah, statistik, & ekspor seluruh data |
| **Operator Sekolah** | `/login-sekolah` | Pilih Kecamatan & Sekolah terkait | `operator12345678` | `123456` | Akses penuh **Lihat & Kelola (Tambah/Edit/Hapus/Impor/Ekspor)** seluruh data pada sekolahnya |
| **Kepala Sekolah (Kepsek)** | `/login-sekolah` | Pilih Kecamatan & Sekolah terkait | `kepsek12345678` | `123456` | Akses **Monitoring (Read-Only)** seluruh data sekolah dan unduh laporan/ekspor data sekolahnya |

> **Catatan:** Saat Admin KCD menambahkan sekolah baru dengan NPSN tertentu, sistem secara otomatis membuat dua akun default:
> - **Operator Sekolah:** username `operator<NPSN>`, password default `123456`
> - **Kepala Sekolah:** username `kepsek<NPSN>`, password default `123456`

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
