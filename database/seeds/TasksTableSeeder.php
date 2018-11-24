<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = array(
            ['task_status_id' => '2','titulo' => 'Teste Tarefa 10','descricao' => 'Criação de Projeto, uma nova Tarefa 10'],
            ['task_status_id' => '1','titulo' => 'Teste Tarefa 1','descricao' => 'Criação de Projeto, uma nova Tarefa 1'],
            ['task_status_id' => '4','titulo' => 'Teste Tarefa 3','descricao' => 'Criação de Projeto, uma nova Tarefa 3'],
            ['task_status_id' => '1','titulo' => 'Teste Tarefa 5','descricao' => 'Criação de Projeto, uma nova Tarefa 5'],
            ['task_status_id' => '2','titulo' => 'Teste Tarefa 7','descricao' => 'Criação de Projeto, uma nova Tarefa 7'],
            ['task_status_id' => '1','titulo' => 'Teste Tarefa 9','descricao' => 'Criação de Projeto, uma nova Tarefa 9'],
            ['task_status_id' => '4','titulo' => 'Teste Tarefa 11','descricao' => 'Criação de Projeto, uma nova Tarefa 1'],
            ['task_status_id' => '4','titulo' => 'Teste Tarefa 00','descricao' => 'Criação de Projeto, uma nova Tarefa 00'],
            ['task_status_id' => '1','titulo' => 'Teste Tarefa 99','descricao' => 'Criação de Projeto, uma nova Tarefa 99'],
            ['task_status_id' => '4','titulo' => 'Teste Tarefa 00000','descricao' => 'Criação de Projeto, uma nova Tarefa 00000'],
        );

        foreach ($tasks as $task) {
           DB::table('tasks')->insert([
                'task_status_id' => $task['task_status_id'],
                'titulo' => $task['titulo'],
                'descricao' => $task['descricao'],
            ]);
    	}
	}
}
