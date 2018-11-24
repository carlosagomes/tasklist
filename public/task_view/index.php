<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="_token" content="{{csrf_token()}}" />
        <meta name="_url"   content="{{url('')}}" />
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lista de Tarefas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css" media="screen">
            .loader{
                width: 10%;
            } 
            a.btn.btn-default {
                margin-right: 5px;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            Tarefas
                        </a>
                        <button type="button" class="btn btn-success navbar-btn btn-nova-tarefa">Nova Tarefa</button>
                    </div>
                </div>
            </nav>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">Tarefas - Aguardando</div>
                        <div class="panel-body">
                            <table class="table table-striped" id="t_draggable1" >
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Título</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody class="tarefas_aguardando t_sortable" >
                                    <tr>
                                        <td style="text-align: center;" colspan="3"><img class="loader" src="img/loader.gif" /></td>
                                    </tr>
                                </tbody>
                            </table>                    
                        </div>
                    </div>                    
                </div>
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">Tarefas - Em Andamento</div>
                        <div class="panel-body">
                            <table class="table table-striped" id="t_draggable2">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Título</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody class="tarefas_em_andamento t_sortable">
                                    <tr>
                                        <td style="text-align: center;" colspan="3"><img class="loader" src="img/loader.gif" /></td>
                                    </tr>
                                </tbody>
                            </table>                    
                        </div>
                    </div>                    
                </div>
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">Tarefas - Concluídas</div>
                        <div class="panel-body">
                            <table class="table table-striped"  id="t_draggable3">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Título</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody class="tarefas_concluidas t_sortable" >
                                    <tr>
                                        <td style="text-align: center;" colspan="3"><img class="loader" src="img/loader.gif" /></td>
                                    </tr>
                                </tbody>
                            </table>                    
                        </div>
                    </div>                    
                </div>
<!--                 <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">Tarefas - Pausada</div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Título</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody class="tarefas_concluidas">
                                    <tr>
                                        <td style="text-align: center;" colspan="3"><img class="loader" src="img/loader.gif" /></td>
                                    </tr>
                                </tbody>
                            </table>                    
                        </div>
                    </div>                    
                </div> -->
            </div>
        </div>

        <!-- Modal para editar e criar uma tarefa  -->
        <div class="modal modal-tarefas" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title">Salvar Tarefa</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="titulo">Título * </label>
                                <input type="hidden" id="task_id" value="">
                                <input type="hidden" id="status" value="">
                                <input type="text" name="titulo" class="form-control" required id="titulo" autocomplete="off">
                                <div class="invalid-feedback titulo"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="descricao">Descrição * </label>
                                <textarea name="descricao" class="form-control" required id="descricao" autocomplete="off"></textarea>
                                <div class="invalid-feedback descricao"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-salvar-tarefa">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    //  DENIFE A URL QUE SERA ENVIADO O DADOS DA API
    let url = 'http://127.0.0.1:8000/api/';

    // INICIA O CARREGAMENTO DA PAGINA
    $(document).ready(function(){   
        // BUSCA TODAS AS TAREFAS
        getTarefas();
        $('[data-toggle="tooltip"]').tooltip(); 
    });

    // FUNCAO RESPONSAVEL POR ABRIR O MODAL PARA CRIAR UMA NOVA TAREFA
    $(document).on('click','.btn-nova-tarefa',function(){
        $('#task_id').val('');
        $('#titulo').val('');
        $('#descricao').val('');
        $('#status').val('');

        $('.modal-tarefas').modal('show');
    });

    // FUNCAO RESPONSAVEL POR REALIZAR O SALVAMENTO DOS DADOS TANTO NO CREATE QUANDO EDIT DA TAREFA
    $(document).on('click','.btn-salvar-tarefa',function(){
        // limpa o html de validacao
        $('.invalid-feedback').html('');

        // busca os dados das variaveis
        let task_id     = $('#task_id').val().trim();
        let titulo      = $('#titulo').val().trim();
        let descricao   = $('#descricao').val().trim();
        let status      = $('#status').val().trim();

        if(titulo == ''){
            $('.invalid-feedback.titulo').html('Favor preencher um Título');
            return false;
        }else if(descricao == ''){
            $('.invalid-feedback.descricao').html('Favor preencher uma Descrição');
            return false;
        }

        // AJAX RESPONVEL POR ENVIAR OS DADOS E RECENER UM RETORNO DA API
        $.ajax({
            url: url+'task/salvar',
            type: 'POST',
            dataType : 'json',
            data: {
                id        : task_id,
                titulo    : titulo,
                descricao : descricao,
                status    : status,
            },
            success: function (data) {
                if(data.status == 'success'){
                    $('.modal-tarefas').modal('hide');
                    alert("Tarefa Salva com sucesso!");
                    getTarefas();

                }
            },
            error: function(data){
                if(data.status != 422){
                    alert('Não foi possível salvar os dados. Por favor tente novamente mais tarde.');
                }
            }
        });
    });

    // funcao reponsavel por inciar a chamada de exclusao de uma tarefa
    $(document).on('click','.btn-excluir',function(){
        let task_id = $(this).attr('data-id');
        if (confirm('Você realmente deseja Excluir essa Tarefa?')) {
            deletarTarefa(task_id);
        }
    });

    //FUNCAO RESPONSAVEL POR ENVIAR TAREFA EM ANDAMENTO 
    $(document).on('click','.btn-enviar-em-andamento',function(){
        let task_id = $(this).attr('data-id');
        if (confirm('Você realmente deseja Enviar essa Tarefa para Em Andamento?')) {
            alterarStatus(task_id,2);
        }        
    });

    //FUNCAO RESPONSAVEL POR ENVIAR TAREFA EM ANDAMENTO 
    $(document).on('click','.btn-enviar-concluido',function(){
        let task_id = $(this).attr('data-id');
        if (confirm('Você realmente deseja Enviar essa Tarefa para Concluída?')) {
            alterarStatus(task_id,4);
        }        
    });

    //FUNCAO RESPONSAVEL POR ENVIAR TAREFA EM ANDAMENTO 
    $(document).on('click','.btn-editar',function(){
        let task_id = $(this).attr('data-id');
        editarTarefa(task_id);
    });

    // FUNCAO RESPONSAVEL POR ALTERAR O STATUS DA TAREFA
    function alterarStatus(task_id,status){
        $.ajax({
            url: url+'task/alterar_status',
            type: 'POST',
            dataType : 'json',
            data: {
                id        : task_id,
                status    : status,
            },
            success: function (data) {
                if(data.success){
                    getTarefas();
                }
            },
            error: function(data){
                if(data.status != 422){
                    alert('Não foi possível alterar os dados. Por favor tente novamente mais tarde.');
                }
            }
        });        
    }

    // FUNCAO RESPONSAVEL POR LISTAR TODAS AS TAREFAS
    function getTarefas(){
        $.ajax({
            url: url+'task/getTasks',
            type: 'get',
            contentType: false,
            processData: false,
            success: function (data) {
                let dados                = data.data;
                let html_nenhum_registro = '<tr class="sem_registro"><td style="text-align: center;" colspan="3">Nenhuma Tarefa encontrada.</td><tr>';
                if(data.status == 'success'){
                    let html_aguardando     = '';
                    let html_em_andamento   = '';
                    let html_pausada        = '';
                    let html_concluida      = '';

                    // VALIDA PARA MONTAR O HTML DO STATUS AGUARDANDO
                    if(dados.tarefas.aguardando.length > 0){
                        $(dados.tarefas.aguardando).each(function(key,value){
                            html_aguardando += '<tr data-status="1" data-id="'+value.id+'" id="drag'+value.id+'" >'+
                                                    '\<td>'+value.id+'</td>'+
                                                    '\<td>'+value.titulo+'</td>'+
                                                    '\<td >'+
                                                        '\<a data-toggle="tooltip" title="Editar Tarefa" class="btn btn-default btn-editar" data-id="'+value.id+'"><span class="glyphicon glyphicon-edit"></span></a>'+
                                                        '\<a data-toggle="tooltip" title="Excluir Tarefa" class="btn btn-default btn-excluir" data-id="'+value.id+'"><span class="glyphicon glyphicon-trash"></span></a>'+
                                                        '\<a data-toggle="tooltip" title="Enviar Tarefa para Em Andamento" class="btn btn-default btn-enviar-em-andamento" data-id="'+value.id+'"><span class="glyphicon glyphicon-send"></span></a>'+
                                                    '\</td>'+
                                              '\<tr>';
                        });
                    }else{
                        html_aguardando = html_nenhum_registro;
                    }
                    $('.tarefas_aguardando').html(html_aguardando);

                    // VALIDA PARA MONTAR O HTML DO STATUS EM ANDAMENTO
                    if(dados.tarefas.em_andamento.length > 0){
                        $(dados.tarefas.em_andamento).each(function(key,value){
                            html_em_andamento += '<tr data-status="2" data-id="'+value.id+'" id="drag'+value.id+'" >'+
                                                    '\<td>'+value.id+'</td>'+
                                                    '\<td>'+value.titulo+'</td>'+
                                                    '\<td>'+
                                                        '\<a data-toggle="tooltip" title="Editar Tarefa" class="btn btn-default btn-editar" data-id="'+value.id+'"><span class="glyphicon glyphicon-edit"></span></a>'+
                                                        '\<a data-toggle="tooltip" title="Excluir Tarefa" class="btn btn-default btn-excluir" data-id="'+value.id+'"><span class="glyphicon glyphicon-trash"></span></a>'+
                                                        '\<a data-toggle="tooltip" title="Enviar Tarefa para Concluída" class="btn btn-default btn-enviar-concluido" data-id="'+value.id+'"><span class="glyphicon glyphicon-send"></span></a>'+
                                                    '\</td>'+
                                              '\<tr>';
                        });
                    }else{
                        html_em_andamento = html_nenhum_registro;
                    }
                    $('.tarefas_em_andamento').html(html_em_andamento);

                    // VALIDA PARA MONTAR O HTML DO STATUS CONCLUIDA
                    if(dados.tarefas.concluidas.length > 0){
                        $(dados.tarefas.concluidas).each(function(key,value){
                            html_concluida += '<tr data-status="4" data-id="'+value.id+'" id="drag'+value.id+'" >'+
                                                    '\<td>'+value.id+'</td>'+
                                                    '\<td>'+value.titulo+'</td>'+
                                                    '\<td>'+
                                                        '\<a data-toggle="tooltip" title="Editar Tarefa" class="btn btn-default btn-editar" data-id="'+value.id+'"><span class="glyphicon glyphicon-edit"></span></a>'+
                                                        '\<a data-toggle="tooltip" title="Excluir Tarefa" class="btn btn-default btn-excluir" data-id="'+value.id+'"><span class="glyphicon glyphicon-trash"></span></a>'+
                                                        '\<a data-toggle="tooltip" title="Enviar Tarefa para Em Andamento" class="btn btn-default btn-enviar-em-andamento" data-id="'+value.id+'"><span class="glyphicon glyphicon-send"></span></a>'+
                                                    '\</td>'+
                                              '\<tr>';
                        });
                    }else{
                        html_concluida = html_nenhum_registro;
                    }
                    $('.tarefas_concluidas').html(html_concluida);

                    // VALIDA PARA MONTAR O HTML DO STATUS PAUSADA
                    if(dados.tarefas.pausada.length > 0){
                        $(dados.tarefas.pausada).each(function(key,value){
                            html_pausada += '<tr data-id="'+value.id+'" id="drag'+value.id+'" >'+
                                                    '\<td>'+value.id+'</td>'+
                                                    '\<td>'+value.titulo+'</td>'+
                                                    '\<td>'+
                                                        '\<a data-toggle="tooltip" title="Editar Tarefa" class="btn btn-default btn-editar" data-id="'+value.id+'"><span class="glyphicon glyphicon-edit"></span></a>'+
                                                        '\<a data-toggle="tooltip" title="Excluir Tarefa" class="btn btn-default btn-excluir" data-id="'+value.id+'"><span class="glyphicon glyphicon-trash"></span></a>'+
                                                        '\<a data-toggle="tooltip" title="Enviar Tarefa para Em Andamento" class="btn btn-default btn-enviar-em-andamento" data-id="'+value.id+'"><span class="glyphicon glyphicon-send"></span></a>'+
                                                    '\</td>'+
                                              '\<tr>';
                        });
                    }else{
                        html_pausada = html_nenhum_registro;
                    }
                    $('.tarefas_pausada').html(html_pausada);
                }
            },
            error: function(data){
                if(data.status != 422){
                    alert('Não foi possível buscar os dados. Por favor tente novamente mais tarde.');
                }
            }
        });          
    }

    // FUNCAO RESPONSAVEL POR DELETAR UMA TAREFA
    function deletarTarefa(task_id){
        $.ajax({
            url: url+'task/deletar/'+task_id,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if(data.success){
                    // atualiza as tarefas
                    alert("Tarefa removida com sucesso");
                    getTarefas();
                }
            },
            error: function(data){
                if(data.status != 422){
                    alert('Não foi possível deletar os dados. Por favor tente novamente mais tarde.');
                }
            }
        });          
    }

    // FUNCAO RESPONSAVEL POR EDITAR UMA TAREFA
    function editarTarefa(task_id){
        $.ajax({
            url: url+'task/getTaskById/'+task_id,
            type: 'GET',
            success: function (data) {
                if(data){
                    $('#task_id').val(data.data.tarefa.id);
                    $('#titulo').val(data.data.tarefa.titulo);
                    $('#descricao').val(data.data.tarefa.descricao);
                    $('.modal-tarefas').modal('show');
                }
            },
            error: function(data){
                if(data.status != 422){
                    alert('Não foi possível deletar os dados. Por favor tente novamente mais tarde.');
                }
            }
        });          
    }

    // FUNCAO REPONSAVEL POR HABILITAR O DRAG IN DROP DAS COLUNAS
    $(document).ready(function() {
        var $tabs = $('#t_draggable3');
        $("tbody.t_sortable").sortable({
            cursor: "move",
            connectWith: ".t_sortable",
            appendTo: $tabs,
            helper:"clone",
            zIndex: 999990,
            receive: function( event, ui ) {
                var data = event.target;
                if ($(data).hasClass('tarefas_aguardando')){
                    var id      = ui.item.attr("data-id");
                    var status  = 1;
                    alterarStatus(id,status)
                }

                if ($(data).hasClass('tarefas_concluidas')){
                    var id      = ui.item.attr("data-id");
                    var status  = 4;
                    alterarStatus(id,status)
                }

                if ($(data).hasClass('tarefas_em_andamento')){
                    var id      = ui.item.attr("data-id");
                    var status  = 2;
                    alterarStatus(id,status)
                }
            }
        }).disableSelection();
    });
</script>