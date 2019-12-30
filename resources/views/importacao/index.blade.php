@extends('adminlte::page')

@section('title', 'Importações')

@section('content_header')
    <h1>Importações</h1>
@stop

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <ul class="nav nav-pills">
        <li role="presentation"><a href="{{url("/importacao/new")}}">Nova Importação</a></li>
    </ul>

    <div class="box">
        <div class="box-body">
            <table id="tabela" class="table-responsive table-condensed table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data e Hora</th>
                        <th>Tipo de Modalidade</th>
                        <th>É automática?</th>
                        <th width="20%">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($importacoes as $importacao)
                        <tr>
                            <td>{{$importacao->id}}</td>
                            <td>{{$importacao->created_at}}</td>
                            <td>
                                @switch($importacao->tipo_modalidade)
                                    @case(0)
                                        STD
                                        @break
                                    @case(1)
                                        RPD
                                        @break
                                    @case(2)
                                        BTZ
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @if($importacao->e_automatico)
                                    Sim
                                @else
                                    Não
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{url("/importacao/delete/".$importacao->id)}}" role="button">Apagar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section("js")
<script type="text/javascript">
    $(document).ready(function(){
        $("#tabela").DataTable({
            responsive: true,
        });
    });
</script>
@endsection
