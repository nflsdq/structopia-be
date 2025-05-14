# Dokumentasi API Structopia

## Pengenalan

Dokumen ini berisi panduan lengkap untuk menggunakan REST API Structopia. API ini digunakan untuk aplikasi pembelajaran yang mengimplementasikan sistem level, materi dengan tipe VAK (Visual, Auditory, Kinesthetic), dan gamifikasi.

## Autentikasi

API ini menggunakan Laravel Sanctum untuk autentikasi token. Untuk mengakses endpoint yang dilindungi, sertakan header berikut dalam setiap permintaan:

```
Authorization: Bearer YOUR_API_TOKEN
```

Token didapatkan setelah berhasil login ke sistem.

## Struktur Dokumentasi

Dokumentasi ini terdiri dari beberapa bagian:

1. [Dokumentasi API (api.md)](api.md) - Deskripsi detail dari semua endpoint yang tersedia, termasuk parameter dan respons yang diharapkan
2. [Koleksi Postman (postman_collection.json)](postman_collection.json) - Koleksi Postman yang dapat diimpor untuk menguji API

## Cara Menggunakan Dokumentasi

### Petunjuk untuk Dokumentasi API

Buka file [api.md](api.md) untuk melihat dokumentasi lengkap dari setiap endpoint API. Dokumentasi mencakup:

-   URL endpoint
-   Metode HTTP
-   Kebutuhan autentikasi
-   Parameter yang diperlukan
-   Format respons

### Petunjuk untuk Koleksi Postman

1. Download [Postman](https://www.postman.com/downloads/)
2. Buka Postman dan pilih "Import"
3. Unggah file [postman_collection.json](postman_collection.json)
4. Sesuaikan variabel koleksi:
    - `base_url`: URL dasar API (default: http://localhost:8000)
    - `token`: Token autentikasi setelah login

## Fungsi Utama API

API Structopia menyediakan beberapa fungsi utama:

1. **Manajemen Pengguna**: Daftar, login, dan manajemen data pengguna
2. **Sistem Level**: Manajemen level pembelajaran dan progres pengguna
3. **Materi Pembelajaran**: Konten belajar dengan tipe VAK (Visual, Auditory, Kinesthetic)
4. **Quiz dan Evaluasi**: Sistem kuis untuk mengevaluasi pemahaman pengguna
5. **Gamifikasi**: Sistem badge dan leaderboard untuk meningkatkan motivasi belajar

## Catatan Penting

-   API ini menggunakan pagination untuk endpoint yang mengembalikan banyak data dengan parameter `per_page` (default: 10)
-   Beberapa endpoint hanya dapat diakses oleh pengguna dengan peran admin
-   Untuk endpoint yang memerlukan ID dalam URL (contoh: `/levels/{id}`), ganti `{id}` dengan ID yang sesuai
