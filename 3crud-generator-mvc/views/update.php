<?php
require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( TEMPLATES.'header.php');
require_once( CLASSES.'Controller.php');

$id=$_GET['id'];

$controller = new Controller($model);

$reg = $model->register($id);
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$appName?> <br>Atualizar</h3></b></div>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" action="">
                <table class="table table-bordered table-responsive table-hover">
                <?php
                    print $controller->fieldsUpdate($reg);
                ?>
                <input name="id" type="hidden" value="<?=$id?>">
                <tr><td></td><td><input name="send" class="btn btn-primary" type="submit" value="Atualizar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="send" class="btn btn-warning" type="button" onclick="location='../index.php?table=<?=$table?>'" value=" Voltar"></td></tr>
                </table>
            </form>
            <?php require_once("./templates/footer.php"); ?>
        </div>
    <div>
</div>

<?php

if(isset($_POST['send'])){
    if($controller->update($id)){
        header('location: ../index.php');
    }else{
        print "Erro ao atualizar o registro!<br><br>";
    }
}
?>

