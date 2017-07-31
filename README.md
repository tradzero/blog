# blog
这是我的个人blog作品。 It's my personal blog works. https://drakframe.com

## <a href="docs/english.md">English Version</a>

# 功能
1. 后台部分  
http://yourdomain/admin 进入后台 具体账号可以使用 `php artisan account:admin` 生成

2. 错误事件微信推送功能  
本功能由[easywechat](https://easywechat.org/)实现  
当异常发生时 自动上报错误  
![example](imgs/wechat_report.png)  
上述模板参考：  
`{{first.DATA}} 异常类型：{{keyword1.DATA}} 异常链接：{{keyword2.DATA}} 访问IP：{{keyword3.DATA}} 错误堆栈：{{error.DATA}} {{remark.DATA}}`

3. 发文章同步到wordpress

> 使用说明：  
> 1. 更改.env的sync_wordpress为true。
> 2. 运行 `php artisan vendor:publish --provider=Tradzero\WPREST\WPRESTServiceProvider`
> 3. 更改`config/wordpress.php` 设置wordpress站点endpoint与用户名信息

# 安装

## 需求
php > 5.6.4 (最好是php 7 未在php5.6测试过)  
任意服务器 nginx apache (可选)  
composer  
redis (文章缓存需要)  

## 安装过程

1. [安装composer](http://docs.phpcomposer.com/00-intro.html)

2. clone 该项目  
`git clone git@github.com:tradzero/blog.git` 

3. 进入目录下 安装依赖  
`composer install`

4. 复制.env.example 到.env  
linux下： `cp .env.example .env`  
windows下： `copy .env.example .env`

5. 生成app key  
`php artisan key:gen`

6. 创建一个数据库  
`create database xxx; # xxx为具体数据库名`

7. 填写基础.env 配置环境  

```
DB_DATABASE= # 此处修改为具体数据库名
DB_USERNAME= # 数据库连接用户名
DB_PASSWORD= # 数据库连接密码

REDIS_PASSWORD= # REDIS服务器密码
```

8. 运行数据库迁移文件  
`php artisan migrate`

9. 配置运行对应服务器  
如果没有或者不想搭建服务器 可以使用内置服务器运行  
`php artisan serv` 访问 `http://127.0.0.1:8000`

10. 具体配置也可以参考： [laravel配置](http://d.laravel-china.org/docs/5.3/installation)

## .env 详细配置说明

```
# 七牛云相关配置文件 文章默认上传使用七牛云

QINIU_AK=     # 个人中心  密钥管理  AccessKey
QINIU_SK=     # 个人中心  密钥管理  SecretKey
QINIU_BUCKET= # 对象存储  空间名
QINIU_URL=    # 对象存储  域名

# 微信相关配置 blog使用微信测试号推送系统上报一些错误log 便于及时响应
# 推荐使用微信测试号平台 未在正式号测试过
WECHAT_APPID=        # 微信公众平台  开发  基本配置    开发者ID
WECHAT_SECRET=       # 微信公众平台  开发  基本配置    开发者密码
WECHAT_TOKEN=        # 微信公众平台  开发  服务器配置  令牌(可选)
WECHAT_AES_KEY=      # 微信公众平台  开发  服务器配置  消息加解密密钥(可选)
WECHAT_USER_OPENID=  # 微信公众平台  测试号二维码  用户列表 用户OPENID 用来接收消息
WECHAT_TEMPLATE=     # 微信公众平台  模板消息接口  测试模板ID
WECHAT_DEBUG=        # 是否开启微信推送功能 默认为false

# 同步文章到wordpress
sync_wordpress= # 是否开启文章推送到wordpress
```




# 依赖

## [Laravel](https://laravel.com/)  
版本：5.3

## [laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)

## [parsedown](https://github.com/erusev/parsedown)  
markdown to HTML工具包

## [laravel-wechat](https://easywechat.org/)  
easywechat laravel扩展

## [php-sdk](https://github.com/qiniu/php-sdk)  
七牛SDK包

## [laravel-5-markdown-editor](https://github.com/yccphp/laravel-5-markdown-editor)  
markdown web编辑器

## [adminlte](https://adminlte.io/)  
后台管理界面框架

## [vue](https://cn.vuejs.org/)
javascript框架

## [rainbow](https://github.com/ccampbell/rainbow)  
前端代码高亮工具

## [wysiwyg.css](https://github.com/jgthms/wysiwyg.css)
markdown github风格css组件

## [bootstrap](http://getbootstrap.com/)
前端框架

## [WPREST](https://github.com/tradzero/WPREST)
wordpress 文章同步工具

# License

This blog is licensed under the [GNU General Public License v3.0](http://www.gnu.org/licenses/gpl-3.0.html)

# TODO

- [x] 将缓存的redis配置为独立频道 避免 cache:clear时移除错误数据  
- [x] 隐藏功能实现有问题 列表隐藏了 url访问还能访问  
- [x] 修复发布文章后 因cache问题导致文章可见性失效的问题  
- [ ] 完全覆盖的测试用例  
- [ ] 个人信息定制化  
- [ ] 用户信息页完善  
- [ ] 首页二级缓存  
- [ ] 使用队列处理wordpress同步工具 避免发文章过于缓慢

# 贡献
欢迎提issue~ 欢迎star  任何的意见，问题可以发email或者任何渠道联系我