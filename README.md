.git clone https://github.com/achraf1876/MGPAPPROJETDESTAGE.git
.cd MGPAPPROJETDESTAGE

.composer install

.cp .env.example .env

.php artisan key:generate

.php artisan migrate

.php artisan db:seed

.php artisan serve

.composer require barryvdh/laravel-dompdf
