<?php

namespace Core;

class Page
{
    private $controller;
    private $method;
    private $param;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_SPECIAL_CHARS);

        if (is_null($url)) {
            $this->controller = "Home";
            $this->method = "index";
            $this->param = null;
            return;
        }

        $url = explode('/', $url);

        $this->controller = isset($url[0]) ? slug(clear_str($url[0])) : 'Home';
        $this->method = isset($url[1]) ? slug(clear_str($url[1], true)) : 'index';
        $this->param = ($url[2] ?? null);

        return;
    }

    /**
     * Carrega a controller da página chamada na rota
     *
     * @return void
     */
    public function load()
    {
        $classe = "App\Controllers\\" . $this->controller;
        if (!class_exists($classe)) {
            $this->controller = 'Home';
            $this->load();
            return;
        }

        if (!method_exists($classe, $this->method)) {
            $this->method = 'index';
            $this->load();
            return;
        }

        (new $classe())->{$this->method}($this->param);
        return;
    }
}
