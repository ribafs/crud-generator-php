<?php
require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( TEMPLATES.'header.php');
require_once( CLASSES.'Controller.php');

$controller = new Controller($table);

$id = $_GET['id'];

if($controller->delete($id)){
    header('location: ../index.php?table=$table');
}else{
    print "Error on delete register!<br><br>";
}

?>
