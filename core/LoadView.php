<?php

namespace Core;

class LoadView
{
    private $data;
    private $options = [];
    private $defaults = [
        "head" => true,
        "footer" => true,
    ];

    public function __construct(array $data = [], array $options = [])
    {
        $this->data = $data;
        $this->options = array_merge($this->defaults, $options);
        if ($this->options["head"]) {
            include CONF_VIEW_HEAD;
        }
    }

    public function render(string $view): void
    {
        if (!file_exists(CONF_VIEWS_PATH . $view . '.php')) {
            echo "erro ao carregar a página: {$view}";
            return;
        }

        include CONF_VIEWS_PATH . $view . ".php";
        return;
    }


    public function __destruct()
    {
        if ($this->options["footer"]) {
            include CONF_VIEW_FOOTER;
        }
    }
}
