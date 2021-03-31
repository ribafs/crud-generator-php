<?php

require_once( __DIR__ . DIRECTORY_SEPARATOR . 'config.php');
require_once( TEMPLATES.'header.php');// O views/templates/header.php é incluído aqui, então seus paths do css devem considerar como se aqui estivesse
//require_once( CLASSES.'Model.php'); // Não precisa incluir Model, pois ele já foi incluído no Controller
require_once( CLASSES.'Controller.php');


if(!file_exists('./Classes/Connection.php')){
    header('location: install.php');
}

$controller = new Controller($model);
$rows = $model->nrRegsTable();

// get total no. of pages
$totalPages = ceil($rows/$regsPerPage);
?>

<body>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$appName ?></h3></b></div>
        <div class="row">

            <!-- Adicionar registro -->
            <div class="text-left col-md-2 top">
                <a href="views/insert.php?table=<?=$table?>" class="btn btn-primary pull-left">
                    <span class="glyphicon glyphicon-plus"></span> Novo Registro
                </a>
            </div>

            <!-- Form de busca-->
            <div class="col-md-10">
                <form action="views/search.php" method="get" >
                  <div class="pull-right top">
                  <span class="pull-right">  
                    <label class="control-label" for="palavra" style="padding-right: 5px;">
                      <input type="text" value="" placeholder="Campo completo ou parte" class="form-control" name="keyword">
                      <input name="table" type="hidden" value="<?=$table?>">
                    </label>
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Busca</button>&nbsp;
                  </span>                 
                  </div>
                </form>
            </div>
	    </div>

        <table class="table table-bordered table-hover">
            <thead>  
                <tr>
                <?php
                    print $controller->thFields();
                ?>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody id="pg-results">
            </tbody>
        </table>
        <div class="panel-footer text-center">
            <div class="pagination"></div>
        </div>
    </div>
</div>
    
<script src="./assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/js/jquery.bootpag.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#pg-results").load("views/fetch_data.php");
    $(".pagination").bootpag({
        total: <?php echo $totalPages; ?>,
        page: 1,
        maxVisible: <?php echo $linksPerPage; ?>,
        leaps: true,
        firstLastUse: true,
        first: 'Primeiro',//←
        last: 'Último',//→
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function(e, page_num){
        //e.preventDefault();
        $("#results").prepend('<div class="loading-indication"><img src="./assets/images/ajax-loader.gif" /> Loading...</div>');
        $("#pg-results").load("views/fetch_data.php", {"page": page_num});
    });
});
</script>

<?php include_once("./views/templates/footer.php"); ?>

