# magazyn
Laravel 5.7

# Install Process:
1. XAMPP
2. GIT
3. Node.js
4. Composer
5. VS Code

# C:\xampp\apache\conf\extra\httpd-vhosts.conf

```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"  
    ServerName localhost
</VirtualHost>
```

```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/magazyn/public"
    ServerName magazyn
</VirtualHost>
```

# C:\Windows\System32\drivers\etc

```
127.0.0.1       localhost
127.0.0.1       magazyn
```

# C:\xampp\htdocs\magazyn\ .env
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=magazyn
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

# Visual Studio Code

[Ctrl + `] to open console

```
cd C:/xampp/htdocs
git clone https://github.com/bartoszcholewa/magazyn.git
cd magazyn
composer install
npm install
npm run dev
php artisan key:generate
php artisan config:clear
php artisan config:cache
php artisan storage:link
```

# PHPMyAdmin

Create "magazyn" table and import magazyn.sql there
