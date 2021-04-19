<?php

class DB
{
	private static  $host  = 'localhost';
	private static  $db    = 'crud-generator';
	private static  $user  = 'root';// root, postgres
	private static  $pass  = ''; // postgres
	private static  $port  = '3306'; // 3306, 5432
	public static   $sgbd  = 'mysql'; // mysql, pgsql, sqlite apenas na conexão, nas usa estas propriedades
    public const TABLE = 'customers';

    public static function pdo(){

        $pdo = null;

        if( $pdo == null ) {

		    switch (self::$sgbd){
			    case 'mysql':                
				    try {
					    $dsn = self::$sgbd.':host='.self::$host.';dbname='.self::$db.';port='.self::$port;
					    $pdo = new PDO($dsn, self::$user, self::$pass);
					    // Boa exibição de erros
					    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
					    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				    }catch(PDOException $e){
                        // Usar estas linhas no catch apenas em ambiente de testes/desenvolvimento. Em produção apenas o exit()
					if($e->getCode() == 1049) {
						print '<h1>Favor criar o banco de dados antes e configurá-lo em Classes/Connection.php</h1>';
						exit;
					}elseif($e->getCode() == 1045){
						print '<h1>Favor corrigir a senha do banco de dados antes em Classes/Connection.php</h1>';
						exit;						
					}else{	
						echo '<br><br><b>Código</b>: '.$e->getCode().'<hr><br>';
						echo '<b>Mensagem</b>: '. $e->getMessage().'<br>';
						echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
						echo '<b>Linha</b>: '.$e->getLine().'<br>';					
						exit();
					}					
				    }
				    break;

			    case 'pgsql':
				    try {
					    $dsn = $this->sgbd.':host='.$this->host.';dbname='.$this->db.';port='.$this->port;
					    $pdo = new PDO($dsn, $this->user, $this->pass);

					    // Boa exibição de erros
					    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
					    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				    }catch(PDOException $e){
					    echo '<br><br><b>Código</b>: '.$e->getCode().'<hr><br>';
					    echo '<b>Mensagem</b>: '. $e->getMessage().'<br>';
					    echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
					    echo '<b>Linha</b>: '.$e->getLine().'<br>';
				    }
				    break;
			    case 'default':
				    break;
		    }
        }
        return $pdo;
	}
    // DB::pdo()
}

