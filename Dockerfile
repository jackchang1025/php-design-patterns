# 使用官方 PHP 8.1 镜像作为基础镜像
FROM  ruiorz/php81cli:latest

# 设置工作目录
WORKDIR /app

# 将当前目录的内容复制到工作目录中
COPY . /app

# 安装依赖
RUN composer install

# 设置启动命令
CMD ["php", "-S", "0.0.0.0:8000"]
