Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope Process
.\fix-laravel-tailwind.ps1

(untuk instal laravel dan tailwind)

npm run build (untuk buat tailwind dalam folder project)

npm run dev (untuk menyesuaikan tailwind dengan project)

php artisan migrate (untuk buat tabel)

php artisan db:seed (untuk ngisi tabel)

php artisan migrate:fresh (untuk mastikan tabel tidak error yang bisa saja muncul karena salah foreign key)

php artisan storage:link (opsional, karena sakedar buat storage backup)

rm public/storage (hapus storage upload, kalau terjadi kesalahan)

php artisan serve (nyalakan server localhost)

composer dump-autoload (optional, kalau ada masalah middleware)

php artisan route:cache
php artisan config:cache
php artisan view:cache
php artisan optimize

php artisan optimize:clear