![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue)
![Laravel](https://img.shields.io/badge/Laravel-12.x-red)
![healthchecks.io](https://img.shields.io/endpoint?url=https%3A%2F%2Fhealthchecks.io%2Fbadge%2F94af4d66-8352-4c4d-96fa-f288c0%2FW9MqTZ9y.shields)
[![Latest Stable Version](https://poser.pugx.org/vicky-project/coreui-module/v/stable)](https://packagist.org/packages/vicky-project/coreui-module)
![GitHub last commit](https://img.shields.io/github/last-commit/vicky-project/coreui/main)
[![Total Downloads](https://poser.pugx.org/vicky-project/coreui-module/downloads)](https://packagist.org/packages/vicky-project/coreui-module)
[![License](https://poser.pugx.org/vicky-project/coreui-module/license)](https://packagist.org/packages/vicky-project/coreui-module)

# Persyaratan Sebelum Memulai

- Proyek Laravel harus sudah ada. Jika belum, silakan buat terlebih dahulu mengikuti dokumentasi resmi Laravel.
- PHP versi 8.2 atau lebih baru.
- Composer terinstal di komputer Anda.

# Langkah-Langkah Instalasi

1. Pastikan Proyek Laravel Sudah Siap

Jika sudah memiliki proyek Laravel, lanjut ke langkah 2.
Jika belum, buat proyek baru dengan perintah:

```bash
composer create-project laravel/laravel nama-proyek-anda
cd nama-proyek-anda
```

2. Instal Module Menggunakan Composer

Jalankan perintah berikut di dalam folder root proyek Laravel Anda:

```bash
composer require vicky-project/coreui-module
```

Perintah ini akan mengunduh dan memasang module beserta semua dependensi yang diperlukan.

3. Tambahkan Konfigurasi ke File composer.json

Buka file composer.json yang berada di root folder proyek Anda.
Anda perlu menambahkan beberapa baris konfigurasi di dalam bagian "extra", "config", dan "autoload".

🔧 Bagian "extra"

Cari kunci "extra" di dalam file composer.json. Jika belum ada, buat.
Tambahkan kode berikut:

```json
"extra": {
    "laravel": {
        "dont-discover": []
    },
    "merge-plugin": {
        "include": [
            "Modules/*/composer.json"
        ],
        "recurse": true,
        "replace": false,
        "merge-dev": true,
        "merge-extra": true
    },
    "module-dir": "Modules"
},
```

> [!WARNING]
> **Perhatikan tanda koma (`,`) pada file `composer.json`.**  
> Setiap penambahan konfigurasi harus memperhatikan posisi koma agar tidak merusak format JSON. Kesalahan koma akan mengakibatkan error saat menjalankan `composer` atau `php artisan`.

> [!WARNING]
> jika anda menggunakan laravel versi 13 atau diatasnya, ganti `"merge-dev": true` menjadi `"merge-dev": false` agar package dari `require-dev` tidak ikut terdownload. Karena ada beberapa package vendor yang belum mendukung laravel versi 3 atau yang lebih baru. Anda dapat mengembalikan ke true jika semua vendor telah mendukung laravel terbaru.

⚙️ Bagian "config"

Cari kunci "config". Tambahkan atau sesuaikan sehingga berisi:

```json
"config": {
    "optimize-autoloader": true,
    "preferred-install": "dist",
    "sort-packages": true,
    "allow-plugins": {
        "joshbrw/laravel-module-installer": true,
        "pestphp/pest-plugin": true,
        "php-http/discovery": true,
        "wikimedia/composer-merge-plugin": true
    }
},
```

📁 Bagian "autoload"

Cari kunci "autoload". Di dalam bagian "psr-4", tambahkan baris berikut (jika sudah ada baris lain, letakkan setelah baris terakhir dan beri koma):

```json
"autoload": {
    "psr-4": {
        // ... baris yang sudah ada (misal: "App\\": "app/",)
        "Modules\\": "Modules/"
    }
},
```

💡 Contoh lengkap setelah ditambahkan:
```json
"Modules\\": "Modules/"
```

> [!NOTE]
> Module ini menggunakan library **[nwidart/laravel-modules](https://laravelmodules.com/)**.  
> Lihat [dokumentasi resmi](https://laravelmodules.com/docs) untuk informasi lebih lanjut.

4. Perbarui Autoloader Composer

Setelah mengedit composer.json, jalankan perintah:

```bash
composer dump-autoload
```

5. Jalankan Migrasi Database

Module ini membutuhkan tabel-tabel database. Jalankan perintah berikut:

```bash
php artisan migrate
```

Jika ada pertanyaan tentang database yang belum disiapkan, pastikan Anda sudah mengatur koneksi database di file .env.

---

🛠️ Perintah Tambahan yang Tersedia

Setelah module terinstal, Anda bisa menggunakan perintah artisan berikut:

Instal Module Tertentu

```bash
php artisan app:install [nama_module]
```

Ganti [nama_module] dengan nama module yang ingin diinstal (contoh: coreui).

Lihat Daftar Semua Perintah dari Module

```bash
php artisan app help
```

Perintah ini akan menampilkan semua perintah artisan yang tersedia di dalam namespace app, termasuk yang disediakan oleh module.

# Verifikasi Instalasi

Untuk memastikan semuanya berjalan lancar:

1. Coba jalankan php artisan app help – Anda akan melihat daftar perintah.
2. Coba akses aplikasi Laravel Anda melalui browser. Jika module menambahkan rute atau tampilan, seharusnya sudah tersedia.

# Tips & Pemecahan Masalah

| Masalah | Solusi |
|---------|--------|
| `Class "Modules\... not found` | Pastikan Anda sudah menjalankan `composer dump-autoload` setelah mengedit `composer.json`. |
| `Composer merge-plugin` error | Pastikan plugin `wikimedia/composer-merge-plugin` sudah diizinkan di bagian `allow-plugins`. |
| Migrasi gagal | Periksa koneksi database di file `.env`. Jalankan `php artisan migrate:fresh` jika ingin memulai ulang. |
| Perintah `app:install` tidak dikenal | Cek apakah module sudah terinstal dengan benar. Jalankan `composer require` sekali lagi jika perlu. |
