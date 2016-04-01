# SsoService文档


---
## 相关依赖
    
    
## 安装 
添加到composer.json

    "require": {
        "Ltbl/SsoService": "~1.0"
    }
    
## 私有包安装 
添加到composer.json
    
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/alenslan/SsoService.git"
        }
    ]
    
##安装完成了后安装配置
添加config/app.php 文件里的

        'providers' => [
            Ltbl\SsoService\SsoServiceProvider::class
        ]

然后运行 

    php artisan vendor:publish
    
查看/config/ssolua.php 文件是否存在