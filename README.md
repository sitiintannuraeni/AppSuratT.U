## About
Merupakan aplikasi untuk Pengelolaan Surat yang dibuat menggunakan bahasa pemrograman PHP, HTML, dan CSS.
untuk framework yang digunakan adalah Laravel dari PHP dan Bootstrap UI. Projek ini merupakan tugas
uji kelayakan sekaligus penilaian semester di kelas XI.

## Detail Library
Daftar library yang digunakan didalam aplikasi ini sebagai berikut :
- Laravel UI : untuk menginstall ui bootstrap dan auth untuk login
- maatwebsite/excel : untuk export data excel
- dompdf/dompdf : untuk mengubah html menjadi pdf
- Laravel MIX : untuk mengubah data scss menjadi css

## Reference
- https://medium.com/@danrovito/replace-vite-with-mix-in-laravel-9-2-ce994fdb2253
- https://www.cambotutorial.com/article/laravel-9-login-multiple-roles-using-custom-middleware
- https://adevait.com/laravel/laravel-overwriting-default-pagination-system

## Setup Environment

- Copy file `.env.example` to `.env`

  ```
  cp .env.example .env
  ```

- Change Database Connection from .env :
- - DB_DATABASE : isi nama database
- - DB_USERNAME : isi user database
- - DB_PASSWORD : isi password database jika ada

## Installation
- Install Dependency
  ```bash
  composer install
  ```

- Generate Key
  ```bash
  php artisan key:generate
  ```

- Move Storage to public (untuk mengakses gambar yang di upload di local storage)
  ```bash
  php artisan storage:link
  ```

- Build Assets (untuk mengcompile styling scss to css agar dapat dibaca browser)
  ```bash
  npm install & npm run dev
  ```

- Running App
  ```bash
  php artisan serve
  ```
  
## Greetings
Selamat mencoba!!<br>
SITI INTAN NURAENI FROM PPLG XI-2 :)