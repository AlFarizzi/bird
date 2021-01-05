# Bird

## Installation

* * *

```bash
https://github.com/AlFarizzi/bird.git
cd path/to/bird
composer install
cd public
php -S localhost:8000
```

## Routing

* * *

if you've used laravel, then routing is thid framework will suit you perfectly,you only need to open the **Router/web.php**

```php
Router::get("/dashboard", [HomeController::class, 'index']);
```

## Controller

* * *

### Make controller

* * *

```bash
//open your terminal & go to root project

./bird make:controller ControllerName
```

the result oh the above comment will be saved in the Controllers folder

### Base Controller

* * *

The controller you have created is a copy of the file in the \*\*command/base_controller/Base.php, \*\*

You can customize this file according to your needs

```PHP
<?php
namespace  Fariz\bird\app\controllers;
use  Fariz\bird\app\controllers\Controller;
use  Fariz\bird\app\core\Request;
use  Fariz\bird\app\exception\ValidationException;
use  Fariz\bird\app\core\Connection;

// $params variable must be passed as a parameter to each method

class HomeController extends Controller{
    // Controller RULE  
    // public function nameFunction($params = [])
    
    public function index($params = []) {
        $db = new Connection();
    }
}
```