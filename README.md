# tasklist
O projeto consiste em um gerenciado de tarefas.<br>
Desenvolvido em Laravel backend e o Boostrap,Jquery o frontend.



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
   
  
#Views
    Pode ser acesso a partir da raiz do projeto <b>./public/task_view/index.php </b>

#Metodos
    
   * GET -  api/tasks/getTaskById/{id} 
        Rertorna os dados de um tarefa por id
    * GET -  api/tasks/getTasks/
        Rertorna todas as tarefas separadas por status
    * POST -  api/tasks/salvar/
        Recebe os seguintes parametross
        string - id 
        string - titulo
        string - descricao      
    * GET -  api/tasks/deletar/{id} 
        Recebe por get o ID da Tarefa para deletar a mesma retorna um status
    * POST - api/tasks/alterar_status
        Funcao responsavel atualizar os status dos tarefas
        Recebe os seguintes parametros
        string - id 
        string - status
            Status possiveis
            id - 1 - Aguardando 
            id - 2 - Em Andamento
            id - 4 - Concluida
