## Requirements
- PHP >=7.2
- More...

## Cara Install
- copy .env.example , lalu rename menjadi .env
- Nyalakan **MySQL** pastikan database sudah dibuat.
- Jalankan `composer install`, `php artisan migrate --seed` / `php artisan migrate:fresh --seed`
- Lalu jalankan `php artisan key:generate`
- Jalankan `php artisan serve` untuk menjalankan Laravel dengan port `127.0.0.1:8000`
- Jalankan `npm install && npm run dev` jika diperlukan 
- Jalankan perintah  `php artisan storage:link` jika storage tidak dapat diakses

## Akses User
- Akses user pada laman /login
- Login menggunakan username dan password sebagai berikut :
    - user => username : `admin@transisi.id`, password:`transisi`  
- Jika tidak dapat mengakses user, silahkan migrasi dan seed ulang dengan `php artisan migrate:fresh --seed` atau `php artisan migrate:refresh --seed`

## Sample tampilan jika berhasil
<img src="https://github.com/fikrihashfi/transisi/blob/master/bagian_2/sample%20success.png" width="400">
