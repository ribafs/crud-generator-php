<?php
require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( TEMPLATES.'header.php');
require_once( CLASSES.'Controller.php');

$controller = new Controller($model);

if(isset($_REQUEST['table'])){
    $table = $_REQUEST['table'];
}
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$appName?></b> <br>(Adicionar)</h3></div>
        <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-8">

        <table class="table table-bordered table-responsive table-hover">    
            <form method="POST" action="insert.php">
            <?php        
                print $controller->formFields();
            ?>
            <input type="hidden" name="table" value="<?=$table?>">
            <tr><td></td><td><input class="btn btn-primary" name="send" type="submit" value="Inserir">&nbsp;&nbsp;&nbsp;
            <input class="btn btn-warning" type="button" onclick="location='../index.php?table=<?=$table?>'" value=" Voltar"></td></tr>
            </form>
        </table>
        </div>
    </div>
</div>

<?php
include_once("./templates/footer.php");

if(isset($_POST['send'])){
    if($controller->insert()){
        header('location: ../index.php');
    }else{
        echo 'Erro ao inserir o registro';
    }
}
?>

