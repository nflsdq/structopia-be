# Dokumentasi API Structopia

## Autentikasi

### Register

-   **URL**: `/api/register`
-   **Method**: `POST`
-   **Auth**: Tidak
-   **Parameter**:
    -   `name` (string, wajib) - Nama pengguna
    -   `email` (string, wajib) - Email pengguna (harus unik)
    -   `password` (string, wajib) - Password (minimal 8 karakter)
    -   `role` (string, wajib) - Peran pengguna (`student` atau `admin`)
-   **Response**:
    -   Sukses (201):
        ```json
        {
          "message": "User registered successfully",
          "user": { ... },
          "token": "token_autentikasi"
        }
        ```
    -   Error (422): Validasi error
    -   Error (500): Server error

### Login

-   **URL**: `/api/login`
-   **Method**: `POST`
-   **Auth**: Tidak
-   **Parameter**:
    -   `email` (string, wajib) - Email pengguna
    -   `password` (string, wajib) - Password
-   **Response**:
    -   Sukses (200):
        ```json
        {
          "message": "Login successful",
          "user": { ... },
          "token": "token_autentikasi"
        }
        ```
    -   Error (401): Email atau password salah
    -   Error (404): User tidak ditemukan
    -   Error (422): Validasi error
    -   Error (500): Server error

### Logout

-   **URL**: `/api/logout`
-   **Method**: `POST`
-   **Auth**: Ya (Bearer Token)
-   **Response**:
    -   Sukses (200):
        ```json
        {
            "message": "Successfully logged out"
        }
        ```
    -   Error (500): Server error

### User Info

-   **URL**: `/api/user`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Response**:
    -   Sukses (200): User data

## Level

### Daftar Level

-   **URL**: `/api/levels`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Parameter Query**:
    -   `per_page` (integer, opsional) - Jumlah item per halaman (default: 10)
-   **Response**:
    -   Sukses (200): List level dengan status untuk pengguna saat ini:
        -   `status`: (`unlocked`, `ongoing`, atau `locked`)
        -   `keterangan`: Deskripsi status

### Detail Level

-   **URL**: `/api/levels/{id}`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Response**:
    -   Sukses (200): Detail level dengan status
    -   Error (403): Level masih terkunci
    -   Error (404): Level tidak ditemukan

### Tambah Level (Admin)

-   **URL**: `/api/levels`
-   **Method**: `POST`
-   **Auth**: Ya (Bearer Token, Admin only)
-   **Parameter**:
    -   `name` (string, wajib) - Nama level
    -   `order` (integer, wajib) - Urutan level (harus unik)
    -   `description` (string, wajib) - Deskripsi level
-   **Response**:
    -   Sukses (201): Data level baru
    -   Error (403): Hanya admin yang bisa menambah level
    -   Error (422): Validasi error
    -   Error (500): Server error

### Update Level (Admin)

-   **URL**: `/api/levels/{id}`
-   **Method**: `PUT`
-   **Auth**: Ya (Bearer Token, Admin only)
-   **Parameter**:
    -   `name` (string, wajib) - Nama level
    -   `order` (integer, wajib) - Urutan level (harus unik)
    -   `description` (string, wajib) - Deskripsi level
-   **Response**:
    -   Sukses (200): Data level terupdate
    -   Error (403): Hanya admin yang bisa mengubah level
    -   Error (404): Level tidak ditemukan
    -   Error (422): Validasi error
    -   Error (500): Server error

### Hapus Level (Admin)

-   **URL**: `/api/levels/{id}`
-   **Method**: `DELETE`
-   **Auth**: Ya (Bearer Token, Admin only)
-   **Response**:
    -   Sukses (200): Pesan konfirmasi
    -   Error (403): Hanya admin yang bisa menghapus level
    -   Error (404): Level tidak ditemukan
    -   Error (500): Server error

### Daftar Materi Level

-   **URL**: `/api/levels/{id}/materi`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Parameter Query**:
    -   `type` (string, opsional) - Filter materi berdasarkan tipe (`visual`, `auditory`, atau `kinesthetic`)
    -   `per_page` (integer, opsional) - Jumlah item per halaman (default: 10)
-   **Response**:
    -   Sukses (200): List materi untuk level tertentu
    -   Error (403): Materi level ini masih terkunci
    -   Error (404): Level tidak ditemukan

## Materi

### Detail Materi

-   **URL**: `/api/materi/{id}`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Response**:
    -   Sukses (200): Detail materi dengan status
    -   Error (403): Materi masih terkunci
    -   Error (404): Materi tidak ditemukan

### Tambah Materi (Admin)

-   **URL**: `/api/materi`
-   **Method**: `POST`
-   **Auth**: Ya (Bearer Token, Admin only)
-   **Parameter**:
    -   `level_id` (integer, wajib) - ID level
    -   `title` (string, wajib) - Judul materi
    -   `type` (string, wajib) - Tipe materi (`visual`, `auditory`, atau `kinesthetic`)
    -   `content` (string, wajib) - Konten materi
    -   `media_url` (string, opsional) - URL media
-   **Response**:
    -   Sukses (201): Data materi baru
    -   Error (403): Hanya admin yang bisa menambah materi
    -   Error (422): Validasi error
    -   Error (500): Server error

### Update Materi (Admin)

-   **URL**: `/api/materi/{id}`
-   **Method**: `PUT`
-   **Auth**: Ya (Bearer Token, Admin only)
-   **Parameter**:
    -   `level_id` (integer, wajib) - ID level
    -   `title` (string, wajib) - Judul materi
    -   `type` (string, wajib) - Tipe materi (`visual`, `auditory`, atau `kinesthetic`)
    -   `content` (string, wajib) - Konten materi
    -   `media_url` (string, opsional) - URL media
-   **Response**:
    -   Sukses (200): Data materi terupdate
    -   Error (403): Hanya admin yang bisa mengubah materi
    -   Error (404): Materi tidak ditemukan
    -   Error (422): Validasi error
    -   Error (500): Server error

### Hapus Materi (Admin)

-   **URL**: `/api/materi/{id}`
-   **Method**: `DELETE`
-   **Auth**: Ya (Bearer Token, Admin only)
-   **Response**:
    -   Sukses (200): Pesan konfirmasi
    -   Error (403): Hanya admin yang bisa menghapus materi
    -   Error (404): Materi tidak ditemukan
    -   Error (500): Server error

## Quiz

### Daftar Quiz Level

-   **URL**: `/api/levels/{id}/quiz`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Response**:
    -   Sukses (200): List quiz untuk level tertentu
    -   Error (403): Quiz level ini masih terkunci
    -   Error (500): Server error

### Submit Quiz

-   **URL**: `/api/quiz/submit`
-   **Method**: `POST`
-   **Auth**: Ya (Bearer Token)
-   **Parameter**:
    -   `level_id` (integer, wajib) - ID level
    -   `answers` (array, wajib) - Array jawaban dengan format `{"quiz_id": "jawaban"}`
-   **Response**:
    -   Sukses (200):
        ```json
        {
            "score": 5,
            "total_questions": 10,
            "passed": true,
            "xp_gained": 100
        }
        ```
    -   Error (422): Validasi error
    -   Error (500): Server error

### Riwayat Quiz

-   **URL**: `/api/quiz/history`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Parameter Query**:
    -   `per_page` (integer, opsional) - Jumlah item per halaman (default: 10)
-   **Response**:
    -   Sukses (200): List riwayat quiz pengguna
    -   Error (500): Server error

## Progress

### Daftar Progress

-   **URL**: `/api/progress`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Parameter Query**:
    -   `per_page` (integer, opsional) - Jumlah item per halaman (default: 10)
-   **Response**:
    -   Sukses (200): List progress pengguna

### Update Progress

-   **URL**: `/api/progress/update`
-   **Method**: `POST`
-   **Auth**: Ya (Bearer Token)
-   **Parameter**:
    -   `level_id` (integer, wajib) - ID level
    -   `status` (string, wajib) - Status progress (`completed` atau `in-progress`)
-   **Response**:
    -   Sukses (200): Data progress terupdate
    -   Error (422): Validasi error
    -   Error (500): Server error

### Level yang Telah Dibuka

-   **URL**: `/api/progress/unlocked-levels`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Response**:
    -   Sukses (200): List level yang telah dibuka oleh pengguna

## Badge

### Daftar Badge

-   **URL**: `/api/badges`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Parameter Query**:
    -   `per_page` (integer, opsional) - Jumlah item per halaman (default: 10)
-   **Response**:
    -   Sukses (200): List badge yang tersedia

### Badge Pengguna

-   **URL**: `/api/user/badges`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Parameter Query**:
    -   `per_page` (integer, opsional) - Jumlah item per halaman (default: 10)
-   **Response**:
    -   Sukses (200): List badge yang dimiliki pengguna

### Assign Badge

-   **URL**: `/api/user/badges/assign`
-   **Method**: `POST`
-   **Auth**: Ya (Bearer Token)
-   **Parameter**:
    -   `badge_id` (integer, wajib) - ID badge
-   **Response**:
    -   Sukses (201): Data badge yang ditambahkan
    -   Error (422): Validasi error
    -   Error (500): Server error

## Leaderboard

### Daftar Leaderboard

-   **URL**: `/api/leaderboard`
-   **Method**: `GET`
-   **Auth**: Ya (Bearer Token)
-   **Parameter Query**:
    -   `per_page` (integer, opsional) - Jumlah item per halaman (default: 10)
-   **Response**:
    -   Sukses (200): List pengguna berdasarkan XP tertinggi
