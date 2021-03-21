<?php

require_once( dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php');
require_once( CLASSES.'Connection.php');

$conn = new Connection();
$table = $conn->table; // $table estará disponível aqui e também para todos que incluirem Model.php

class Model extends Connection {

//    public $pdo;    
    public $table;

    /**
     * __construct
     * Construtor da classe Model
     * usage: não precisa chamar, pois em cada instanciação ele é executado automaticamente
     * @return void
    */
    public function __construct($table)
    {
        parent::__construct(); // Usado somente em classes filhas
//        $this->pdo = $pdo;
        $this->table = $table;
	}

    public function paging($start, $regsPerPage){
        if($this->sgbd == 'mysql'){
            $results = $this->pdo->prepare("SELECT * FROM $this->table ORDER BY id DESC LIMIT $start, $regsPerPage");
        }else if($this->sgbd == 'pgsql'){
            $results = $this->pdo->prepare("SELECT * FROM $this->table ORDER BY id DESC LIMIT $regsPerPage OFFSET $start");
        }
        return $results;
    }

    public function search($keyword){
        $sql = "select * from {$this->table} WHERE LOWER({$this->fieldName(1)}) LIKE :keyword order by id";
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(":keyword", $keyword."%");
        $sth->execute();
	    //$nr = $sth->rowCount();
        $rows =$sth->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    // Retur all field names: id,name,email,birthday
    public function fields(){
	    $fields = '';

        for($x=0;$x < $this->numFields();$x++){
            $field = $this->fieldName($x);

            if($x < $this->numFields() -1){
                $fields .= "$field,"."\n";
	        }else{
                $fields .= "$field";
            }
	    }
        return $fields;
    }

    public function register($id){
        $sth = $this->pdo->prepare("SELECT {$this->fields()} from $this->table WHERE id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $reg = $sth->fetch(PDO::FETCH_ASSOC);

        return $reg;
    }

    // Amount fields current table
    public function numFields(){
        $sql = 'SELECT * FROM '.$this->table.' LIMIT 1';
        $sth = $this->pdo->query($sql);
        $num_campos = $sth->columnCount();
        return $num_campos;
    }

    // Field name from number $x
    public function fieldName($x){
        $sql = 'SELECT * FROM '.$this->table.' LIMIT 1';
        $sth = $this->pdo->query($sql);
        $meta = $sth->getColumnMeta($x);
        $field = $meta['name'];
        return $field;
    }

    // Return the string to insert(): (name, email, birthday) values (:name, :email, :birthday)
    private function inserirStr(){
	    $fields = '';
	    $values = '';

        for($x=1;$x < $this->numFields();$x++){
            $field = $this->fieldName($x);

		    // Este if gera o seguinte código para a variável $fields = "nome, email, data_nasc, cpf" (exemplo para clientes)
		    // E também para a variável $values = ":nome, :email, :data_nasc, cpf"
		    if($x < $this->numFields()-1){
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
    public function insert(){
        if(isset($_POST['send'])){
            $sql = "INSERT INTO $this->table {$this->inserirStr()}";
            $sth = $this->pdo->prepare($sql);    

            for($x=1;$x < $this->numFields();$x++){
                $field = $this->fieldName($x);
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
    public function delete($id){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "DELETE FROM  {$this->table} WHERE id = :id";
            $sth = $this->pdo->prepare($sql);
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
            
        for($x=0;$x < $this->numFields();$x++){
            $field = $this->fieldName($x);
		    // A linha abaixo gerará a linha: $nome = 'Nome do cliente';
	        $$field = $_POST[$field];

		    // Este if gerará a variável $set contendo "$nome = :$nome, $email = :$email, ...";
		    if($x<$this->numFields()-1){
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
    public function update(){  
        $sql = "UPDATE {$this->table} SET {$this->updateSet()} WHERE id = :id";
        $sth = $this->pdo->prepare($sql);

        for($x=0;$x < $this->numFields();$x++){
            $field = $this->fieldName($x);
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
    public function nrRegsTable(){
        $stmt = $this->pdo->prepare( "SELECT COUNT(*) AS nr FROM {$this->table}" );
        $stmt->execute();
        $rows = $stmt->fetch();
        $ret = $rows[ 'nr' ];
        return $ret;
    }

}
