@extends('layout.master')
@section('content')

<div class="t_container container pb-5">
    <div class="col-md-12 p-4">
        <div class="col-md-12 mb-3">
            <h4 class="title">
               Cidades
            </h4>
            <hr>
        </div>
        <div class="col-md-12 ">
            <div class="scroll">
                <table class="table table-dark table-striped">
                    <thead>
                        <th>Nome</th>
                        <th>País</th>
                        <th>Visualizar</th>
                    </thead>
                    <tbody>
                        @foreach($cities as $c)
                            <tr>
                                <td width="50%">{{ $c->api_name }}</td>
                                <td>{{ $c->country }}</td>
                                <td><a href="{{ url('city/'.$c->api_id) }}" class="button mr-mb-5">Visualizar</a>
                                    <!-- <a href="{{ url('city/remove') }}" class="button_del">Remover</a> --></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <a href="{{ url('city/create') }}" class="button float-right mt-5">Adicionar Nova Cidade</a>    
        </div>
    </div>
</div>


@endsection