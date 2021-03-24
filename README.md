
# UserWay Widget for Magento 2

### Extension installation process

#### Manual installation

```
$ cd magento2_installation/app/code
$ mkdir -p Userway/Widget
$ cp sources Userway/Widget
$ magento setup:upgrade
$ magento setup:di:compile
```


#### Installation via Composer package manager

```
$ cd magento2_installation
$ composer require Userway/widget
$ magento setup:upgrade
$ magento setup:di:compile
```

#### Environment


Magento 2 technology stack requirements

Linux's distributions, such as RedHat Enterprise Linux (RHEL), CentOS, Ubuntu, Debian, and similar.

###### Memory requirement

Upgrading the Magento applications and extensions you obtain from Magento Marketplaces and other sources can require up to 2GB of RAM. 
If you are using a system with less than 2GB of RAM, recommend create a swap file; otherwise, your upgrade might fail.

###### Composer (latest stable version)

Composer is required for developers who wish to contribute to the Magento 2 codebase or anyone who wishes to develop Magento extensions.

###### Web servers

Apache 2.4

nginx 1.x

###### Database

MySQL 5.6, 5.7

Magento is also compatible with MySQL NDB Cluster 7.4.*, MariaDB 10.0, 10.1, 10.2, Percona 5.7, and other binary-compatible MySQL technologies.

###### PHP

Supported PHP versions:

    ~7.2.0
    ~7.3.0
    ~7.4.0
    
###### Required PHP extensions

    ext-bcmath
    ext-ctype
    ext-curl
    ext-dom
    ext-gd
    ext-hash
    ext-iconv
    ext-intl
    ext-mbstring
    ext-openssl
    ext-pdo_mysql
    ext-simplexml
    ext-soap
    ext-xsl
    ext-zip
    lib-libxml

###### PHP OPcache

Recommend you verify that PHP OPcache is enabled for performance reasons.


###### Required system dependencies

Magento requires the following system tools for some of its operations:

    bash
    gzip
    lsof
    mysql
    mysqldump
    nice
    php
    sed
    tar

###### Mail server

Mail Transfer Agent (MTA) or an SMTP server


###### Technologies Magento can use

    Redis versions 3.2, 4.0, 5.0 (compatible with 2.4+) for page caching and session storage. Version 5.0 is highly recommended.
    Varnish version 4.x, 5.2 or 6.2
    Elasticsearch
