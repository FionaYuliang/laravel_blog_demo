#   su wordpress
#   bash ~/publish_laravel_blog_demo.sh

cd /home/wordpress/www/laravel_blog_demo
#  直接拉取远程代码
git fetch --all
git reset --hard origin/master
#   安装composer依赖
composer install -n
