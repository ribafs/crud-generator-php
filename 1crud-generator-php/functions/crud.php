<?php

require_once 'connection.php';

    // Amount fields current table
    function numFields(){
        global $pdo, $table;
        $sql = 'SELECT * FROM '.$table.' LIMIT 1';
        $sth = $pdo->query($sql);
        $num_campos = $sth->columnCount();
        return $num_campos;
    }

    // Field name from number $x
    function fieldName($x){
        global $pdo, $table;
        $sql = 'SELECT * FROM '.$table.' LIMIT 1';
        $sth = $pdo->query($sql);
        $meta = $sth->getColumnMeta($x);
        $field = $meta['name'];
        return $field;
    }

    // Return this:
    // <tr><td>Name</td><td><input type="text" name="name"></td></tr>
    function formFields(){
	    $fields = '';

        for($x=1;$x < numFields();$x++){
            $field = fieldName($x);

		    if($x < numFields()){
                $fields .= '<tr><td>'.ucFirst($field).'</td><td><input type="text" name="'.$field.'"></td><tr>'."\n";
		    }
	    }
        return $fields;
    }
    
    // Return this: /*  "<td>" . $row['id'] . "</td>" . */
    function rowFields($row){
	    $fields = '';
        $fld = '';

        for($x=0;$x < numFields();$x++){
            $fld = fieldName($x);

            if($x < numFields() -1){
                $fields .= '<td>' . $row["$fld"] . '</td>'."\n";
	        }else{
                $fields .= '<td>' . $row["$fld"] . '</td>';
            }
        }
        return $fields;
    }

    // Return this: <th>ID</th>
    function thFields(){
	    $fields = '';

        for($x=0;$x < numFields();$x++){
            $field = fieldName($x);

		    if($x < numFields()){
                $fields .= '<th>'.ucFirst($field).'</th>'."\n";
		    }
	    }
        return $fields;
    }

    // Retur all field names: id,name,email,birthday
    function fields(){
	    $fields = '';

        for($x=0;$x < numFields();$x++){
            $field = fieldName($x);

            if($x < numFields() -1){
                $fields .= "$field,"."\n";
	        }else{
                $fields .= "$field";
            }
	    }
        return $fields;
    }

    // Return this: /* <tr><td><b>Name</td><td><input type="text" name="name" value="$name"></td></tr> */
    function fieldsUpdate($reg){
	    $fields = '';

        for($x=1;$x < numFields();$x++){
            $field = fieldName($x);
            ?>
            <tr><td><b><?=ucfirst($field)?></td><td><input type="text" name="<?=$field?>" value="<?=$reg["$field"]?>"></td></tr>
            <?php
        }
    }

    // Return the string with $set for eath field on Update()
    function updateSet(){
	    $set='';
            
        for($x=0;$x < numFields();$x++){
            $field = fieldName($x);
		    // A linha abaixo gerará a linha: $nome = 'Nome do cliente';
	        $$field = $_POST[$field];

		    // Este if gerará a variável $set contendo "$nome = :$nome, $email = :$email, ...";
		    if($x < numFields()-1){
			    if($x==0) continue;// Não contar o campo id
			    $set .= "$field = :$field,";
		    }else{
			    if($x==0) continue;
			    $set .= "$field = :$field";
		    }
	    }
        return $set;
    }

    // Return the string to insert(): (name, email, birthday) values (:name, :email, :birthday)
    function inserirStr(){
	    $fields = '';
	    $values = '';

        for($x=1;$x < numFields();$x++){
            $field = fieldName($x);

		    // Este if gera o seguinte código para a variável $fields = "nome, email, data_nasc, cpf" (exemplo para clientes)
		    // E também para a variável $values = ":nome, :email, :data_nasc, cpf"
		    if($x < numFields()-1){
                $fields .= "$field,";
                $values .= ":$field, ";
		    }else{
                $fields .= "$field";
                $values .= ":$field";
		    }
	    }
        $inserirStr = "($fields) VALUES ($values)";
        return $inserirStr;
    }

    // Insert
    function insert(){
        global $pdo, $table;
        if(isset($_POST['send'])){
            $inserirStr = inserirStr();
            $sql = "INSERT INTO $table {$inserirStr}";
            $sth = $pdo->prepare($sql);    

            for($x=1;$x < numFields();$x++){
                $field = fieldName($x);
		        $sth->bindParam(":$field", $_POST["$field"], PDO::PARAM_INT);
	        }
            $execute = $sth->execute();

            if($execute){
                 return true;
            }else{
                return false;
            }
        }
    }

    // Delete
    function delete($id){
        global $pdo, $table;
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "DELETE FROM  {$table} WHERE id = :id";
            $sth = $pdo->prepare($sql);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);   

            if( $sth->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

    // Update
    function update(){
        global $pdo, $table;
        $updateSet = updateSet();
        $sql = "UPDATE {$table} SET {$updateSet} WHERE id = :id";
        $sth = $pdo->prepare($sql);

        for($x=0;$x < numFields();$x++){
            $field = fieldName($x);
            $sth->bindParam(":$field", $_POST["$field"], PDO::PARAM_STR);
	    }

       if($sth->execute()){
            return true;
       }else{
            return false;
       }
    }

