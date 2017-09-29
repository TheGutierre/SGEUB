<?php

/**
 * Created by PhpStorm.
 * User: Gutierre
 * Date: 24/08/2017
 * Time: 11:57
 */
?>

@extends('layout.base')

@section('menu')
    @if (Auth::check())
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="active">
                    <a href="/">
                        <i class="material-icons">view_compact</i>
                        <p>Calendário de Eventos</p>
                    </a>
                </li>
                <li>
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
    @else
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="active">
                    <a href="/">
                        <i class="material-icons">dashboard</i>
                        <p>Calendário de Eventos</p>
                    </a>
                </li>
            </ul>
        </div>
    @endif

@endsection

@section('conteudo')

    <div>
            <div class="agenda">
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered">

                        <tbody>
                        <tr>
                            <td class="agenda-date" class="active" rowspan="1" >
                                <div class="dayofmonth">26</div>
                                <div class="dayofweek">Saturday</div>
                                <div class="shortdate text-muted">July, 2014</div>
                            </td>

                            <td class="agenda-events">
                                <div class="agenda-event">
                                    <b><font size="5" style="line-height: 0%">Nome do Evento</font></b>
                                    <p style="line-height: 80%" align="button">Descrição </p>
                                </div>
                            </td>
                            <td class="status">
                                <div style='text-align:center' class="agenda-event">
                                    Status
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
    </div>

@endsection