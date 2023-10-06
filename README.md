## Deploy menggunakan docker
**Clone repository**

```sh
git clone https://github.com/rizki182/eigen-rizki.git
```

**Masuk ke folder docker**
```sh
cd eigen-rizki/docker
```

**Deploy**
```sh
docker compose up -d
```
**Install dependencies**<br />
Setelah proses deploy selesai, sebelum dapat digunakan aplikasi akan menginstall dependencies secara otomatis. Untuk melihat proses install jalankan perintah berikut untuk menampilkan logs
```sh
docker logs -f eigen-rizki-php
```
Jika logs menampilkan teks berikut aplikasi sudah dapat digunakan
```sh
NOTICE: fpm is running, pid 275
NOTICE: ready to handle connections
```
Setelah proses install dependencies selesai akses url berikut melalui browser.li sampai aplikasi bisa diakses
```sh
http://localhost:9090
```

## Troubleshoot
Jika proses deploy atau install dependencies gagal tambahkan atau edit file **/etc/docker/daemon.json**
```sh
{
  "dns": ["8.8.8.8", "8.8.4.4"]
}
```
Lalu restart service docker
