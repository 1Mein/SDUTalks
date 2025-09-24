

<h1>prod</h1>

composer install --no-dev<br>
php artisan key:generate<br>
cp .env.example .env<br>
php artisan migrate<br>

<h1>dev</h1>

composer install --dev<br>
php artisan key:generate<br>
cp .env.example .env<br>
./vendor/bin/sail up -d<br>
./vendor/bin/sail php artisan migrate<br>

