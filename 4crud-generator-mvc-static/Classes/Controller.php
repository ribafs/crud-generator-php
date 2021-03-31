<?php

require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( CLASSES.'Model.php');

class Controller {

    /**
     * __construct
     * Construtor da classe Controller
     * usage: não precisa chamar, pois em cada instanciação ele é executado automaticamente
     * @return void
    */
    public function __construct(){ // Construtores não podem ser static

	}

    public static function insert(){
        if(isset($_POST['send'])){

            if(Model::insert()){
                return true;
            }else{
                return false;
            }
        }
    }

    public static function update($id){
        if(isset($_POST['send'])){

            if(Model::update($id)){
                return true;
            }else{
                return false;
            }
        }
    }

    public static function delete($id){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            if(Model::delete($id)){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    // Return this:
    // <tr><td>Name</td><td><input type="text" name="name"></td></tr>
    public static function formFields(){
	    $fields = '';

        for($x=1;$x < Model::numFields();$x++){
            $field = Model::fieldName($x);

		    if($x < Model::numFields()){
                $fields .= '<tr><td>'.ucFirst($field).'</td><td><input type="text" name="'.$field.'"></td><tr>'."\n";
		    }
	    }
        return $fields;
    }
    
    // Return this: /*  "<td>" . $row['id'] . "</td>" . */
    public static function rowFields($row){
	    $fields = '';
        $fld = '';

        for($x=0;$x < Model::numFields();$x++){
            $fld = Model::fieldName($x);

            if($x < Model::numFields() -1){
                $fields .= '<td>' . $row["$fld"] . '</td>'."\n";
	        }else{
                $fields .= '<td>' . $row["$fld"] . '</td>';
            }
        }
        return $fields;
    }

    // Return this: <th>ID</th>
    public static function thFields(){
	    $fields = '';

        for($x=0;$x < Model::numFields();$x++){
            $field = Model::fieldName($x);

		    if($x < Model::numFields()){
                $fields .= '<th>'.ucFirst($field).'</th>'."\n";
		    }
	    }
        return $fields;
    }

    // Return this: /* <tr><td><b>Name</td><td><input type="text" name="name" value="$name"></td></tr> */
    public static function fieldsUpdate($reg){
	    $fields = '';

        for($x=1;$x < Model::numFields();$x++){
            $field = Model::fieldName($x);
            ?>
            <tr><td><b><?=ucfirst($field)?></td><td><input type="text" name="<?=$field?>" value="<?=$reg["$field"]?>"></td></tr>
            <?php
        }
    }
}
