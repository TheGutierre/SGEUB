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
            <li>
                <a href="/lista/palestrante">
                    <i class="material-icons">person</i>
                    <p>Gerenciar Palestrantes</p>
                </a>
            </li>
            <li class="active">
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
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif



    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Dados do Usuário
            </div>


            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{route('adm.updateAdm')}}">
                    {{ csrf_field() }}

                    <input name="iduser" type="hidden" class="form-control" id="iduser" value="{{$user->idPessoa}}" />

                    <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Nome</label>

                        <div class="col-md-6">
                            <input id="nome" type="text" class="form-control" name="nome" value="{{ $pessoa->nome }}" required autofocus>

                            @if ($errors->has('nome'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                        <label for="matricula" class="col-md-4 control-label">CPF</label>

                        <div class="col-md-6">
                            <input id="cpf" type="text" class="form-control" name="cpf" maxlength="14" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);" value="{{ $pessoa->cpf }}" required>

                            @if ($errors->has('matricula'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('matricula') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('dataNasc') ? ' has-error' : '' }}">
                        <label for="dataNasc" class="col-md-4 control-label">Data de Nascimento</label>

                        <div class="col-md-6">
                            <input id="dataNasc" type="date" class="form-control" name="dataNasc" value="{{ $pessoa->dataNasc }}" required>

                            @if ($errors->has('dataNasc'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('dataNasc') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('funcao') ? ' has-error' : '' }}">
                        <label for="funcao" class="col-md-4 control-label">Função</label>

                        <div class="col-md-6">
                            <select id="funcao" class="form-control" name="funcao" value="{{ $pessoa->funcao }}" required>
                                @if($pessoa->funcao == "Coordenador")
                                    <option value="Coordenador">Coordenador</option>
                                    <option value="Administrador">Administrador</option>
                                @else
                                    <option value="Administrador">Administrador</option>
                                    <option value="Coordenador">Coordenador</option>
                                @endif
                            </select>

                            @if ($errors->has('funcao'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('funcao') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Senha</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmação de Senha</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">
                                Atualizar
                            </button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
