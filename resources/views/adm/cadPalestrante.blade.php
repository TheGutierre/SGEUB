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
                <a href="#">
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
            <li class="active">
                <a href="/lista/palestrante">
                    <i class="material-icons">person</i>
                    <p>Gerenciar Palestrante</p>
                </a>
            </li>
            <li>
                <a href="/lista/adm">
                    <i class="material-icons">group_add</i>
                    <p>Gerência de Usuários</p>
                </a>
            </li>
            <li>
                <a href="/lista/alunos">
                    <i class="material-icons">people</i>
                    <p>Gerencia de Alunos</p>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('conteudo')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Cadastro de Palestrante</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('adm.cadPalestrante') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Nome</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                        <label for="cpf" class="col-md-4 control-label">CPF</label>

                        <div class="col-md-6">
                            <input id="cpf" type="text" class="form-control" name="cpf" maxlength="14" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);" value="{{ old('cpf') }}" required>

                            @if ($errors->has('cpf'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('dataNasc') ? ' has-error' : '' }}">
                        <label for="dataNasc" class="col-md-4 control-label">Data de Nascimento</label>

                        <div class="col-md-6">
                            <input id="dataNasc" type="date" class="form-control" name="dataNasc" value="{{ old('dataNasc') }}" required>

                            @if ($errors->has('dataNasc'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('dataNasc') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('formacao') ? ' has-error' : '' }}">
                        <label for="formacao" class="col-md-4 control-label">Formação</label>

                        <div class="col-md-6">
                            <input id="formacao" type="text" class="form-control" name="formacao" value="{{ old('formacao') }}" required autofocus>

                            @if ($errors->has('formacao'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('formacao') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection