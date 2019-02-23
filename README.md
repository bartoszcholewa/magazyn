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

# C:\xampp\htdocs\magazyn\.env
rebuild .env file

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
