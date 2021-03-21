<?php

require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( CLASSES.'Model.php'); // incluindo Model, já inclui também Connection, pois Model incluiu Connection

$model = new Model($table); // Em Model já definimos $table e $pdo, como incluimos Model, elas já estão disponíveis

/*
Para que Model esteja disponível como um atributo private nesta classe
- incluimos Model.php acima
- instanciamos e atribuimos para $model
- criamos a propriedade private $model na classe Controller
- passamos $model através do construtor apra $this->model
- Assim podemos chamar Model nesta classe usando $this->model
*/

class Controller {

    private $model;

    public function __construct($model)
    {
        $this->model = $model;
	}

    public function insert(){
        if(isset($_POST['send'])){
            if($this->model->insert()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function update($id){
        if(isset($_POST['send'])){

            if($this->model->update($id)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function delete($id){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            if($this->model->delete($id)){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    // Return this:
    // <tr><td>Name</td><td><input type="text" name="name"></td></tr>
    public function formFields(){
	    $fields = '';

        for($x=1;$x < $this->model->numFields();$x++){
            $field = $this->model->fieldName($x);

		    if($x < $this->model->numFields()){
                $fields .= '<tr><td>'.ucFirst($field).'</td><td><input type="text" name="'.$field.'"></td><tr>'."\n";
		    }
	    }
        return $fields;
    }
    
    // Return this: /*  "<td>" . $row['id'] . "</td>" . */
    public function rowFields($row){
	    $fields = '';
        $fld = '';

        for($x=0;$x < $this->model->numFields();$x++){
            $fld = $this->model->fieldName($x);

            if($x < $this->model->numFields() -1){
                $fields .= '<td>' . $row["$fld"] . '</td>'."\n";
	        }else{
                $fields .= '<td>' . $row["$fld"] . '</td>';
            }
        }
        return $fields;
    }

    // Return this: <th>ID</th>
    public function thFields(){
	    $fields = '';

        for($x=0;$x < $this->model->numFields();$x++){
            $field = $this->model->fieldName($x);

		    if($x < $this->model->numFields()){
                $fields .= '<th>'.ucFirst($field).'</th>'."\n";
		    }
	    }
        return $fields;
    }

    // Return this: /* <tr><td><b>Name</td><td><input type="text" name="name" value="$name"></td></tr> */
    public function fieldsUpdate($reg){
	    $fields = '';

        for($x=1;$x < $this->model->numFields();$x++){
            $field = $this->model->fieldName($x);
            ?>
            <tr><td><b><?=ucfirst($field)?></td><td><input type="text" name="<?=$field?>" value="<?=$reg["$field"]?>"></td></tr>
            <?php
        }
    }
}
