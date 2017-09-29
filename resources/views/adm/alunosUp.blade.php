@extends('layout.base')

@section('menu')

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a href="/home">
                        <i class="material-icons">view_compact</i>
                        <p>Calendário de Eventos</p>
                    </a>
                </li>
                <li>
                    <a href="inscricoes">
                        <i class="material-icons">list</i>
                        <p>Gerenciar Eventos</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">school</i>
                        <p>Gerenciar Certificados</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">person</i>
                        <p>Inscrever Participantes</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">group_add</i>
                        <p>Gerência de Usuários</p>
                    </a>
                </li>
                <li class="active">
                    <a href="alunos">
                        <i class="material-icons">people</i>
                        <p>Gerencia de Alunos</p>
                    </a>
                </li>
            </ul>
        </div>

@endsection

@section('conteudo')

    {!! Form::model( [
            'method' => 'POST',
            'route' => ['adm.alunosUp']
        ]) !!}

    <div class="form-group">
        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
        {!! Form::text('search', null, ['class' => 'form-control']) !!}
    </div>


    {!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}







@endsection