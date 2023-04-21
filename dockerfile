# 使用官方的 PHP 7.0.1 镜像作为基础镜像
FROM php:7.4.33-apache

# 设置工作目录
WORKDIR /var/www/html

# 安装依赖并启用需要的PHP扩展
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 将项目文件复制到工作目录
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html