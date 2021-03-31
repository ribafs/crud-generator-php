<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Gerador de CRUDs com PHPOO e MVC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
require_once( dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'config.php');

    if(CURRENT_FILENAME != 'index.php'){
?>
    <link href='../assets/css/bootstrap.min.css' rel="stylesheet" type="text/css" />
    <link href='../assets/css/style.css' rel="stylesheet" type="text/css" />
    <style type="text/css">
    .panel-footer {
        padding: 0;
        background: none;
    }
    </style>
<?php
    }else{
?>
    <link href='assets/css/bootstrap.min.css' rel="stylesheet" type="text/css" />
    <link href='assets/css/style.css' rel="stylesheet" type="text/css" />
    <style type="text/css">
    .panel-footer {
        padding: 0;
        background: none;
    }
    </style>
<?php
}
?>
</head>
