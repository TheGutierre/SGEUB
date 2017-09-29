<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:pessoa',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function read()
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $query = Pessoa::where('funcao', 'Administrador')
                ->orWhere('funcao', 'Coordenador')
                ->join('users', 'pessoa.idPessoa', '=', 'users.idPessoa')
                ->select('pessoa.nome as Nome', 'pessoa.funcao as Funcao', 'users.email as Email', 'pessoa.idPessoa as ID')
                ->orderBy('pessoa.nome')
                ->paginate(15);
            return view('adm.listAdm', ['admins' => $query]);
        }
        else{
            return view('home');
        }
    }

    public function search(Request $request){
        $query = Pessoa::where('nome','like', '%'.$request['search'].'%')
            ->where('funcao', 'Administrador')
            ->join('users', 'pessoa.idPessoa', '=', 'users.idPessoa')
            ->select('pessoa.nome as Nome', 'pessoa.funcao as Funcao', 'users.email as Email', 'pessoa.idPessoa as ID')
            ->orderBy('pessoa.nome')
            ->paginate(15);
        return view('adm.listAdm', ['admins' => $query]);
    }

    protected function create(Request $request)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $pessoa = Pessoa::create([
                'nome' => $request['name'],
                'cpf' => $request['cpf'],
                'funcao' => $request['funcao'],
                'dataNasc' => $request['dataNasc']
            ]);

            User::create([
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'idPessoa' => $pessoa->idPessoa
            ]);

            return Redirect::to('lista/adm');
        }
        else{
            return view('home');
        }
    }

    public function destroy($idPessoa)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $user = User::where('idPessoa', '=', $idPessoa)->first();
            $user->delete();

            $pessoa = Pessoa::findOrFail($idPessoa);
            $pessoa->delete();

            Session::flash('flash_message', 'Usuário deletado com sucesso!');

            return back()->withInput();
        }
        else{
            return view('home');
        }
    }
    public function update(Request $request)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $usuario = User::where('idPessoa', $request['iduser'])->first();
            $usuario->email = $request['email'];
            $usuario->password = bcrypt($request['password']);

            $pessoa = Pessoa::where('idPessoa', $request['iduser'])->first();
            $pessoa->nome = $request['nome'];
            $pessoa->cpf = $request['cpf'];
            $pessoa->funcao = $request['funcao'];
            $pessoa->dataNasc = $request['dataNasc'];

            $usuario->save();
            $pessoa->save();

            Session::flash('flash_message', 'Informações atualizadas com sucesso!');

            return Redirect::to('lista/adm');
        }
        else{
            return view('home');
        }
    }

    public function edit($id, Request $request)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            // get dados do Usuário
            $taskUse = User::where('idPessoa', $id)->first();

            $taskPes = Pessoa::where('idPessoa', $id)->first();


            // show the edit form and pass the nerd
            return view('adm.updateAdm', ['user' => $taskUse, 'pessoa' => $taskPes]);
        }
        else{
            return view('home');
        }
    }

    public function editProf()
    {
        $iduser = Auth::user()->idPessoa;

        //print dd($iduser);
        // get dados do Usuário
        $taskUse = User::where('idPessoa', $iduser)->first();

        $taskPes = Pessoa::where('idPessoa', $iduser)->first();


        // show the edit form and pass the nerd
        return view('editAdm', ['user' => $taskUse, 'pessoa' => $taskPes]);
    }
    public function updateProf(Request $request)
    {
        $usuario = User::where('idPessoa', $request['iduser'])->first();
        $usuario->email = $request['email'];
        $usuario->password = bcrypt($request['password']);

        $pessoa = Pessoa::where('idPessoa', $request['iduser'])->first();
        $pessoa->nome = $request['nome'];
        $pessoa->cpf = $request['cpf'];
        $pessoa->funcao = $request['funcao'];
        $pessoa->dataNasc = $request['dataNasc'];

        $usuario->save();
        $pessoa->save();

        Session::flash('flash_message', 'Informações atualizadas com sucesso!');

        return Redirect::to('editAdm');
    }
}
