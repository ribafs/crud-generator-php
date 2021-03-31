<?php 
require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( TEMPLATES.'header.php');
require_once( CLASSES.'Model.php');
require_once( CLASSES.'Controller.php');

$controller = new Controller($model);

// Busca
if(isset($_GET['keyword'])){
    $keyword=$_GET['keyword'];
    $rows = $model->search($keyword);
}
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$appName;?></b></h3></div>
<?php
print '<div class="text-center"><h4><b>Registro(s) encontrado(s)</b>: '.count($rows).' com <b>'.$keyword.'</b></h4></div>';
?>
<div class="text-center"><input name="send" class="btn btn-warning" type="button" onclick="location='../index.php'" value=" Voltar"></div>
<?php
if(count($rows) > 0){
?>

    <table class="table table-hover">
        <thead>  
            <tr>
                <?php
                    echo $controller->thFields();
                ?>
            </tr>
        </thead>

<?php
    // Loop através dos registros recebidos
    foreach ($rows as $row){
        echo "<tr>" . $controller->rowFields($row);
    } 
    echo "</tr></table>";

}else{
    print '<h3>None Register fund!</h3>
</div>';
}
?>

<div class="text-center"><input name="send" class="btn btn-warning" type="button" onclick="location='../index.php'" value=" Voltar"></div>
</div>
<br>
<?php require_once("./templates/footer.php"); ?>
