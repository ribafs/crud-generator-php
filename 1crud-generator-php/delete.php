<?php
require_once('./functions/crud.php');
$pdo = connection();

if(isset($_GET['id'])){
    $id = $_GET['id'];

    if(delete($id)){
        header('location: index.php?table=$table');
    }else{
        print "Error on delete register!<br><br>";
    }
}
?>
