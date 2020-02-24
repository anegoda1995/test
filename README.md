Requirements:
- npm 3.5.2
- node v8.10.0
- php 7.2.24

Installation
```sh
$ composer install && cp .env.example .env && php artisan key:generate && php artisan jwt:secret && npm install && npm install @websanova/vue-auth && npm install --save vue-tree-list && npm install less-loader && npm install less && npm run dev && php artisan serve

$ mysql -u [username] -p [db_name] < database/dumps/test_nextpage.sql
```
Update DB_ section in .env
For "php artisan serve" (change port here `resources/js/app.js:21` if 8000 will not be available).
Dump of DB needs only for ~50000 employees, because generating the tree by seed will so slow... Almost with dump you will get user with `email: test@test.test` and `password: test`!