# tasklist
O projeto consiste em um gerenciado de tarefas.<br>
Desenvolvido em Laravel backend e o Boostrap,Jquery o frontend.

Link Online : http://tasklistsupero.herokuapp.com/task_view/


* Partindo da seguinte hiposete que você tenha instalado o composer e mysql liberado e instalado as dependencias.<br><br>
* Links para eventuas dúvidas<br>
    Laravel  - https://laravel.com/docs/5.7<br>
    Boostrap - https://getbootstrap.com/<br>
    Jquery   - https://api.jquery.com/<br>

* Necessario utilização dos seguintes comandos para rodar o projeto<br>

1 - Realizar o Clone do Projeto.<br>
2 - Dentro da pasta do projeto rodar o comando <b>composer update</b><br>
3 - Criar o Banco de dados MYSQL chamado tasklist<br>
4 - Rodar os comandos para criação de tabelas e seeds - <b>php artisan migrate && db:seed </b><br>
5 - Após isso inicializar o server com o comando <b>php artisan serve</b><br>
6 - Acessar http://127.0.0.1:8000/task_view <br>
   
  
<h3>Views</h3>
    Pode-se ter acesso a partir da raiz do projeto <b>./public/task_view/index.php </b><br>
<br><br><br>
<h3>Metodos</h3>
<b>* GET -  api/tasks/getTaskById/{id} <br></b>
        Rertorna os dados de um tarefa por id <br>
<b>* GET -  api/tasks/getTasks/<br></b>
        Rertorna todas as tarefas separadas por status<br>
<b>* POST -  api/tasks/salvar/<br></b>
        Recebe os seguintes parametross <br>
        * string - id <br>
        * string - titulo<br>
        * string - descricao<br>
<b>* GET -  api/tasks/deletar/{id} <br></b>
        Recebe por get o ID da Tarefa para deletar a mesma retorna um status<br>
<b>* POST - api/tasks/alterar_status <br></b>
        Funcao responsavel atualizar os status dos tarefas<br>
        Recebe os seguintes parametros<br>
            * string - id <br>
            * string - status<br>
            <b>Status possiveis</b><br>
            id - 1 - Aguardando <br>
            id - 2 - Em Andamento<br>
            id - 4 - Concluida<br>
