# Webpals students app by Weingarten Harel
This app presents CRUD and REST usuing php , mysql and laravel

# my sql : can be found in folder mysql
create a new DB using local php emulators like xampp or wamp myadmin
Name your db stundets
import the file to your database 

url
https://localhost/phpmyadmin/sql.php

# backend 
composer installation:

Using cmd.exe:

C:\bin> echo @php "%~dp0composer.phar" %*>composer.bat
Using PowerShell:

PS C:\bin> Set-Content composer.bat '@php "%~dp0composer.phar" %*'

C:\Users\username>composer -V

link for more info:
https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos

Install Dependencies:
npm install --save-dev @babel/core
npm install

clean cache
php artisan cache:clear
php artisan config:cache

cmd: php artisan serve

url
127.0.0.1

all functionallty can view in the back end as well via laravel views.

see backend.jpg for example

# front end
npm i

for babel error
delete node_modules folder
delete package-lock.json
run 'npm ls babel-loader' to remove babel

Folder:app/students
cmd: npm start 

url 
http://localhost:3000/admin/profile

view project n react

# UX

register as a user (change role field in sql 1 for admin 0 for studend -default)

Student : Edit / view student details - subjects not included join perods
Admin: edit view all premissions granted create periods add remove students

see frontend.jpg for example


