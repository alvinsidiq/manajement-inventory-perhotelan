

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
## Struktur Proyek Laravel
```

project-name/
├── app/                       # Direktori untuk aplikasi dan logika bisnis
│   ├── Console/                # Artisan commands
│   ├── Exceptions/             # Kelas untuk menangani pengecualian
│   ├── Http/                   # Semua HTTP controller, middleware, request, dll.
│   ├── Models/                 # Model Eloquent untuk tabel database
│   └── Providers/              # Service Providers
├── bootstrap/                  # File untuk bootstrap Laravel
├── config/                     # File konfigurasi aplikasi
├── database/                   # Migrasi, factory, dan seeder
│   ├── factories/              # Factory untuk testing dan seeding
│   ├── migrations/             # Migrasi database
│   └── seeds/                  # Seeder untuk mengisi data awal
├── public/                     # Public assets (CSS, JS, gambar)
│   ├── css/
│   ├── js/
│   └── images/
├── resources/                  # View, bahasa, dan file lainnya
│   ├── views/                  # Blade templates
│   ├── lang/                   # Bahasa lokal
│   └── sass/                   # SASS files
├── routes/                     # Semua rute web dan API
│   ├── web.php                 # Rute untuk aplikasi web
│   └── api.php                 # Rute untuk API
├── storage/                    # Penyimpanan untuk cache, log, dan file lainnya
│   ├── app/                    # Penyimpanan file aplikasi
│   ├── framework/              # Cache dan session
│   └── logs/                   # Log aplikasi
├── tests/                      # Direktori untuk unit dan feature testing
│   ├── Feature/                # Testing fitur aplikasi
│   └── Unit/                   # Testing unit
├── .env                        # Konfigurasi lingkungan aplikasi
├── .gitignore                  # Menentukan file dan folder yang diabaikan oleh git
├── composer.json               # Dependensi PHP proyek
├── package.json                # Dependensi JavaScript
└── artisan                     # Command-line tool untuk Laravel
```
### Dokumentasi Laravel: Model, Routes, dan Fungsi Model

#### 1. Model pada Laravel: Pengertian, Fungsi, dan Cara Membuatnya

##### Pengertian Model dalam Laravel
Model dalam Laravel adalah representasi dari tabel dalam database. Model ini digunakan untuk berinteraksi dengan data dalam tabel database melalui **Eloquent ORM (Object-Relational Mapping)**. Setiap model biasanya memiliki satu tabel yang terkait dan berfungsi untuk mengatur query database seperti `SELECT`, `INSERT`, `UPDATE`, dan `DELETE`.

##### Fungsi Model dalam Laravel
1. **Interaksi dengan Database**: Model berfungsi sebagai penghubung antara aplikasi dengan tabel database.
2. **Penyederhanaan Query**: Laravel menggunakan Eloquent ORM untuk menulis query SQL dengan cara yang lebih sederhana dan ekspresif.
3. **Validasi dan Business Logic**: Model juga dapat digunakan untuk menambahkan logika bisnis dan validasi sebelum data disimpan di database.
4. **Relasi Antar Tabel**: Model memungkinkan kita untuk mendefinisikan relasi antar tabel seperti `One-to-Many`, `Many-to-Many`, `HasOne`, dll.

##### Contoh Model di Laravel

Misalkan kita memiliki sebuah tabel `rooms` yang berfungsi untuk menyimpan informasi kamar di hotel. Maka kita bisa membuat model `Room` untuk berinteraksi dengan tabel tersebut.

#### Membuat Model:
```bash
php artisan make:model Room
```
#### Membuat Relasi Antar Tabel pada Model

##### 1. One-to-Many:
``` bash
public function reservations()
{
    return $this->hasMany(Reservation::class);
}
```
##### 2. Many-to-One:
``` bash
public function roomType()
{
    return $this->belongsTo(RoomType::class);
}
```
### 2. Routes pada Laravel: Pengertian dan Fungsi 

##### Pengertian Routes

Routes di Laravel digunakan untuk mendefinisikan URL yang dapat diakses dan menghubungkannya dengan aksi atau fungsi tertentu. Dalam Laravel, file routes terletak di dalam folder routes/, dan setiap rute berfungsi untuk menentukan bagaimana aplikasi merespons request HTTP (seperti GET, POST, PUT, DELETE).
Jenis-jenis Routes:

    Web Routes (web.php): Digunakan untuk aplikasi berbasis web.
    API Routes (api.php): Digunakan untuk aplikasi berbasis API.
    Artisan Routes: Untuk membuat command-line commands melalui Artisan.

Contoh Web Route (routes/web.php)
```bash
use App\Http\Controllers\RoomController;

Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
```
### 3. Model dan Fungsi-Fungsinya di Laravel

Model di Laravel memiliki banyak fungsi yang dapat membantu Anda berinteraksi dengan database dan mempermudah proses pengelolaan data. Berikut adalah beberapa fungsi penting yang sering digunakan:

##### a. Fungsi untuk Menyimpan Data

Untuk menyimpan data menggunakan Eloquent, Anda bisa menggunakan metode create() atau save().

``` bash
// Menggunakan create()
Room::create([
    'room_number' => '101',
    'room_type_id' => 1,
    'status' => 'available'
]);

// Menggunakan save()
$room = new Room();
$room->room_number = '102';
$room->room_type_id = 2;
$room->status = 'available';
$room->save();
```
#### b. Fungsi untuk Mengambil Data
Untuk mengambil data dari tabel menggunakan model, Anda bisa menggunakan metode all(), find(), atau where().
``` bash
// Mengambil semua data
$rooms = Room::all();

// Mengambil data berdasarkan ID
$room = Room::find(1);

// Mengambil data dengan kondisi
$availableRooms = Room::where('status', 'available')->get();
```
#### c. Fungsi untuk Mengupdate Data
Untuk mengupdate data menggunakan Eloquent, Anda bisa menggunakan metode update() atau mengubah atribut model langsung.
``` bash
$room = Room::find(1);
$room->status = 'occupied';
$room->save();

// Atau menggunakan update langsung
Room::where('id', 1)->update(['status' => 'occupied']);
```
#### d. Fungsi untuk Menghapus Data
Untuk menghapus data, Anda bisa menggunakan metode delete().
``` bash
// Menghapus berdasarkan ID
Room::find(1)->delete();

// Atau menghapus berdasarkan kondisi
Room::where('status', 'available')->delete();
```
### 4. Controller pada Laravel: Pengertian, Fungsi, dan Cara Membuatnya

#### Pengertian Controller
Controller di Laravel adalah komponen yang bertanggung jawab untuk menangani logika aplikasi dan merespons request HTTP yang masuk. Controller menerima request, memprosesnya, dan memberikan respon yang sesuai (seperti tampilan atau data).

#### Fungsi Controller:
1. **Menangani Permintaan HTTP**: Controller berfungsi untuk menangani request yang dikirimkan ke aplikasi dan memprosesnya.
2. **Mengelola Logika Bisnis**: Controller memungkinkan pemisahan logika aplikasi dari view atau model, membuat kode lebih terstruktur.
3. **Menghubungkan Routes dan Views**: Controller menghubungkan routes dengan views atau aksi lainnya.

#### Cara Membuat Controller:
Untuk membuat controller di Laravel, Anda bisa menggunakan perintah Artisan berikut:

##### Membuat Controller:
```bash
php artisan make:controller RoomController
```
#### Contoh Isi Controller:
``` bash
<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Menampilkan daftar kamar
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    // Menampilkan detail kamar
    public function show($id)
    {
        $room = Room::find($id);
        return view('rooms.show', compact('room'));
    }

    // Menyimpan data kamar
    public function store(Request $request)
    {
        Room::create([
            'room_number' => $request->room_number,
            'room_type_id' => $request->room_type_id,
            'status' => $request->status,
        ]);

        return redirect()->route('rooms.index');
    }

    // Mengupdate data kamar
    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        $room->update([
            'room_number' => $request->room_number,
            'room_type_id' => $request->room_type_id,
            'status' => $request->status,
        ]);

        return redirect()->route('rooms.index');
    }

    // Menghapus kamar
    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('rooms.index');
    }
}
```
#### Menentukan Routes untuk Controller:

Setelah membuat controller, Anda dapat menentukan route untuk controller di file routes/web.php:
``` bash
use App\Http\Controllers\RoomController;

Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
```
### 5. .env pada Laravel: Pengertian dan Cara Menggunakannya

#### Pengertian File .env

File .env adalah file konfigurasi yang digunakan di Laravel untuk menyimpan variabel lingkungan (environment variables) yang dapat disesuaikan untuk setiap lingkungan pengembangan atau produksi (development/production). File ini menyimpan informasi penting seperti kredensial database, API keys, dan pengaturan aplikasi lainnya yang harus dirahasiakan dan mudah diubah.
Fungsi File .env:

Menyimpan Konfigurasi Sensitif: Semua informasi sensitif seperti password atau API keys tidak perlu disimpan di dalam kode sumber, melainkan di dalam file .env.
    Pengaturan Lingkungan: Anda dapat memiliki pengaturan yang berbeda untuk lingkungan pengembangan dan produksi tanpa mengubah kode sumber.
    Mengonfigurasi Aplikasi dengan Mudah: File .env memungkinkan Anda untuk mengonfigurasi aplikasi Laravel dengan mudah menggunakan variabel-variabel yang dapat dipanggil di seluruh aplikasi.

Contoh Isi File .env:

File .env biasanya terletak di root directory dari proyek Laravel Anda.
``` bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:randomkeygenerated
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel_management
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
Penjelasan Beberapa Konfigurasi di .env:

    APP_NAME: Nama aplikasi Anda.
    APP_ENV: Lingkungan aplikasi (misalnya local atau production).
    DB_CONNECTION: Jenis database yang digunakan (misalnya mysql).
    DB_HOST: Host dari database Anda (misalnya 127.0.0.1).
    DB_DATABASE: Nama database yang digunakan.
    **MAIL_*: Pengaturan untuk email, seperti SMTP server dan kredensial.

Mengakses Variabel .env di Laravel:

Untuk mengakses variabel dari file .env, Anda dapat menggunakan helper env() dalam kode Laravel Anda.

Contoh mengakses pengaturan database:
```
$database = env('DB_DATABASE');
```
Ini akan mengambil nilai dari variabel DB_DATABASE yang ada di file .env.
Mengonfigurasi Kunci APP_KEY:

File .env juga menyimpan kunci aplikasi (APP_KEY) yang digunakan untuk mengenkripsi data. Anda dapat menghasilkan kunci ini dengan menjalankan perintah Artisan:
```
php artisan key:generate
```

