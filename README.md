# PubProxy Class PHP

[![Version](https://img.shields.io/badge/stable-1.1.0-green.svg)](https://github.com/aalfiann/pubproxy-class-php)
[![Total Downloads](https://poser.pugx.org/aalfiann/pubproxy-class-php/downloads)](https://packagist.org/packages/aalfiann/pubproxy-class-php)
[![License](https://poser.pugx.org/aalfiann/pubproxy-class-php/license)](https://github.com/aalfiann/pubproxy-class-php/blob/HEAD/LICENSE.md)

Get working public proxy list for free by PubProxy (No API key required).

## Known Limitations
As free user, there is only 100 request a day. So we cached the request per 30minutes to save your quota.  
We recommend you to buy the premium proxy to get the best experience, realtime and unlimited.

## Installation

Install this package via [Composer](https://getcomposer.org/).
```
composer require "aalfiann/pubproxy-class-php:^1.0"
```


## Usage

### Get Proxy (Rotate Automatically)
```php
require_once ('vendor/autoload.php');
use \aalfiann\PubProxy;

$proxy = new PubProxy;
echo $proxy->make()->getProxy();
```

### Get Proxy List
```php
require_once ('vendor/autoload.php');
use \aalfiann\PubProxy;

$proxy = new PubProxy;
// with Json format
echo $proxy->make()->getJson();
// with Text format
echo $proxy->make()->getText();
```


### Get Proxy List with Custom Options
```php
require_once ('vendor/autoload.php');
use \aalfiann\PubProxy;

$proxy = new PubProxy;
$proxy->level = 'elite';
$proxy->type = 'http';
$proxy->country = 'us';
$proxy->make()->getJson();
```

## Chain Usage Example

```php
require_once ('vendor/autoload.php');
use \aalfiann\PubProxy;

$proxy = new PubProxy;
echo $proxy->setLevel('elite')->setType('http')->setCountry('us')->make()->getJson();
```

## Properties PubProxy
-  `$api='',$level='',$type='',$country='',$not_country='',$port='',$google='',$https='',$post='',$user_agent='',$cookies='',$referer='',$limit=20,$last_check=0,$speed=0;`

## Properties Feature
- `$refresh=1800,$filepath='',$proxy='',$proxyauth='',$response,$resultArray=null;`

## Chain Function
- **setApi($api='')** this will make your request realtime and unlimited by buying **PubProxy Premium**.
- **setLimit($limit=20)** this will display proxies by limit number. Default is 20.
- **setType($type='')** this will display proxies by proxy protocol (socks4, socks5 and http).
- **setLevel($level='')** this will display proxies by anonymity level (anonymous and elite).
- **setLastCheck($last_check=0)** this will display proxies which is how long minutes the proxy was last checked?
- **setSpeed($speed=0)** this will display proxy which is how many seconds it takes for the proxy to connect?
- **setCountry($country='')** this will display proxy from country that we wanted (input multiple with separated commas).
- **setNotCountry($not_country='')** this will display avoided proxy countries (input multiple with separated commas).
- **setPort($port='')** this will display proxies with a specific port (input multiple with separated commas).
- **setGoogle($google='')** this will display proxies which is Google passed proxies.
- **setHttps($https='')** this will display proxies which is supports HTTPS request.
- **setPost($post='')** this will display proxies which is supports POST request.
- **setUserAgent($user_agent='')** this will display proxies which is supports USER_AGENT request.
- **setCookies($cookies='')** this will display proxies which is supports COOKIES request.
- **setReferer($referer='')** this will display proxies which is supports REFERER request.
- **setRefresh($refresh=1800)** this will cache the proxy. Default is 1800 seconds (every 30minutes proxy will refresh automatically).
- **setFilepath($filepath='')** this will create custom file cache. Default is "cache-proxy/{{md5}}.cache".

## Main Function
- **make()** Make process to get proxy list response.
- **getJson()** Get response as json format.
- **getText()** Get response as text/plain format
- **getProxy()** Get single proxy (ip:port and rotate automatically if the proxy limit is more than 1)

## Cache Function
- **isHit()** to check the cached proxy list is still valid or not
- **fetch()** to fetch the cached proxy list
- **write($content)** to write proxy list data to file cache.
- **clear()** to clear the file cache