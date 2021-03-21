<?php 
require_once('./header.php');
require_once('./functions/crud.php');
$pdo = connection();

// Busca
if(isset($_GET['keyword'])){
    $keyword=$_GET['keyword'];
    $field1 = fieldName(1);
    $sql = "select * from {$table} WHERE {$field1} LIKE :keyword order by id";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(":keyword", $keyword."%");
    $sth->execute();
	//$nr = $sth->rowCount();
    $rows =$sth->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$appName;?></b></h3></div>
<?php
print '<div class="text-center"><h4><b>Registro(s) encontrado(s)</b>: '.count($rows).' com <b>'.$keyword.'</b></h4></div>';

if(count($rows) > 0){
?>

    <table class="table table-hover">
        <thead>  
            <tr>
                <?php
                    echo thFields();
                ?>
            </tr>
        </thead>

<?php
    // Loop através dos registros recebidos
    foreach ($rows as $row){
        echo "<tr>" . rowFields($row);
    } 
    echo "</tr></table>";

}else{
    print '<h3>None Register fund!</h3>
</div>';
}
?>

<div class="text-center"><input name="send" class="btn btn-warning" type="button" onclick="location='index.php?table=<?=$table?>'" value=" Voltar"></div>
</div>
<br>
<?php require_once './footer.php'; ?>
