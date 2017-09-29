<?php

namespace App\Http\Controllers;

use App\Palestrante;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PalestranteController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:pessoa',
        ]);
    }


    public function read()
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $query = Palestrante::join('pessoa', 'palestrante.idPessoa', '=', 'pessoa.idPessoa')
                ->select('pessoa.nome as Nome', 'palestrante.formacao as Formacao', 'pessoa.idPessoa as ID')
                ->orderBy('pessoa.nome')
                ->paginate(15);
            return view('adm.listPalestrantes', ['palestrantes' => $query]);
        }
        else{
            return view('home');
        }
    }
    public function search(Request $request){
        $query = Pessoa::where('nome','like', '%'.$request['search'].'%')
            ->join('palestrante', 'palestrante.idPessoa', '=', 'pessoa.idPessoa')
            ->select('pessoa.nome as Nome', 'palestrante.formacao as Formacao', 'pessoa.idPessoa as ID')
            ->orderBy('pessoa.nome')
            ->paginate(15);
        return view('adm.listPalestrantes', ['palestrantes' => $query]);
    }

    protected function create(Request $request)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $pessoa = Pessoa::create([
                'nome' => $request['name'],
                'cpf' => $request['cpf'],
                'dataNasc' => $request['dataNasc']
            ]);

            Palestrante::create([
                'formacao' => $request['formacao'],
                'idPessoa' => $pessoa->idPessoa
            ]);

            return Redirect::to('lista/palestrante');
        }
        else{
            return view('home');
        }
    }

    public function destroy($idPessoa)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $palestrante = Palestrante::where('idPessoa', '=', $idPessoa)->first();
            $palestrante->delete();

            $pessoa = Pessoa::findOrFail($idPessoa);
            $pessoa->delete();

            Session::flash('flash_message', 'Palestrante deletado com sucesso!');

            return back()->withInput();
        }
        else{
            return view('home');
        }
    }
    public function update(Request $request)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            $pessoa = Pessoa::where('idPessoa', $request['iduser'])->first();
            $pessoa->nome = $request['nome'];
            $pessoa->cpf = $request['cpf'];
            $pessoa->dataNasc = $request['dataNasc'];

            $palestrante = Palestrante::where('idPessoa', $request['iduser'])->first();
            $palestrante->formacao = $request['formacao'];

            $pessoa->save();
            $palestrante->save();

            Session::flash('flash_message', 'Informações atualizadas com sucesso!');

            return Redirect::to('/lista/palestrante');
        }
        else{
            return view('home');
        }
    }

    public function edit($id, Request $request)
    {
        if(Auth::user()->pessoa()->first()->funcao == "Administrador") {
            // get dados do Palestrante
            $taskPale = Palestrante::where('idPessoa', $id)->first();
            $taskPes = Pessoa::where('idPessoa', $id)->first();

            // show the edit form and pass the nerd
            return view('adm.updatePalestrante', ['palestrante' => $taskPale, 'pessoa' => $taskPes]);
        }
        else{
            return view('home');
        }
    }
}
