<?php
// Laravelキャッシュをクリアするためのスクリプト
exec('php artisan config:clear');
exec('php artisan route:clear');
exec('php artisan view:clear');
exec('php artisan cache:clear');
exec('php artisan config:cache');
exec('php artisan route:cache');
exec('php artisan view:cache');

echo "Cache cleared successfully!";
