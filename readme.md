### luffyzhao/ErpEntrust
---

`O2oRefectory` 餐厅管理系统基于 `laravel` `5.6`，目前实现的功能有：后台用户管理、后台角色管理、后台权限管理、日志管理等。

### 安装

composer update

php artisan key:generate

php artisan run:app

php artisan back:restore

 登录邮箱 `luffyzhao@vip.126.com` 密码 `123456`
 
 <VirtualHost _default_:80>
   DocumentRoot "yourpath/public"
   ServerName o2orefectory.test
   ServerAlias *.o2orefectory.test
   <Directory "yourpathy/public">
     Options Indexes FollowSymLinks Includes ExecCGI
     AllowOverride All
     Require all granted
   </Directory>
 </VirtualHost>

后台访问地址 `base.o2orefectory.test`  

### 手册

[前端开发手册](storage/doc/前端开发手册.md)

[后台开发手册](storage/doc/后台开发手册.md)
