<?php

class Connection
{
	private     $host  = 'localhost';
	private     $db    = 'crud-generator';
	private     $user  = 'root';// root, postgres
	private     $pass  = ''; // postgres
	private     $port  = '3306'; // 3306, 5432
    public      $table = 'customers';
	protected   $sgbd  = 'mysql'; // mysql, pgsql, sqlite apenas na conexão, nas usa estas propriedades
	protected   $pdo;

    public function __construct(){

		switch ($this->sgbd){
			case 'mysql':
				try {
					$dsn = $this->sgbd.':host='.$this->host.';dbname='.$this->db.';port='.$this->port;
					$this->pdo = new PDO($dsn, $this->user, $this->pass);
					// Boa exibição de erros
					$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
					$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$this->pdo->query('SET NAMES utf8');
					return $this->pdo;

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
					echo '<br><br><b>Código</b>: '.$e->getCode().'<hr><br>';
					echo '<b>Mensagem</b>: '. $e->getMessage().'<br>';
					echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
					echo '<b>Linha</b>: '.$e->getLine().'<br>';
					exit();
				}
				break;

			case 'pgsql':
				try {
					$dsn = $this->sgbd.':host='.$this->host.';dbname='.$this->db.';port='.$this->port;
					$this->pdo = new PDO($dsn, $this->user, $this->pass);

					// Boa exibição de erros
					$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
					$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					return $this->pdo;

				}catch(PDOException $e){
					echo '<br><br><b>Código</b>: '.$e->getCode().'<hr><br>';
					echo '<b>Mensagem</b>: '. $e->getMessage().'<br>';
					echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
					echo '<b>Linha</b>: '.$e->getLine().'<br>';
					exit();
				}
				break;

			case 'default':
				break;
		}
	}
}

