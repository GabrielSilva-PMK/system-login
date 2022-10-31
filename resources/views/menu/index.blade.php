@extends('layouts.authBase')

@section('content')

<style>
    body{
        margin: 0;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        text-align: left;
        background-color: #f5f8fa;
    }
    .navbar-laravel
    {
        box-shadow: 0 2px 4px rgba(0,0,0,.04);
    }
    .navbar-brand , .nav-link, .my-form, .login-form
    {
        font-family: Raleway, sans-serif;
    }
    .my-form
    {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
    .my-form .row
    {
        margin-left: 0;
        margin-right: 0;
    }
    .menu-form
    {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
    .menu-form .row
    {
        margin-left: 0;
        margin-right: 0;
    }
</style>

<main class="menu-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @if (\Session::has('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{!! \Session::get('errors') !!}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden=true>&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{!! \Session::get('success') !!}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden=true>&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- INCIO CARD LISTA MENU -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a class="btn btn-info btn-sm mb-3" href="javascript:history.back()">Voltar</a>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h2 style="margin-left: 30px;">
                                        Menu
                                    </h2>
                                    {{-- @if (permissao('permission', 'create')) --}}
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="margin-left: auto; margin-right: 15px;">
                                            <a class="btn btn-success btn-sm btn-block" href="{{ route('menu.create') }}" role="button">
                                                Cadastrar <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    {{-- @endif --}}
                                </div>
                                <div class="table-responsive-sm  table-responsive-md mt-3">
                                    <table id="menuDataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tipo</th>
                                                <th>name</th>
                                                <th>Data Criação</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($menu as $value)
                                                <tr class="table-active" id="{{ $value->id }}">
                                                    <th>{{$value->id}}</th>
                                                    <td>{{$value->id_menu_type }}</td>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{\Carbon\Carbon::parse($value->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</td>
                                                    <td class="text-center">
                                                        {{-- @if (permissao('permission', 'edit')) --}}
                                                            <a class="btn btn-primary btn-sm" href="{{ route('menu.edit',['id' => $value->id]) }}" role="button">
                                                                Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                        {{-- @endif --}}
                                                        {{-- @if (permissao('permission', 'destroy')) --}}
                                                            <button type="button" name="excluir" value="{{ $value->id }}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal">
                                                                Excluir <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            </button>
                                                        {{-- @endif --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM CARD LISTA MENU -->
            </div>
        </div>
    </div>
</main>

{{-- INICIO MODAL DELETE --}}
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deseja realmente excluir este registro?</h5>
            </div>
            <div class="modal-footer">
                <form name="delete-form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Sim</button>
                </form>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
{{-- FIM MODAL DELETE --}}

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#menuDataTable').DataTable({
                "language" : {
                        "decimal": ",",
                        "thousands": ",",
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando  _START_ até _END_ de _TOTAL_ Resultados",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de MAX registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        }
                    }
            });
            $('.dataTables_length').addClass('bs-select');
        });
        $("[name='excluir'").click(function(){
            var action = $("[name='delete-form']").attr('action',"menu/"+$(this).val());
        })
    </script>
@endsection

