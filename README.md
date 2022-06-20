# Enkrip dan Dekrip File

Tool untuk Enkrip dan Dekrip File menggunakan PHP dengan metode AES-128-CBC.
Dibuat dengan framework CodeIgniter 3. 

## Informasi Rilis

Tool ini menggunakan semantic versioning. Versi Terbaru adalah v1.0.0.

## Log Perubahan dan Fitur Baru

Tidak ada.

## Kebutuhan Aplikasi

Direkomendasikan menggunakan PHP versi 7.3 atau lebih tinggi.
Ekstensi PHP yang dibutuhkan :
- OpenSSL
- Ekstensi Standar PHP Lainnya

## Instalasi

Jika anda menggunakan web server Apache atau XAMPP pada windows, buat terlebih dahulu file `.htaccess` pada direktori root tool ini.

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

Lalu cek kembali file `index.php` sesuaikan nilai variabel berikut sesuai kebutuhan anda.

```
	// App directory configuration
	// If your application not in webroot, you can set application directory here
	// BEGIN WITH SLASH, NO TRAILING SLASH!
	$webdir  = '/file-encryptor';

	// Application port configuration
	// If you want to run this application in different port, put your custom port here
	// begin with :
	// Example : ':8443'
	// Default is false or use 80/443
	$port = false;
```

## Kanal Laporan Bug

Laporkan isu keamanan melalui email [berikut](mailto:mrnaeem@tutanota.com "mrnaeem@tutanota.com").

## Acknowledgement

Created by Muhammad Ridwan Na'im. Silakan gunakan, kembangkan, atau ubah-sesuaikan dengan tetap mencantumkan nama saya.