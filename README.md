# GAJIKU-API  

Sebuah web API sederhana untuk layanan manajemen gaji karyawan. dikembangkan menggunakan Laravel Lumen Framework 9.21. [dokumentasi Lumen](https://lumen.laravel.com/docs)
Authentication using JWT via [jwt-auth](https://github.com/PHP-Open-Source-Saver/jwt-auth/)

## Get Started

1. clone this repo `git clone https://github.com/ahmaruff/Gajiku-Api.git`  
2. run `composer install`  
3. copy `.env-example` to `.env`  
4. set DATABASE configuration in `.env` file
5. run migration `php artisan migrate`
6. run `php artisan jwt:secret` to create JWT Secret key
7. run web server `php -S localhost:8080 -t public`
8. start cosume API via browser or API Client.

## Routes

| METHOD | PATH | PARAMETER | BODY REQUEST | DESC |
| --- | --- | --- | --- |  --- |
| GET | / | n/a | n/a | return app name, desc, and lumen version |  
| POST | /login | n/a | email:string & password:string | authentication using auth-jwt |  
| POST | /register | n/a| name:string, email:string, password | create new users record |  
| POST | /logout | n/a | n/a | logout from authenticated user |  
| POST | /refresh | na |  refresh login auth token |  
| GET | /golongan | n/a| n/a | return array of golongan table record |  
| POST | /golongan | n/a | nama_golongan, kode, gaji_pokok, tunjangan_transport |create new golongan table |  
| GET | /golongan/{id} | id: int | n/a | return spesific golongan record |
| PUT  | /golongan/edit/{id} | id: int | {nama_golongan, kode, gaji_pokok, tunjangan_transport} | edit golongan record |
| DELETE |  /golongan/edit/{id} | id: int | n/a | delete golongan record |
| GET | /pegawai | n/a| n/a | return array of pegawai table record |  
| POST | /pegawai | n/a | nip, nama, email, telp, alamat, tanggal lahir, jenis kelamin, agama, status_nikah, tahun_masuk, jabatan, golongan_id  |create new pegawai table |  
| GET | /pegawai/{id} | id: int | n/a |return spesific pegawai record |
| PUT  | /pegawai/edit/{id} | id: int | {nip, nama, email, telp, alamat, tanggal lahir, jenis kelamin, agama, status_nikah, tahun_masuk, jabatan, golongan_id} | edit pegawai record |
| DELETE |  /pegawai/edit/{id} | id: int | n/a | delete pegawai record |

## Response Template

all response should be in json. following [JSend Standard](https://github.com/omniti-labs/jsend).  
The HTTP code will be 400 (Bad Request) for all errors unless stated otherwise.

```json
{
    status : "success|fail|error"
    code : "HTTP_STATUS_CODE"
    message : "custom message"
    data : {
        // data goes here
    }
}
```

## TO DO

1. CRUD for lembur, cuti, gaji table
2. routes for CRUD lembur, cuti, gaji
3. create Controller to handle gaji/penggajian

## Author

[Ahmad Ma'ruf](https://github.com/ahmaruff)
