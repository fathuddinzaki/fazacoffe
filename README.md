# Faza Coffee

Website katalog dan pengelolaan produk Faza Coffee, brand dari PT Fathuddin Zaki.

## Menjalankan aplikasi

Project menggunakan SQLite yang dikonfigurasi di `.env`.

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Login admin

Halaman login admin: `http://127.0.0.1:8000/admin/login`.

Buat akun admin lokal melalui command interaktif berikut. Nama, email, dan password diminta saat command berjalan; password disimpan dalam bentuk hash.

```bash
php artisan admin:create
```

Password admin minimal 12 karakter. Jalankan command lagi dengan email yang sama untuk memperbarui akun atau password. Tidak ada akun/password default yang disimpan di source code.

## Fitur

- Halaman publik: Home, katalog, detail produk, About, dan Contact.
- Dashboard admin dengan autentikasi dan proteksi halaman.
- CRUD produk dan kategori, pencarian produk, serta pagination.
- Upload foto produk ke `storage/app/public/products`; jalankan `php artisan storage:link` agar foto dapat ditampilkan.
- Seeder berisi 8 produk dan 3 kategori contoh.

Foto produk tersedia di `storage/app/public/products` dan ditampilkan melalui link `public/storage`. Gambar logo tersedia di `public/images/faza_coffee.png`. Produk tanpa foto memakai placeholder sampai foto diunggah lewat admin.

## Pengujian

```bash
php artisan test
```
