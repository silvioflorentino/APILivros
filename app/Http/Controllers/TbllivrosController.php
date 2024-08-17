<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\tbllivros;


class TbllivrosController extends Controller
{
    //construir o crud.
    
    //Mostrar todos os registros da tabela livros
    //Crud -> Read(leitura) Select/Visualizar

    public function index(){
        $regBook = tbllivros::All();
        $contador = $regBook->count();

        return 'Livros: '.$contador.$regBook.Response()->json([],Response::HTTP_NO_CONTENT);
    }
    //Mostrar um tipo de registro especifico
    //Crud -> Read(leitura) Select/Visualizar
    //A função show busca a id e retorna se o livros foram localizados por id.

    public function show(string $id){ 
        $regBook = tbllivros::find($id);

        if($regBook){
            return 'Livros Localizados: '.$regBook.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Livros não localizados. '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    //Cadastrar registros
    //Crud -> Create(criar/cadastrar)
    public function store(Request $request){
        $regBook = $request->All();

        $regVerifq = Validator::make($regBook,[
            'nomeLivro'=>'required',
            'generoLivro'=>'required',
            'anoLivro'=>'required'
        ]);

        if($regVerifq->fails()){
            return 'Registros Invalidos: '.Response()->json([],Response::HTTP_NO_CONTENT);

        }
        $regBookCad = tbllivros::create($regBook);

        if( $regBookCad){
            return 'Livros cadastrados: '.Response()->json([],Response::HTTP_NO_CONTENT);

        }else{
            return 'Livros não cadastrados: '.Response()->json([],Response::HTTP_NO_CONTENT);

        }

    }

    //Alterar registros
    //Crud -> update(alterar)
    public function update(Request $request,string $id){

        $regBook = $request->All();

        $regVerifq = Validator::make($regBook,[
            'nomeLivro'=>'required',
            'generoLivro'=>'required',
            'anoLivro'=>'required'
        ]);

        if($regVerifq->fails()){
            return 'Registros não atualizados: '.Response()->json([],Response::HTTP_NO_CONTENT);

        }
        $regBookBanco = tbllivros::Find($id);
        $regBookBanco->nomeLivro = $regBook['nomeLivro'];
        $regBookBanco->generoLivro = $regBook['generoLivro'];
        $regBookBanco->anoLivro = $regBook['anoLivro'];

        $retorno = $regBookBanco->save();

        if($retorno){
            return "Livro atualizado com sucesso.".Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return "Atenção... Erro: Livro não atualizado".Response()->json([],Response::HTTP_NO_CONTENT);
        }

    }

    //Deletar os registros
    //Crud -> delete(apagar)
    public function destroy(string $id){

    $regBook = tbllivros::Find($id);

    if($regBook->delete()){   
    return "O livro foi deletado com sucesso".response()->json([],Response::HTTP_NO_CONTENT);
    }

    return "Algo deu errado: Livro não deletado".response()->json([],Response::HTTP_NO_CONTENT);
    }

    //Crud
    //C reate
    //r ead
    //u pdate
    //d elete

}
