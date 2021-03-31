<?php
require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( CLASSES.'Model.php');
require_once( CLASSES.'Controller.php');

$table = $_GET['table'];

if (isset($_POST["page"])) {
    $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_no))
        die("Error fetching data! Invalid page number!!!");
} else {
    $page_no = 1;
}

// get record starting position
$start = (($page_no-1) * $regsPerPage);

$results = Model::paging($start, $regsPerPage);
$results->execute();

$nr = $results->rowCount();

if($nr > 0){

    while($row = $results->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>" . Controller::rowFields($row);
    ?>
	        <td><a href="views/update.php?id=<?=$row['id']?>&table=<?=Model::TABLE?>"><i class="glyphicon glyphicon-edit" title="Update"></a></td>
            <td><a onclick="return confirm('Realmente excluir o cliente <?=$row['id']?> ?')" href="views/delete.php?id=<?=$row['id']?>&table=<?=Model::TABLE?>"><i class="glyphicon glyphicon-remove-circle" title="Delete"></a></td></tr>
    <?php
    print "
        </tr>";
    }

}else{
    echo '<h3 class="bg-danger">None register found!</h3>';
}
