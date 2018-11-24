<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = array(
            ['nome' => 'Aguardando'],
            ['nome' => 'Em Andamento'],
            ['nome' => 'Pausada'],            
            ['nome' => 'Concluída'],            
        );

        foreach ($status as $s) {
           DB::table('task_status')->insert([
                'nome' => $s['nome']
            ]);
    	}
	}
}
