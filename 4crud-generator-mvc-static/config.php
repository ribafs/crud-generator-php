<?php

$regsPerPage = 8; // Registros por página
$linksPerPage = 23;
$appName = 'Gerador de CRUDs com PHPOO</a>';

define('DS', DIRECTORY_SEPARATOR);
// Captura o path completo do aplicativo. DIRECTORY_SEPARATOR adiciona uma barra ao final do path
define('ROOT', __DIR__ . DS);
// Captura a pasta do projeto: path full mais src, como '/var/www/html/mini-framework2/src'.
define('CLASSES', ROOT . 'Classes' . DS);
define('VIEWS', ROOT . 'views' . DS);
define('TEMPLATES', ROOT . 'views'. DS.'templates' . DS);
define('ASSETS', ROOT . 'assets' . DS);
define('CURRENT_FILENAME', basename($_SERVER['PHP_SELF']));
