# Instalasi aplikasi

Upload/copy/clone folder aplikasi web ini ke web hosting/server lokal

Edit file .env bagian:
- DB_CONNECTION=[YOUR DATABASE ENGINE (ex: mysql, postgresql)]
- DB_HOST=[YOUR DATABASE HOST]
- DB_PORT=[YOUR DATABASE ACCESS PORT]
- DB_DATABASE=[YOUR DATABASE NAME (ex: testcvmediatama)]
- DB_USERNAME=[YOUR DATABASE USERNAME]
- DB_PASSWORD=[YOUR DATABASE PASSWORD]

Buka terminal dan jalankan migrasi dan seeding database dengan perintah:
```
php artisan migrate
php artisan db:seed
```

Jalankan aplikasi dengan melalui browser anda

Secara default ada 3 user dummy pada aplikasi ini yaitu:
- uname:admin pwd:admin12345 level:admin
- uname:capung pwd:capung12345 level:customer
- uname:dummy pwd:dummy12345 level:customer

User level admin memiliki hak akses CRUD (Create, Read, Update, Delete) data customer dan data video, dan bisa memberi akses customer menonton video. User level Customer memiliki akses request menonton video, dan menonton video yang telah disetujui admin. Admin menkonfirmasi permintaan akses video dengan skala waktu terbatas (contoh : customer a diberi akses video 1 selama 2 jam saja). Customer melihat video sesuai tenggang waktu yang diberikan. Saat waktu habis customer bisa meminta akses ulang ke admin.