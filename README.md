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


## Unit test
Jalankan perintah berikut untuk menjalankan unit test
```sh
docker exec -it eigen-rizki-php sh -c "cd be && ./test"
```
## API
**Book List**
```sh
Request:
(GET) http://localhost:8000/api/book

Response :
{
    "status": true,
    "data": {
        "book": [
            {
                "id": 1,
                "code": "JK-45",
                "title": "Harry Potter",
                "author": "J.K Rowling",
                "stock": 2,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z"
            },
            {
                "id": 2,
                "code": "SHR-1",
                "title": "A Study in Scarlet",
                "author": "Arthur Conan Doyle",
                "stock": 3,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z"
            }
        ]
    },
    "message": ""
}
```
**Book Unit List**
```sh
Request:
(GET) http://localhost:8000/api/book/unit

Response :
{
    "status": true,
    "data": {
        "book_unit": [
            {
                "id": 1,
                "book_id": 1,
                "code": "JK-45-001",
                "status": "available",
                "borrowed_by": null,
                "borrow_date": null,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z",
                "book": {
                    "id": 1,
                    "code": "JK-45",
                    "title": "Harry Potter",
                    "author": "J.K Rowling",
                    "stock": 2,
                    "created_at": "2023-10-06T15:18:41.000000Z",
                    "updated_at": "2023-10-06T15:18:41.000000Z"
                },
                "member": null
            },
            {
                "id": 2,
                "book_id": 1,
                "code": "JK-45-002",
                "status": "available",
                "borrowed_by": null,
                "borrow_date": null,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z",
                "book": {
                    "id": 1,
                    "code": "JK-45",
                    "title": "Harry Potter",
                    "author": "J.K Rowling",
                    "stock": 2,
                    "created_at": "2023-10-06T15:18:41.000000Z",
                    "updated_at": "2023-10-06T15:18:41.000000Z"
                },
                "member": null
            },
            {
                "id": 3,
                "book_id": 2,
                "code": "SHR-1-001",
                "status": "available",
                "borrowed_by": null,
                "borrow_date": null,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z",
                "book": {
                    "id": 2,
                    "code": "SHR-1",
                    "title": "A Study in Scarlet",
                    "author": "Arthur Conan Doyle",
                    "stock": 3,
                    "created_at": "2023-10-06T15:18:41.000000Z",
                    "updated_at": "2023-10-06T15:18:41.000000Z"
                },
                "member": null
            },
            {
                "id": 4,
                "book_id": 2,
                "code": "SHR-1-002",
                "status": "available",
                "borrowed_by": null,
                "borrow_date": null,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z",
                "book": {
                    "id": 2,
                    "code": "SHR-1",
                    "title": "A Study in Scarlet",
                    "author": "Arthur Conan Doyle",
                    "stock": 3,
                    "created_at": "2023-10-06T15:18:41.000000Z",
                    "updated_at": "2023-10-06T15:18:41.000000Z"
                },
                "member": null
            }
        ]
    },
    "message": ""
}
```
**Member List**
```sh
Request:
(GET) http://localhost:8000/api/member

Response :
{
    "status": true,
    "data": {
        "member": {
            "id": 1,
            "code": "M001",
            "name": "Angga",
            "is_penalized": false,
            "penalized_until": null,
            "created_at": "2023-10-06T15:18:41.000000Z",
            "updated_at": "2023-10-06T15:18:41.000000Z",
            "book_units": [
                {
                    "id": 1,
                    "book_id": 1,
                    "code": "JK-45-001",
                    "status": "available",
                    "borrowed_by": null,
                    "borrow_date": null,
                    "created_at": "2023-10-06T15:18:41.000000Z",
                    "updated_at": "2023-10-06T15:18:41.000000Z",
                    "book": {
                        "id": 1,
                        "code": "JK-45",
                        "title": "Harry Potter",
                        "author": "J.K Rowling",
                        "stock": 2,
                        "created_at": "2023-10-06T15:18:41.000000Z",
                        "updated_at": "2023-10-06T15:18:41.000000Z"
                    }
                },
                {
                    "id": 2,
                    "book_id": 1,
                    "code": "JK-45-002",
                    "status": "available",
                    "borrowed_by": null,
                    "borrow_date": null,
                    "created_at": "2023-10-06T15:18:41.000000Z",
                    "updated_at": "2023-10-06T15:18:41.000000Z",
                    "book": {
                        "id": 1,
                        "code": "JK-45",
                        "title": "Harry Potter",
                        "author": "J.K Rowling",
                        "stock": 1,
                        "created_at": "2023-10-06T15:18:41.000000Z",
                        "updated_at": "2023-10-06T15:45:09.000000Z"
                    }
                }
            ]
        }
    },
    "message": "success"
}
```
**Borrow**
```sh
Request:
(POST) http://localhost:8000/api/transaction/borrow

Body :
{
    "member_id": 1,
    "book_unit_ids": [1, 2]
}

Response :
{
    "status": true,
    "data": {
        "member": [
            {
                "id": 1,
                "code": "M001",
                "name": "Angga",
                "is_penalized": false,
                "penalized_until": null,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z",
                "book_units": []
            },
            {
                "id": 2,
                "code": "M002",
                "name": "Ferry",
                "is_penalized": false,
                "penalized_until": null,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z",
                "book_units": []
            },
            {
                "id": 3,
                "code": "M003",
                "name": "Putri",
                "is_penalized": false,
                "penalized_until": null,
                "created_at": "2023-10-06T15:18:41.000000Z",
                "updated_at": "2023-10-06T15:18:41.000000Z",
                "book_units": []
            }
        ]
    },
    "message": ""
}
```
**Return**
```sh
Request:
(POST) http://localhost:8000/api/transaction/return

Body :
{
    "member_id": 1,
    "book_unit_ids": [1, 2]
}

Response :
{
    "status": true,
    "data": {
        "member": {
            "id": 1,
            "code": "M001",
            "name": "Angga",
            "is_penalized": false,
            "penalized_until": null,
            "created_at": "2023-10-06T15:18:41.000000Z",
            "updated_at": "2023-10-06T15:18:41.000000Z",
            "book_units": [
                {
                    "id": 1,
                    "book_id": 1,
                    "code": "JK-45-001",
                    "status": "borrowed",
                    "borrowed_by": 1,
                    "borrow_date": "2023-10-06 15:45:09",
                    "created_at": "2023-10-06T15:18:41.000000Z",
                    "updated_at": "2023-10-06T15:45:09.000000Z",
                    "book": {
                        "id": 1,
                        "code": "JK-45",
                        "title": "Harry Potter",
                        "author": "J.K Rowling",
                        "stock": 0,
                        "created_at": "2023-10-06T15:18:41.000000Z",
                        "updated_at": "2023-10-06T15:45:09.000000Z"
                    },
                    "member": {
                        "id": 1,
                        "code": "M001",
                        "name": "Angga",
                        "is_penalized": false,
                        "penalized_until": null,
                        "created_at": "2023-10-06T15:18:41.000000Z",
                        "updated_at": "2023-10-06T15:18:41.000000Z"
                    }
                },
                {
                    "id": 2,
                    "book_id": 1,
                    "code": "JK-45-002",
                    "status": "borrowed",
                    "borrowed_by": 1,
                    "borrow_date": "2023-10-06 15:45:09",
                    "created_at": "2023-10-06T15:18:41.000000Z",
                    "updated_at": "2023-10-06T15:45:09.000000Z",
                    "book": {
                        "id": 1,
                        "code": "JK-45",
                        "title": "Harry Potter",
                        "author": "J.K Rowling",
                        "stock": 1,
                        "created_at": "2023-10-06T15:18:41.000000Z",
                        "updated_at": "2023-10-06T15:46:34.000000Z"
                    },
                    "member": {
                        "id": 1,
                        "code": "M001",
                        "name": "Angga",
                        "is_penalized": false,
                        "penalized_until": null,
                        "created_at": "2023-10-06T15:18:41.000000Z",
                        "updated_at": "2023-10-06T15:18:41.000000Z"
                    }
                }
            ]
        }
    },
    "message": "success"
}
```
## Troubleshoot
Jika proses deploy atau install dependencies gagal tambahkan atau edit file **/etc/docker/daemon.json**
```sh
{
  "dns": ["8.8.8.8", "8.8.4.4"]
}
```
Lalu restart service docker
