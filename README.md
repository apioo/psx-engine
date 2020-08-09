PSX Engine
===

## About

The engine package provides multiple ways to run your PSX app in different
environments. By default it uses the web server engine which is designed for
classical web servers like Apache or Nginx. But in the PHP world there are lots
of alternative web server solutions which can also improve the performance of
your app.

## Engines

* **Apache/NGINX**
  
  Classical web server like Apache or NGINX which uses either FCGI or includes
  PHP as module (Apache). This engine is included by default.
  
  * Class: `PSX\Engine\WebServer\Engine`

* **Amp**
  
  A HTTP server completely written in PHP

  * Github: https://github.com/amphp/http-server
  * Package: `psx/engine-amp`
  * Class: `PSX\Engine\Amp\Engine`
  
* **Swoole**

  The HTTP server written as PHP extension in C/C++

  * Github: https://github.com/swoole/swoole-src
  * Package: `psx/engine-swoole`
  * Class: `PSX\Engine\Swoole\Engine`
  
* **Roadrunner**

  The HTTP server written in GO and uses

  * Github: https://github.com/spiral/roadrunner
  * Package: `psx/engine-roadrunner`
  * Class: `PSX\Engine\Roadrunner\Engine`

## Usage

To use a different engine simply require the package through composer. Then you
need to adjust your index.php and use the fitting engine class.

```php

require_once(__DIR__ . '/../vendor/autoload.php');

$container = require_once(__DIR__ . '/../container.php');

$engine      = null; # adjust the engine class
$environment = \PSX\Framework\Environment\Environment::fromContainer($container, $engine);

$environment->serve();

```
