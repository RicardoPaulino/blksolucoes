<?php

namespace App\Core;

class Router
{
    private static array $routes = [];

    /**
     * Adiciona uma rota ao sistema
     * 
     * @param string $method Método HTTP
     * @param string $route URL da rota
     * @param mixed $action Controlador ou função a ser executada
     * @return void
     */
    public static function add(string $method, string $route, $action)
    {
        self::$routes[] = [
            'method' => strtoupper($method),
            'route'  => self::formatRoute($route),
            'action' => $action
        ];
    }

    /**
     * Processa a requisição e executa o controlador correto
     * 
     * @return void
     */
    public static function dispatch()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['route'], $requestUri, $matches)) {
                array_shift($matches); // Remove o primeiro elemento (URL completa)
                
                if (is_callable($route['action'])) {
                    return call_user_func_array($route['action'], $matches);
                } elseif (is_string($route['action'])) {
                    return self::callController($route['action'], $matches);
                }
            }
        }

        http_response_code(404);
        echo "Erro 404: Página não encontrada!";
    }

    /**
     * Converte a rota para um formato de regex
     * 
     * @param string $route URL da rota
     * @return string
     */
    private static function formatRoute(string $route): string
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route);
        return '/^' . $route . '$/';
    }

    /**
     * Chama um controlador e método correspondente
     * 
     * @param string $controllerAction Controlador e método a ser chamado
     * @param array $params Parâmetros a serem passados para o métodoo
     * @return mixed
     */
    private static function callController(string $controllerAction, array $params)
    {
        list($controller, $method) = explode('@', $controllerAction);
        $controller = "App\\Controllers\\" . $controller;

        if (class_exists($controller) && method_exists($controller, $method)) {
            return call_user_func_array([new $controller, $method], $params);
        } else {
            http_response_code(500);
            echo "Erro 500: Controlador ou método não encontrado!";
        }
    }
}