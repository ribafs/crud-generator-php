<?php

require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( CLASSES.'Connection.php');

class Model extends DB {

    /**
     * __construct
     * Construtor da classe Model
     * usage: não precisa chamar, pois em cada instanciação ele é executado automaticamente
     * @return void
    */
    public function __construct()
    {
	}

    public static function paging($start, $regsPerPage){        
        if(DB::$sgbd == 'mysql'){
            $results = DB::pdo()->prepare("SELECT * FROM ".DB::TABLE." ORDER BY id DESC LIMIT $start, $regsPerPage");
        }else if(DB::$sgbd == 'pgsql'){
            $results = DB::pdo()->prepare("SELECT * FROM ".DB::TABLE." ORDER BY id DESC LIMIT $regsPerPage OFFSET $start");
        }
        return $results;
    }

    public static function search($keyword){
        $sql = "select * from ".DB::TABLE." WHERE ".self::fieldName(1)." LIKE :keyword order by id";
        $sth = DB::pdo()->prepare($sql);
        $sth->bindValue(":keyword", $keyword."%");
        $sth->execute();
	    //$nr = $sth->rowCount();
        $rows =$sth->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    // Retur all field names: id,name,email,birthday
    private static function fields(){
	    $fields = '';

        for($x=0;$x < self::numFields();$x++){
            $field = self::fieldName($x);

            if($x < self::numFields() -1){
                $fields .= "$field,"."\n";
	        }else{
                $fields .= "$field";
            }
	    }
        return $fields;
    }

    public static function register($id){
        $sth = DB::pdo()->prepare('SELECT '.self::fields().' from '.DB::TABLE.' WHERE id = :id');
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $reg = $sth->fetch(PDO::FETCH_ASSOC);

        return $reg;
    }

    // Amount fields current table
    public static function numFields(){
        $sql = 'SELECT * FROM '.DB::TABLE.' LIMIT 1';
        $sth = DB::pdo()->query($sql);
        $num_campos = $sth->columnCount();
        return $num_campos;
    }

    // Field name from number $x
    public static function fieldName($x){
        $sql = 'SELECT * FROM '.DB::TABLE.' LIMIT 1';
        $sth = DB::pdo()->query($sql);
        $meta = $sth->getColumnMeta($x);
        $field = $meta['name'];
        return $field;
    }

    // Return the string to insert(): (name, email, birthday) values (:name, :email, :birthday)
    public static function inserirStr(){
	    $fields = '';
	    $values = '';

        for($x=1;$x < self::numFields();$x++){
            $field = self::fieldName($x);

		    // Este if gera o seguinte código para a variável $fields = "nome, email, data_nasc, cpf" (exemplo para clientes)
		    // E também para a variável $values = ":nome, :email, :data_nasc, cpf"
		    if($x < self::numFields()-1){
                $fields .= "$field,";
                $values .= ":$field, ";
		    }else{
                $fields .= "$field";
                $values .= ":$field";
		    }
	    }
        $inserirStr = "($fields) VALUES ($values);";
        return $inserirStr;
    }

    // Insert
    public static function insert(){
        $ins = self::inserirStr();

        if(isset($_POST['send'])){
            $sql = "INSERT INTO ".DB::TABLE." $ins";
            $sth = DB::pdo()->prepare($sql);    

            for($x=1;$x < self::numFields();$x++){
                $field = self::fieldName($x);
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
    public static function delete($id){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "DELETE FROM ".DB::TABLE." WHERE id = :id";
            $sth = DB::pdo()->prepare($sql);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);   

            if( $sth->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

    // Return the string with $set for eath field on Update()
    private function updateSet(){
	    $set='';
            
        for($x=0;$x < self::numFields();$x++){
            $field = self::fieldName($x);
		    // A linha abaixo gerará a linha: $nome = 'Nome do cliente';
	        $$field = $_POST[$field];

		    // Este if gerará a variável $set contendo "$nome = :$nome, $email = :$email, ...";
		    if($x<self::numFields()-1){
			    if($x==0) continue;// Não contar o campo id
			    $set .= "$field = :$field,";
		    }else{
			    if($x==0) continue;
			    $set .= "$field = :$field";
		    }
	    }
        return $set;
    }

    // Update
    public static function update(){  
        $sql = "UPDATE ".DB::TABLE." SET ".self::updateSet()." WHERE id = :id";
        $sth = DB::pdo()->prepare($sql);

        for($x=0;$x < self::numFields();$x++){
            $field = self::fieldName($x);
            $sth->bindParam(":$field", $_POST["$field"], PDO::PARAM_STR);
	    }

        if($sth->execute()){
             return true;
        }else{
            return false;
       }
    }

    /**
     * nrRegsTable
     * Consultar uma tabela e retorna a quantidade de registro da mesma
     * usage: return nrRegsTable( );
     * @return int
    */
    public static function nrRegsTable(){
        $stmt = DB::pdo()->prepare( "SELECT COUNT(*) AS nr FROM ".DB::TABLE."" );
        $stmt->execute();
        $rows = $stmt->fetch();
        $ret = $rows[ 'nr' ];
        return $ret;
    }
}
