## Deploy menggunakan docker
**Clone repository**

```sh
git clone https://github.com/rizki182/eigen-rizki.git
```

**Masuk ke folder project**
```sh
cd eigen-rizki
```
**Konfigurasi awal**

Buka file **.env** lalu saisuaikan isi **NGINX_PORT** dengan port yang belum dipakai

**Deploy**
```sh
docker compose up
```
Tunggu hingga proses deployment selesai. Jika log menampilkan teks berikut aplikasi sudah dapat digunakan
```sh
NOTICE: ready to handle connections
```
Jika sudah selesai akses alamat berikut melalui browser
```sh
http://localhost:{NGINX_PORT}
```
![image](https://github.com/rizki182/eigen-rizki/assets/6510392/52ee8bb9-6fde-4104-ad40-1bc8c4488ee1)

## Troubleshoot
Jika proses deploy atau install dependencies gagal tambahkan atau edit file **/etc/docker/daemon.json**
```sh
{
  "dns": ["8.8.8.8", "8.8.4.4"]
}
```
Lalu restart service docker
