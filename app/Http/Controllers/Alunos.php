<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Pessoa;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;


class Alunos extends Controller
{
    public function index()
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {

            $aluns = Aluno::join('pessoa', 'aluno.idPessoa', 'pessoa.idPessoa')
                ->join('users', 'users.idPessoa', 'pessoa.idPessoa')
                ->select('pessoa.nome as Nome', 'users.email as Email', 'aluno.matricula as Matricula', 'pessoa.idPessoa as ID')
                ->orderBy('pessoa.nome')
                ->paginate(15);

            return view('adm.alunos', ['aluns' => $aluns]);
        }
        else{
            return view('home');
        }
    }
    public function search(Request $request){
        $aluns = Pessoa::where('nome','like', '%'.$request['search'].'%')
            ->join('aluno', 'aluno.idPessoa', 'pessoa.idPessoa')
            ->join('users', 'users.idPessoa', 'pessoa.idPessoa')
            ->select('pessoa.nome as Nome', 'users.email as Email', 'aluno.matricula as Matricula', 'pessoa.idPessoa as ID')
            ->orderBy('pessoa.nome')
            ->paginate(15);
        return view('adm.alunos', ['aluns' => $aluns]);
    }

    public function destroy($idPessoa)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $alun = Aluno::where('idPessoa', '=', $idPessoa)->first();
            $alun->delete();

            $user = User::where('idPessoa', '=', $idPessoa)->first();
            $user->delete();

            $pessoa = Pessoa::findOrFail($idPessoa);
            $pessoa->delete();

            Session::flash('flash_message', 'Aluno deletado com Sucesso!');

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
            $pessoa->dataNasc = $request['dataNasc'];

            $aluno = Aluno::where('idPessoa', $request['iduser'])->first();
            $aluno->matricula = $request['matricula'];
            $aluno->periodo = $request['periodo'];

            $usuario->save();
            $pessoa->save();
            $aluno->save();

            Session::flash('flash_message', 'Informações atualizadas com sucesso!');

            return Redirect::to('lista/alunos');
        }
        else{
            return view('home');
        }
    }

    public function edit($id, Request $request)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador"){
            // get dados do Aluno
            $taskUse = User::where('idPessoa', $id)->first();

            $taskPes = Pessoa::where('idPessoa', $id)->first();
            $taskAlun = Aluno::where('idPessoa', $id)->first();

            // show the edit form and pass the nerd
            return view('adm.updateAluno', ['user' => $taskUse, 'alun' => $taskAlun, 'pessoa' => $taskPes]);
        }
        else{
            return view('home');
        }
    }

    public function editProf()
    {

        $iduser = Auth::user()->idPessoa;
        // get dados do Aluno
        $taskUse = User::where('idPessoa', $iduser)->first();

        $taskPes = Pessoa::where('idPessoa', $iduser)->first();
        $taskAlun = Aluno::where('idPessoa', $iduser)->first();

        // show the edit form and pass the nerd
        return view('editAluno', ['user' => $taskUse, 'alun' => $taskAlun, 'pessoa' => $taskPes]);
    }
    public function updateProf(Request $request)
    {
        $usuario = User::where('idPessoa', $request['iduser'])->first();
        $usuario->email = $request['email'];
        $usuario->password = bcrypt($request['password']);

        $pessoa = Pessoa::where('idPessoa', $request['iduser'])->first();
        $pessoa->nome = $request['nome'];
        $pessoa->dataNasc = $request['dataNasc'];

        $aluno = Aluno::where('idPessoa', $request['iduser'])->first();
        $aluno->matricula = $request['matricula'];
        $aluno->periodo = $request['periodo'];

        $usuario->save();
        $pessoa->save();
        $aluno->save();

        Session::flash('flash_message', 'Informações atualizadas com sucesso!');

        return Redirect::to('editAluno');
    }
}
