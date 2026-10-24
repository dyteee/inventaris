# Sistem Inventaris Sekolah (School Inventory System)

Aplikasi web pencatatan dan pengelolaan inventaris sekolah (alat laboratorium, multimedia, alat olahraga, perlengkapan sarpras) berbasis **Laravel 11**, **Blade**, dan **MySQL**. Sistem ini menggantikan sistem pencatatan buku manual dengan alur peminjaman, pelacakan tenggat waktu, verifikasi pengembalian, serta jejak audit (*audit trail*) terpusat.

---

## 1. Fitur Utama Berdasarkan Peran (Role Management)

### A. Admin (Pengelola Inventaris)
- **Dashboard Eksekutif**: Statistik total barang, kategori, barang sedang dipinjam, keterlambatan pengembalian, serta peringatan stok menipis.
- **Manajemen Kategori Barang (`categories`)**: CRUD kategori barang inventaris.
- **Manajemen Data Barang (`items`)**: CRUD data barang lengkap dengan kode unik (SKU), stok, dan kondisi barang (*baik*, *rusak ringan*, *rusak berat*).
- **Verifikasi & Monitoring Peminjaman (`loans`)**: Memantau status peminjaman seluruh guru dan siswa secara *real-time*, status otomatis berubah menjadi *terlambat* jika melewati tanggal tenggat (`due_date`).
- **Pencatatan Pengembalian (`return_logs`)**: Memverifikasi pengembalian barang, otomatis menambah stok kembali (*increment*), mencatat kondisi fisik barang saat dikembalikan, dan menyimpan catatan admin.
- **Audit Trail (`activity_logs`)**: Rekam jejak audit aktivitas sistem secara otomatis untuk operasi penambahan, pengubahan, penghapusan, hingga autentikasi login/logout.
- **Manajemen Pengguna (`users`)**: Mengelola akun pengguna dan menentukan *role* (Admin / User).

### B. User (Guru / Siswa)
- **Katalog Barang**: Melihat daftar barang inventaris yang tersedia secara transparan dengan fitur pencarian dan filter kategori/kondisi.
- **Pengajuan Peminjaman**: Mengajukan peminjaman barang inventaris sesuai jumlah dan batas tanggal yang dibutuhkan.
- **Riwayat Peminjaman Pribadi**: Memantau status barang yang sedang dipinjam, batas pengembalian, serta riwayat barang yang telah dikembalikan.
- **Detail Pengembalian**: Melihat catatan kondisi barang dan verifikasi dari admin saat barang dikembalikan.

---

## 2. Kredensial Akun Pengujian (Hasil Seeder)

Gunakan akun bawaan seeder berikut untuk melakukan pengujian sistem:

| Peran (Role) | Nama Pengguna | Alamat Email | Password |
|---|---|---|---|
| **Admin** | Penguji 1 | `admin@sekolah.sch.id` | `admin123` |
| **User (Peminjam)** | Penguji 2 | `guru@sekolah.sch.id` | `password123` |
| **User (Peminjam)** | Penguji 3 | `siswa@sekolah.sch.id` | `password123` |

> Pengguna baru juga dapat langsung mendaftar melalui halaman **Register** (otomatis mendapatkan peran `user`).

---

## 3. Tech Stack

- **Framework**: Laravel 11.x
- **Authentication**: Laravel Breeze
- **View Engine**: Blade Templating & Alpine.js
- **Styling**: Tailwind CSS (Clean, Professional Admin Design)
- **Database**: MySQL (didukung XAMPP / MariaDB)
- **Testing**: PHPUnit / Laravel Test Suite (29 Automated Tests Passed)

---

## 4. Struktur Basis Data (6 Tabel Wajib)

1. **`users`**: Menyimpan data identitas akun pengguna beserta `role` (`admin` / `user`).
2. **`categories`**: Menyimpan kategori inventaris (Lab IPA, Multimedia, Olahraga, Sarpras).
3. **`items`**: Menyimpan detail barang, `category_id`, kode barang unik, stok, dan kondisi.
4. **`loans`**: Mencatat transaksi peminjaman oleh user (`user_id`, `item_id`, `quantity`, `loan_date`, `due_date`, `status`, `deleted_at`).
5. **`return_logs`**: Mencatat verifikasi pengembalian dari peminjaman (`loan_id`, `returned_at`, `condition_on_return`, `notes`, `deleted_at`).
6. **`activity_logs`**: Menyimpan riwayat audit (*audit trail*) setiap aksi penting di dalam sistem (`user_id`, `action`, `description`).

---

## 5. Cara Instalasi dan Menjalankan Proyek

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL (XAMPP)

### Langkah-Langkah

1. **Clone atau Buka Direktori Proyek**:
   ```bash
   cd c:/xampp/htdocs/Iventaris-febi
   ```

2. **Salin File Environment**:
   ```bash
   cp .env.example .env
   ```

3. **Pastikan Konfigurasi Database di `.env` Sesuai**:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventaris_febi
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Install Dependensi PHP & Generate App Key**:
   ```bash
   composer install
   php artisan key:generate
   ```

5. **Jalankan Migration dan Seeder**:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Install Dependensi Node dan Build Asset**:
   ```bash
   npm install
   npm run build
   ```

7. **Jalankan Web Server**:
   ```bash
   php artisan serve
   ```
   Buka peramban di [http://localhost:8000](http://localhost:8000).

---

## 6. Standar Kualitas yang Diterapkan

- **Form Request Validation**: Setiap form (Kategori, Barang, Peminjaman, Pengembalian, User) divalidasi ketat di sisi backend dengan pesan error berbahasa Indonesia.
- **Autofokus & Placeholder**: Semua input formulir memiliki atribut `autofocus` pada field pertama dan deskripsi `placeholder` yang informatif.
- **Indikator Wajib (*)**: Seluruh input wajib diisi ditandai tanda bintang merah (`*`).
- **Format Tanggal & Angka Indonesia**: Tanggal diformat rapi (contoh: `15 Okt 2026`) dan angka diformat dengan pemisah ribuan titik (contoh: `1.000 unit`).
- **Soft Deletes**: Tabel `loans` dan `return_logs` menerapkan fitur *Soft Delete* bawaan Laravel.
- **Tampilan Bersih & Rapi**: Tampilan disesuaikan untuk kebutuhan institusi sekolah yang formal, jelas, dan mudah dipahami oleh staf tata usaha, guru, maupun murid.
