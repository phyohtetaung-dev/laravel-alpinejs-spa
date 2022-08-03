# Larave + AlpineJS SPA
![image](https://user-images.githubusercontent.com/42564050/160682498-adc75ec0-58fb-46ff-8ee4-93781a41c913.png)

## Requirements
**php >= 8.1**

## Installation
```
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
```

## Config Env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Migrate DB
```
php artisan migrate --seed
```
