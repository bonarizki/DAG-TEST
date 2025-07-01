# Laravel API – Instruksi Menjalankan

Repositori ini berisi project Laravel API yang berada di dalam folder `soal3/laravel-api`.

## 📦 Prasyarat

- PHP >= 8.1
- Composer

## 🛠️ Versi Laravel

- Laravel Framework **12.19.3**

## 🚀 Cara Menjalankan Project

1. **Masuk ke folder project:**
    ```bash
    cd soal3/laravel-api
    ```

2. **Install dependency PHP:**
    ```bash
    composer install
    ```

3. **Copy file environment:**
    ```bash
    cp .env.example .env
    ```

4. **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5. **Jalankan server Laravel:**
    ```bash
    php artisan serve
    ```
    Akses API di [http://localhost:8000](http://localhost:8000)

## 📝 Catatan

- Project ini **tidak membutuhkan koneksi database**.
- Endpoint utama API dapat dilihat dan diubah pada file `routes/api.php`.
- Untuk testing, gunakan tools seperti Postman atau cURL.

## 📖 Dokumentasi Swagger

- Dokumentasi API otomatis dapat diakses melalui Swagger UI.
- Untuk melihat dokumentasi Swagger, buka:
    ```
    http://localhost:8000/api/documentation
    ```

## 📂 Struktur Folder

- `app/` – Kode utama aplikasi (controller, helper, dsb)
- `routes/api.php` – Daftar endpoint API
- `config/` – Konfigurasi aplikasi
- `storage/api-docs/api.yaml` – File dokumentasi OpenAPI (Swagger)

---

**Selamat mencoba!**