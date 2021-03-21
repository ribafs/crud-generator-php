<?php
require_once('./functions/crud.php');
$pdo = connection();
$id=$_GET['id'];
$fields = fields();
$sth = $pdo->prepare("SELECT {$fields} from $table WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_STR);
$sth->execute();

$reg = $sth->fetch(PDO::FETCH_ASSOC);

require_once('./header.php');
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
                    print fieldsUpdate($reg);
                ?>
                <input name="id" type="hidden" value="<?=$id?>">
                <tr><td></td><td><input name="send" class="btn btn-primary" type="submit" value="Atualizar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="send" class="btn btn-warning" type="button" onclick="location='index.php?table=<?=$table?>'" value=" Voltar"></td></tr>
                </table>
            </form>
            <?php require_once('footer.php'); ?>
        </div>
    <div>
</div>

<?php

if(isset($_POST['send'])){

    if(update()){
        header('location: index.php?table=$table');
    }else{
        print "Erro ao atualizar o registro!<br><br>";
    }
}
?>

