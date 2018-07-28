# loja_dev
Ambiente de desenvolvimento referente ao projeto.


____________________________________________28/07/2018____________________________________________


                            --------------- Daniel  ---------------

------------------------------------------ Usuário ------------------------------------------------------

-> Usuário
- cadadastro de endereço
Nome completo, CPF, email.

adm_pessoa_usuario

------------------------------------------ Funcionario ------------------------------------------------------

-> Funcionário
- Cadastro de Cargos
- fk_id_usuario,cargo (nome do cargo), endereço
* todo funcionário possui um cargo

* O admin cadastro o funcionario, mas no momento em que o funcionario faz o login
* No momento que ele acessa a tela, é gerado um pop-up, perguntando se deseja atualizar a senha ou 
os dados de funcionario como cliente

adm_funcionario

 ------------------------------------------ Rafael ------------------------------------------

------------------------------------------ Cliente ------------------------------------------------------

-> Cliente
fk_id_usuario

* Incluir botão para utilizar dados do facebook, google
* Gerar uma senha automaticamente
* É enviado um email de confirmação, com uma senha gerada automaticamente.

adm_cliente

   ------------------------------------------------ Ivan -----------------------------------------------
-------------------------------------------------- Produto -----------------------------------------------


* Cadastro de Tipo de produto
* Cadastro de produto sem precisar fazer uma compra
* Cadastro do produto (Nome, descrição, modelo, tamanho, peso, preco_venda_atual)

adm_tipo_produto
adm_produto

---------------------------------------------------------------------------------------------------------------

 --- API
 
 --- Git
 --- git kraken
 --- PHP 7.2  --- http://br.phptherightway.com/
 --- Laravel
 --- Maria_Db
 --- Postman

 --- Db ever
 --- Vs code
 --- Servidor embutido
 --- Linux

 --- Template : https://adminlte.io/themes/AdminLTE/index2.html
 --- Bootstrap 3
 --- Angular 2 ultima versão

 --- criacao de nome das tabelas: Sempre minusculo



------------------------

cursos -

PHP



----------------------------------------- Login -------------------------------------------------

* É logado no sistema a partir confirmação do link do email
* No momento que ele acessa a tela, é gerado um pop-up, perguntando se deseja atualizar a senha ou os dados
* Se ele desejar, é levado até a tela de atualização de dados
* Caso o usuário realize uma compra, é então levado para a tela de cadastro de endereço, 
onde fornecerá um novo dendereço, ou selecionará o endereço de entrega


-> Cadastro de Serviço
-> Cadastro de produto
-> Cadastro de agendamento de entrega
-> Cadastro de encomenda
-> Cadastro de agendamento de negociação
-> Cadastro de preço