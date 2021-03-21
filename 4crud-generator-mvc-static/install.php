<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gerador de CRUDs em PHP com MVC</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<div class="container">
<div class="text-center bg-success">
  <h1>Gerador de CRUDs em PHP com MVC</h1>
</div>
<br>

  <div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
  <h2 align="center">Entre com os dados do banco</h2>
  <form method="POST" action="">
    <div class="form-group">
      <input type="text" class="form-control" id="host" name="host" value="localhost" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="db" placeholder="Nome do banco de dados" name="db" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="table" placeholder="Nome da tabela" name="table" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="user" name="user" value="root" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="pass" placeholder="Senha" name="pass">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="sgbd" name="sgbd" value="mysql">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="port" name="port" value="3306">
    </div>
    <button type="submit" class="btn btn-primary">Criar</button>
  </form>
  </div>
</div>
<br><br><br>
<div align="center"><b>By <a href="https://ribafs.org">RibaFS</a></b> 
</body>
</html>

<?php
if(isset($_POST['host'])){

$host = $_POST['host'];
$db = $_POST['db'];
$table = $_POST['table'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$sgbd = $_POST['sgbd'];
$port = $_POST['port'];

$content = "<?php

class Connection
{
	private \$host  = '$host';
	private \$db    = '$db';
	private \$user  = '$user';// root, postgres
	private \$pass  = '$pass'; // postgres
	public  \$sgbd  = '$sgbd'; // mysql, pgsql
	private \$port  = '$port'; // 3306, 5432
	public  \$table = '$table';
";

    if(is_readable('./classes/connection.txt')){
        $fp = fopen('./classes/connection.txt', "r");
        $content2 = fread($fp, filesize ('./classes/connection.txt'));
        fclose($fp);
    }else{
        echo "<script>alert('The directory classes require read permission to web server!')</script>";
        exit;
    }

    $content .=$content2;

    if(is_writable('./Classes')){
        $fp = fopen('./Classes/Connection.php', "w");
        fwrite($fp, $content);
        fclose($fp);
    }else{
        echo "<script>alert('O diretório Classes requer permissão de escrita para o servidor web!')</script>";
        exit();
    }

    header('location: index.php');
}
?>
