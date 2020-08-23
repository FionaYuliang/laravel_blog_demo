#   su wordpress
#   cd ~
#   bash ~/publish_laravel_blog_demo.sh

echo "cd /home/wordpress/www/laravel_blog_demo"
cd /home/wordpress/www/laravel_blog_demo
#  直接拉取远程代码
echo "更新代码..."
echo "fetch --all"
git fetch --all
echo "reset --hard origin/master"
git reset --hard origin/master
echo "代码更新完毕"
#   安装composer依赖
# 安装不上则手工配置一下镜像
# composer config repo.packagist composer https://mirrors.aliyun.com/composer/
echo "安装composer依赖"
composer install -n
echo "项目发布完毕"

