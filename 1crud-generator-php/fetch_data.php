<?php
require_once('./functions/crud.php');
$pdo = connection();

if (isset($_POST["page"])) {
    $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_no))
        die("Error fetching data! Invalid page number!!!");
} else {
    $page_no = 1;
}

// get record starting position
$start = (($page_no-1) * $regsPerPage);

if($sgbd == 'mysql'){
    $results = $pdo->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT $start, $regsPerPage");
}else if($sgbd == 'pgsql'){
    $results = $pdo->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT $regsPerPage OFFSET $start");
}

$results->execute();
$nr = $results->rowCount();

if($nr > 0){

    while($row = $results->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>" . rowFields($row);

            $id = $row['id'];
            $name = $row['name'];
		    ?>
	        <td><a href="update.php?id=<?=$row['id']?>&table=<?=$table?>"><i class="glyphicon glyphicon-edit" title="Update"></a></td>
            <td><a onclick="return confirm('Realmente excluir o cliente <?=$name?> ?')" href="delete.php?id=<?=$id?>&table=<?=$table?>"><i class="glyphicon glyphicon-remove-circle" title="Delete"></a></td></tr>
    <?php
    print "
        </tr>";
    }

}else{
    echo '<h3 class="bg-danger">None register found!</h3>';
}
