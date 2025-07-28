<?php 

declare(strict_types= 1);

namespace App\Controllers;

class Router{
    private const GET = 'GET';
    private const POST = 'POST';

    private $routes;

    public function __construct(){
        $this->routes = [
            self::GET => [],
            self::POST => [],
        ];
    }

    public function get(string $path, array $handler): self{
        $this->routes[self::GET][$path] = $handler;

        return $this;
    }

    public function post(string $path, array $handler): self{
        $this->routes[self::POST][$path] = $handler;

        return $this;
    }

    public function resolve(string $method, string $uri): mixed{
        $path = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$path])){
            $handler = $this->routes[$method][$path];
            
            
            if (is_array($handler)){
                $className = $handler[0];
                $method = $handler[1];

                if (class_exists($className)){
                    $instance = new $className();

                    return call_user_func([$instance, $method]);
                }
            }
        }

        http_response_code(404);
        throw new \InvalidArgumentException('404 Not found: {$method}');


    }


}

?>