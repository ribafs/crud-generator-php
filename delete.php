<?php
require_once('./classes/crud.php');
$crud = new Crud($pdo,$_GET['table']);

if(isset($_GET['id'])){
    $id = $_GET['id'];

    if($crud->delete($id)){
        header('location: index.php?table=$crud->table');
    }else{
        print "Error on delete register!<br><br>";
    }
}
?>
