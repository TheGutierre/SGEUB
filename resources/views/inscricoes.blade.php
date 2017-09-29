
@extends('layout.base')

@section('menu')
    @if (Auth::check())
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li >
                    <a href="/">
                        <i class="material-icons">view_compact</i>
                        <p>Calendário de Eventos</p>
                    </a>
                </li>
                <li class="active">
                    <a href="inscricoes">
                        <i class="material-icons">list</i>
                        <p>Minhas Inscrições</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">school</i>
                        <p>Certificados</p>
                    </a>
                </li>
            </ul>
        </div>
    @endif

@endsection

@section('conteudo')
    Inscrições!

@endsection