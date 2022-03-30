<?php

ob_start();
session_start();

// Importa o autoload do composer
require_once __DIR__ . '/vendor/autoload.php';

// Uso de classes
use Core\Page;

//Instâcia da clase Page executando o método load
(new Page())->load();

ob_end_flush();
