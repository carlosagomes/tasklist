<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    /**
     * Funçao responsavel por buscar todas as tarefas
     *
     * @return \Illuminate\Http\Response
     */
    public function getTaskById($id)
    {
        $data['tarefa']   = Task::find($id);

        $response = array(
            'data'      => $data,
            'status'    => 'success',
            'msg'       => 'Registros retornado com sucesso.',
        );              
        return response()->json($response);   
    }   

    /**
     * Funçao responsavel por buscar todas as tarefas
     *
     * @return \Illuminate\Http\Response
     */
    public function getTasks()
    {

        try {
            $data['tarefas']['aguardando']   = Task::whereNull('data_remocao')->where('task_status_id','1')->get();
            $data['tarefas']['em_andamento'] = Task::whereNull('data_remocao')->where('task_status_id','2')->get();
            $data['tarefas']['pausada']      = Task::whereNull('data_remocao')->where('task_status_id','3')->get();
            $data['tarefas']['concluidas']   = Task::whereNull('data_remocao')->where('task_status_id','4')->get();

            if(count($data['tarefas']) > 0 ){
                $response = array(
                    'data'      => $data,
                    'status'    => 'success',
                    'msg'       => 'Registros retornado com sucesso.',
                );
            }else{
                $response = array(
                    'data'      => '',
                    'status'    => 'warning',
                    'msg'       => 'Não foi possível localizar nenhuma tarefa no momento.',
                );          
            }           
        } catch (Exception $e) {
                $response = array(
                    'data'      => '',
                    'status'    => 'error',
                    'msg'       => 'Algo deu errado tente novamente.',
                );              
        }
        
        return response()->json($response); 

    }

    /**
     * salvar recebe o post com dados da view 
     *
     * @return \Illuminate\Http\Response
     */
    public function salvar()
    {
        $dados = $_POST;

        if (empty($dados['id'])) {
            $task                      = new Task();
            $task->titulo              = $this->removerCaracteresEspeciais(strip_tags($dados['titulo']));
            $task->descricao           = $this->removerCaracteresEspeciais(strip_tags($dados['descricao']));
            $task->task_status_id      = 1;
            $task->save();  
            $response = array(
                'status'    => 'success',
                'msg'       => 'Dados Inseridos com Sucesso!',
            );
        }else{
            $task                      = Task::find($dados['id']);
            $task->titulo              = $this->removerCaracteresEspeciais(strip_tags($dados['titulo']));
            $task->descricao           = $this->removerCaracteresEspeciais(strip_tags($dados['descricao']));
            $task->data_edicao         = DB::raw('CURRENT_TIMESTAMP(0)');
            $task->save();  
            $response = array(
                'status'    => 'success',
                'msg'       => 'Dados Atualizados com Sucesso!',
            );
        }
        return response()->json($response); 
    }

    /**
     * Funcao responsavel deletar o registro
     *
     * @return valide success
     */
    public function deletar($id){
        
        $task                 = Task::find($id);
        $task->data_remocao   = DB::raw('CURRENT_TIMESTAMP(0)');

        $task->save();

        return response()->json(array('success' => true));
    }

    /**
     * Funcao responsavel atualizar os status dos tarefas
     *
     * @return valide success
     */
    public function alterar_status(){
        $dados = $_POST;

        $task                   = Task::find($dados['id']);
        if($dados['status'] == 4){
            $task->data_conclusao       = DB::raw('CURRENT_TIMESTAMP(0)');
        }else{
            $task->data_conclusao       = null;
        }
        $task->task_status_id   = $dados['status'];
        $task->data_edicao      = DB::raw('CURRENT_TIMESTAMP(0)');
        $task->save();

        return response()->json(array('success' => true));
    }



    /**
     * Funcao responsavel por remover caracteres especiais enviando SQL ou JavaScript no código.
     *
     * @return palavra
     */
    private function removerCaracteresEspeciais($str){
        /*** Função para retornar uma string/Array protegidos contra SQL/Blind/XSS Injection*/
        if( !is_array( $str ) ) {                      
                $str = preg_replace( '/(case|while|alert|from|select|insert|delete|where|drop|union|order|update|database)/i', '', $str );
                $str = preg_replace( '/(&lt;|<)?script(\/?(&gt;|>(.*))?)/i', '', $str );
                $tbl = get_html_translation_table( HTML_ENTITIES );
                $tbl = array_flip( $tbl );
                $str = addslashes( $str );
                $str = strip_tags( $str );
                return strtr( $str, $tbl );
        } else {
                return array_filter( $str, "protect" );
        }
    }
}
