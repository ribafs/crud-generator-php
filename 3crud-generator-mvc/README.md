# Gerador de CRUDs em PHP

## Recursos

- PHP Orientado a objetos
- PDO
- Bootstrap 3
- Paginação com Bootpag
- Busca
- Classe Crud com métodos úteis
- Boa prática
- Tabela do MySQL com dados de teste gerada pela biblioteca Faker:
    - https://github.com/ribafs/faker-dados
    - https://github.com/ribafs/FakerRestaurantBr
    - https://github.com/fzaninotto/Faker
- Não usa MVC (ainda) mas tem arquivos com funções bem claras e separadas

## Requisitos:
- Apache2
- PHP 5.5.9+
- MySQL 5.5+ ou PostgreSQL 8+

## SGBD testados

- MySQL
- PostgreSQL

## Instalação

Somente no primeiro acesso será mostrado o form de instalação.

- Download de https://github.com/ribafs/auto-crud
- Descompacte para seu diretório web na pasta "gerador"
- Crie um banco dedados no MySQL
- Acesse

http://localhost/gerador

Entre com oa dados no form

MySQL

![](assets/images/form_my.png)

PostgreSQL

![](assets/images/form_pg.png)

Então será levado para o CRUD com PDO, Bootstrap, Paginação e Busca, com suporte a MySQL e PostgreSQL garantidos e ainda outros via PDO populado com os registros da tabela indicada.

![](assets/images/crud.png)

## Configuração

Edite o arquivo classes/connection.php e ajuste para as informações do seu banco de dados

Pode testar com os scripts existentes para mysql e para postgresql: customers_my.sql e customers_pg.sql.

## Customizações

O código com a paginação está basicamente no arquivo index.php ao final. É uma paginação com o plugin da jQuery Bootpag (https://botmonster.com/jquery-bootpag/). A lib está em assets/js.

A customização pode ser feita no arquivo index.php

## Releases

- 1.0 - Versão inicial
- 1.1 - Nesta versão os arquivos foram todos renomeados para nomes em português
      - Melhorados e traduzidos os comentários 
      - Simplificação do código removendo código desnecessário 
      - Criadas duas funções para substituir trechos de código que se repetiam. Inseri seu include na conexao.php para facilitar 
      - Pequena alteração no css do cabeçalho e do rodapé
- 1.2 - Correçes devido aos ajustes da 1.1
- 1.3 - Separados os arquivos principais inserir, atualizar e excluir em dois. Agora o inserir é inserir e inserirdb.
- 1.4 - Agora ele cria o banco para você e importa seu script, basta indicar onde ele está no conexao.php
- 1.5 - Otimização das funções. Passando mais informações para elas e reduzindo a quantidade de parâmetros. Assim o código fica mais simples e mais fácil de entender. 

Estes são os objetivos principais: facilitar a vida do programador e do usuário e simplificar/otimizar o código.

- 1.6 - Ainda continuando a otimização do código. Melhorando as funções e com isso tambéma a quantidade de linhas foi reduzida.
- 1.7 - Mais ajustes para o código. Otimizando para separar melhor e deixar fácil para converter para OO.
- ...
- 2.3 - Esta versão

## Objetivo principal
O principal objetivo deste pequeno software é o de facilitar a vida de quem não programa e nem está pensando em aprender e quer apenas criar algo rápido, como uma agenda ou um cadastro simples.

## Referências

- https://www.kodingmadesimple.com/2017/01/simple-ajax-pagination-in-jquery-php-pdo-mysql.html
- https://www.codingcage.com/2015/10/create-pagination-script-using-php-jquery.html
- https://www.bipmedia.com/blog/tutorial/pagination-script-using-php-pdo-with-jquery
- 

## Licença

MIT


