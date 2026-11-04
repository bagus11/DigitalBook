# Deployment DigitalBook

Aplikasi dilayani di **https://ict.pralon.com/digital-book** dari host `192.168.1.9`, memakai pola
yang sama dengan IMS, Work Order, LIMS, dan Partner Management di host itu.

## Bentuknya

| bagian | isi |
| --- | --- |
| container | `digital-book-php` (image dibangun dari `docker/php/Dockerfile`, `php:8.2-fpm`) dan `digital-book-nginx` (`nginx:1.25-alpine`) |
| jaringan | `shared_network` (eksternal, dipakai bersama aplikasi lain di host itu) |
| port | `8088` → nginx host memproksi `/digital-book/` ke `127.0.0.1:8088` |
| database | MySQL `192.168.1.136`, `digital_book`; koneksi kedua (`mysql2`) ke `work_order` untuk tabel master |
| berkas | direktori proyek di-bind-mount ke container, jadi `vendor/` dipasang di direktori ini, bukan di dalam image |

Prefix `/digital-book` hanya bekerja bila aplikasinya tahu: `TrustProxies` mempercayai
`X-Forwarded-Prefix`, dan `AppServiceProvider` memaksa root URL ke `APP_URL` saat production. CSS
hasil Laravel Mix memakai `setResourceRoot('/digital-book/')` supaya `url(...)` di dalamnya ikut
berprefix.

## Rilis manual

```bash
cd /var/www/html/DigitalBook
sudo deploy/deploy.sh
```

Urutannya: `git pull` → build image → `up -d` → `composer install` → bersihkan cache → cek
`http://127.0.0.1:8088/` harus 200. Kalau cek terakhir gagal, skripnya keluar dengan status bukan nol
dan container lama tetap jalan.

## Rilis otomatis

`deploy/auto-deploy.sh` membandingkan commit lokal dengan `origin`, dan hanya menjalankan
`deploy.sh` kalau ada commit baru. Pasang sekali sebagai cron root:

```bash
sudo tee /etc/cron.d/digital-book >/dev/null <<'CRON'
*/2 * * * * root /var/www/html/DigitalBook/deploy/auto-deploy.sh
CRON
sudo chmod 644 /etc/cron.d/digital-book
```

Setelah itu setiap push ke `main` naik ke server paling lama dua menit kemudian. Catatannya ada di
`/var/log/digital-book-deploy.log`:

```bash
sudo tail -f /var/log/digital-book-deploy.log
```

Untuk mematikannya: `sudo rm /etc/cron.d/digital-book`.

## Yang tidak ikut git

`.env` tidak ada di repo. Di server isinya mewarisi kredensial dari IMS; yang khas aplikasi ini:

```
APP_URL=https://ict.pralon.com/digital-book
ASSET_URL=https://ict.pralon.com/digital-book
DB_DATABASE=digital_book
DB_DATABASE_SECOND=work_order
SESSION_COOKIE=digital_book_session
SESSION_PATH=/digital-book
SESSION_DOMAIN=ict.pralon.com
```

Lampiran (`storage/app/public/...`) juga tidak ikut git; berkasnya dibawa terpisah dan disajikan
lewat symlink `public/storage`.
