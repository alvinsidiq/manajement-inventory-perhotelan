

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript" width="50px" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS3" width="50px" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" alt="Bootstrap" width="50px" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML5" width="50px" />
</p>

## 🚀 Membuat Proyek Laravel Baru

Ikuti langkah-langkah di bawah ini untuk membuat proyek Laravel dari awal.

### 1. Persiapan Lingkungan
Sebelum memulai, pastikan Anda sudah menginstal **Composer** dan **PHP** di sistem Anda. Anda dapat memverifikasi instalasi dengan menjalankan perintah berikut:

```bash
composer --version
php --version
```
### 2. Membuat Proyek Laravel Baru
   ```bash
   composer create-project --prefer-dist laravel/laravel nama-proyek
   ```
### 3.Masuk ke Direktori Proyek
   ```bash
   cd nama-proyek
   ```
### 4. Menjalankan Server Pengembangan
   ``` bash
   php artisan serve
   ```
## ERD Diagram Sistem Manajemen Inventaris Perhotelan

![Logo Proyek](assets/images/logo.png)

Sistem ini mengelola manajemen kamar, inventaris, transaksi, dan pengguna di hotel dengan berbagai fitur penting untuk mempermudah pengelolaan. Di bawah ini adalah penjelasan detail mengenai **Entity-Relationship Diagram (ERD)** dan struktur database untuk sistem ini.

---

### 📋 Modul Utama

#### 1. Modul Manajemen Kamar
- **Tabel `rooms`**: Menyimpan informasi kamar dengan atribut berikut:
  - `room_id` (ID Kamar)
  - `room_number` (Nomor Kamar)
  - `room_type_id` (ID Tipe Kamar)
  - `status` (Tersedia/ Terisi/ Pemeliharaan)
  
- **Tabel `room_types`**: Menyimpan informasi tipe kamar yang ada, seperti:
  - `name` (Nama Tipe Kamar)
  - `description` (Deskripsi Tipe Kamar)
  - `price` (Harga per Kamar)
  
- **Tabel `reservations`**: Menangani pemesanan kamar dengan informasi berikut:
  - `check_in_date` (Tanggal Check-in)
  - `check_out_date` (Tanggal Check-out)
  - `reservation_status` (Status Reservasi)

#### 2. Modul Manajemen Inventaris

##### A. Consumable Items (Barang Habis Pakai)
- **Tabel `consumables`**: Menyimpan barang-barang habis pakai dengan atribut berikut:
  - `stock` (Jumlah stok)
  - `reorder_level` (Tingkat pemesanan ulang)

- **Tabel `consumable_categories`**: Menyimpan kategori untuk barang habis pakai.

- **Tabel `consumable_allocations`**: Mencatat alokasi barang ke kamar tertentu.

##### B. Unconsumable Items (Aset Tetap)
- **Tabel `unconsumables`**: Menyimpan aset tetap hotel (misalnya, furnitur, peralatan).
  
- **Tabel `unconsumable_categories`**: Menyimpan kategori untuk aset tetap.

- **Tabel `unconsumable_allocations`**: Mencatat penempatan aset di kamar tertentu.

#### 3. Modul Transaksi dan Pengguna
- **Tabel `transactions`**: Mencatat transaksi barang dengan tipe IN/OUT.
  
- **Tabel `users`**: Menyimpan data pengguna sistem (administrator, staf, dll).
  
- **Tabel `guests`**: Menyimpan informasi tamu hotel (nama, kontak, dll).

- **Tabel `suppliers`**: Menyimpan data supplier barang.

#### 4. Fitur Keamanan dan Monitoring
- **Audit Trail**: Setiap tabel memiliki kolom `created_at` dan `updated_at` untuk melacak perubahan pada data.
  
- **Tabel `password_reset_tokens`**: Menangani token reset password untuk pengguna.

- **Tabel `job_batches`**: Menangani proses background/batch (misalnya, laporan atau pemeliharaan data).

---

### 🔗 Relasi Kunci

#### 1. Relasi Manajemen Kamar:
- **`rooms` ←→ `room_types` (One-to-Many)**
  - **Fungsi**: Setiap kamar memiliki satu tipe kamar tertentu, sedangkan satu tipe kamar bisa dimiliki oleh banyak kamar. Ini memungkinkan pengelompokan kamar berdasarkan tipe seperti Standard, Deluxe, Suite, dll.

- **`rooms` ←→ `reservations` (One-to-Many)**
  - **Fungsi**: Satu kamar bisa memiliki banyak reservasi (dalam waktu berbeda), tapi satu reservasi hanya untuk satu kamar spesifik.

- **`guests` ←→ `reservations` (One-to-Many)**
  - **Fungsi**: Satu tamu bisa memiliki banyak reservasi, tapi satu reservasi hanya terkait dengan satu tamu.

#### 2. Relasi Inventaris Consumable:
- **`consumables` ←→ `consumable_categories` (Many-to-One)**
  - **Fungsi**: Mengelompokkan barang habis pakai dalam kategori. Satu kategori bisa memiliki banyak barang, tapi satu barang hanya masuk dalam satu kategori.

- **`consumables` ←→ `consumable_allocations` (One-to-Many)**
  - **Fungsi**: Melacak distribusi barang habis pakai ke kamar-kamar. Satu barang bisa dialokasikan ke banyak kamar.

- **`rooms` ←→ `consumable_allocations` (One-to-Many)**
  - **Fungsi**: Mencatat barang habis pakai yang dialokasikan ke setiap kamar.

#### 3. Relasi Inventaris Unconsumable:
- **`unconsumables` ←→ `unconsumable_categories` (Many-to-One)**
  - **Fungsi**: Mengkategorikan aset tetap. Satu kategori bisa memiliki banyak aset, tapi satu aset hanya masuk dalam satu kategori.

- **`unconsumables` ←→ `unconsumable_allocations` (One-to-Many)**
  - **Fungsi**: Melacak penempatan aset tetap di kamar-kamar.

- **`rooms` ←→ `unconsumable_allocations` (One-to-Many)**
  - **Fungsi**: Mencatat aset tetap yang ditempatkan di setiap kamar.

#### 4. Relasi Transaksi dan User:
- **`users` ←→ `transactions` (One-to-Many)**
  - **Fungsi**: Mencatat user yang melakukan transaksi. Satu user bisa melakukan banyak transaksi.

- **`items` ←→ `transactions` (One-to-Many)**
  - **Fungsi**: Mencatat barang yang terlibat dalam transaksi.

#### 5. Relasi Supplier:
- **`suppliers` ←→ `items` (One-to-Many)**
  - **Fungsi**: Mencatat supplier untuk setiap barang. Satu supplier bisa menyediakan banyak barang.

#### 6. Relasi Inventory:
- **`inventory_categories` ←→ `inventories` (One-to-Many)**
  - **Fungsi**: Mengkategorikan inventaris secara umum.

- **`inventory_allocations` ←→ `rooms` (Many-to-One)**
  - **Fungsi**: Mencatat alokasi inventaris ke kamar-kamar.

#### 7. Relasi User Management:
- **`users` ←→ `consumable_allocations` & `unconsumable_allocations` (One-to-Many)**
  - **Fungsi**: Melacak user yang melakukan alokasi barang (audit trail).

---


### 🛠️ Fitur Tracking
- **Stock Monitoring**: Dikelola melalui atribut `stock` dan `reorder_level` di tabel barang.
- **Status Tracking**: Status untuk kamar (`rooms`) dan reservasi (`reservations`) dapat dipantau.
- **Damage Reporting**: Dapat melaporkan kerusakan untuk **unconsumable items** (aset tetap).
- **Audit Trail**: Semua perubahan pada tabel dicatat melalui `created_at` dan `updated_at`.

---





