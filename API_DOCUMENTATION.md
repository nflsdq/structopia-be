# Dokumentasi API Structopia

## Daftar Isi

-   [Autentikasi](#autentikasi)
-   [Level](#level)
-   [Materi](#materi)
-   [Quiz](#quiz)
-   [Progress](#progress)
-   [Badges](#badges)
-   [Leaderboard](#leaderboard)

## Autentikasi

### Register

-   **Endpoint**: `POST /api/register`
-   **Deskripsi**: Mendaftarkan pengguna baru
-   **Request Body**:
    ```json
    {
        "name": "string",
        "email": "string",
        "password": "string",
        "role": "in:student,admin"
    }
    ```
-   **Response**: Token autentikasi dan data pengguna

### Login

-   **Endpoint**: `POST /api/login`
-   **Deskripsi**: Login pengguna
-   **Request Body**:
    ```json
    {
        "email": "string",
        "password": "string"
    }
    ```
-   **Response**: Token autentikasi dan data pengguna

### Logout

-   **Endpoint**: `POST /api/logout`
-   **Deskripsi**: Logout pengguna
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Pesan sukses

### Get User

-   **Endpoint**: `GET /api/user`
-   **Deskripsi**: Mendapatkan data pengguna yang sedang login
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Data pengguna

## Level

### Get All Levels

-   **Endpoint**: `GET /api/levels`
-   **Deskripsi**: Mendapatkan semua level
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Daftar level

### Get Level by ID

-   **Endpoint**: `GET /api/levels/{id}`
-   **Deskripsi**: Mendapatkan detail level berdasarkan ID
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Detail level

### Get Level Materi

-   **Endpoint**: `GET /api/levels/{id}/materi`
-   **Deskripsi**: Mendapatkan materi untuk level tertentu
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Daftar materi untuk level tersebut

### Create Level (Admin)

-   **Endpoint**: `POST /api/levels`
-   **Deskripsi**: Membuat level baru (hanya admin)
-   **Headers**: `Authorization: Bearer {token}`
-   **Request Body**:
    ```json
    {
        "name": "string",
        "order": "integer",
        "description": "string"
    }
    ```
-   **Response**: Data level yang baru dibuat

### Update Level (Admin)

-   **Endpoint**: `PUT /api/levels/{id}`
-   **Deskripsi**: Mengupdate level (hanya admin)
-   **Headers**: `Authorization: Bearer {token}`
-   **Request Body**:
    ```json
    {
        "name": "string",
        "order": "integer",
        "description": "string"
    }
    ```
-   **Response**: Data level yang diupdate

### Delete Level (Admin)

-   **Endpoint**: `DELETE /api/levels/{id}`
-   **Deskripsi**: Menghapus level (hanya admin)
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Pesan sukses

## Materi

### Get Materi by ID

-   **Endpoint**: `GET /api/materi/{id}`
-   **Deskripsi**: Mendapatkan detail materi berdasarkan ID
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Detail materi

### Create Materi (Admin)

-   **Endpoint**: `POST /api/materi`
-   **Deskripsi**: Membuat materi baru (hanya admin)
-   **Headers**: `Authorization: Bearer {token}`
-   **Request Body**:
    ```json
    {
        "level_id": "integer",
        "title": "string",
        "type": "string",
        "content": "string",
        "media_url": "string"
    }
    ```
-   **Response**: Data materi yang baru dibuat

### Update Materi (Admin)

-   **Endpoint**: `PUT /api/materi/{id}`
-   **Deskripsi**: Mengupdate materi (hanya admin)
-   **Headers**: `Authorization: Bearer {token}`
-   **Request Body**:
    ```json
    {
        "level_id": "integer",
        "title": "string",
        "type": "string",
        "content": "string",
        "media_url": "string"
    }
    ```
-   **Response**: Data materi yang diupdate

### Delete Materi (Admin)

-   **Endpoint**: `DELETE /api/materi/{id}`
-   **Deskripsi**: Menghapus materi (hanya admin)
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Pesan sukses

## Quiz

### Get Level Quiz

-   **Endpoint**: `GET /api/levels/{id}/quiz`
-   **Deskripsi**: Mendapatkan quiz untuk level tertentu
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Daftar pertanyaan quiz

### Submit Quiz

-   **Endpoint**: `POST /api/quiz/submit`
-   **Deskripsi**: Mengirim jawaban quiz
-   **Headers**: `Authorization: Bearer {token}`
-   **Request Body**:
    ```json
    {
        "quiz_id": "integer",
        "answers": {
            "question_id": "answer"
        }
    }
    ```
-   **Response**: Hasil quiz dan skor

### Get Quiz History

-   **Endpoint**: `GET /api/quiz/history`
-   **Deskripsi**: Mendapatkan riwayat quiz pengguna
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Riwayat quiz

## Progress

### Get Progress

-   **Endpoint**: `GET /api/progress`
-   **Deskripsi**: Mendapatkan progress pengguna
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Data progress

### Update Progress

-   **Endpoint**: `POST /api/progress/update`
-   **Deskripsi**: Mengupdate progress pengguna
-   **Headers**: `Authorization: Bearer {token}`
-   **Request Body**:
    ```json
    {
        "level_id": "integer",
        "status": "string",
        "score": "integer"
    }
    ```
-   **Response**: Data progress yang diupdate

### Get Unlocked Levels

-   **Endpoint**: `GET /api/progress/unlocked-levels`
-   **Deskripsi**: Mendapatkan daftar level yang sudah dibuka
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Daftar level yang sudah dibuka

## Badges

### Get All Badges

-   **Endpoint**: `GET /api/badges`
-   **Deskripsi**: Mendapatkan semua badge yang tersedia
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Daftar badge

### Get User Badges

-   **Endpoint**: `GET /api/user/badges`
-   **Deskripsi**: Mendapatkan badge yang dimiliki pengguna
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Daftar badge pengguna

### Assign Badge

-   **Endpoint**: `POST /api/user/badges/assign`
-   **Deskripsi**: Menambahkan badge ke pengguna
-   **Headers**: `Authorization: Bearer {token}`
-   **Request Body**:
    ```json
    {
        "badge_id": "integer"
    }
    ```
-   **Response**: Data badge yang ditambahkan

## Leaderboard

### Get Leaderboard

-   **Endpoint**: `GET /api/leaderboard`
-   **Deskripsi**: Mendapatkan peringkat pengguna
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**: Daftar peringkat pengguna

## Catatan Penting

1. Semua endpoint kecuali register dan login memerlukan token autentikasi
2. Endpoint dengan label (Admin) hanya dapat diakses oleh pengguna dengan role admin
3. Format response untuk semua endpoint menggunakan format JSON
4. Semua request harus menyertakan header `Accept: application/json`
5. Untuk request yang memerlukan file upload, gunakan `multipart/form-data`
