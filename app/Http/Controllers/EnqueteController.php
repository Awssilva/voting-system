<?php

namespace App\Http\Controllers;

use App\Models\Enquete;
use App\Models\EnqueteOpcoes;
use Illuminate\Http\Request;

class EnqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquetes = Enquete::all();
        return view('enquete.index', compact('enquetes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //traz a view para cadastrar uma nova enquete
    public function create(){
        return view('enquete.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //valida o formulario
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'opcoes' => 'required','array','min:3'
        ]);


        if(count($request->opcoes) < 3){
            return redirect()->back()->with('error', 'A enquete deve ter no mínimo 3 opções!');
        }


        // pega os valores do formulario
        Enquete::create($request->all());
        //save opcoes
        $enquete = Enquete::all()->last();
        foreach($request->opcoes as $opcao){
            EnqueteOpcoes::create([
                'enquete_id' => $enquete->id,
                'opcao' => $opcao
            ]);
        }





        //retorna sucesso da operação
        return redirect() ->route('enquete.index')->with('mensagem', 'Enquete cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function show(Enquete $enquete)
    {
        $opcoes = EnqueteOpcoes::where('enquete_id', $enquete->id)->get();
        // calcular total de votos
        $totalVotos = 0;
        foreach($opcoes as $opcao){
            $totalVotos += $opcao->votos;
        }
        // calcular porcentagem de votos
        foreach($opcoes as $opcao){
            if($totalVotos > 0){
                $opcao->porcentagem = number_format((($opcao->votos * 100) / $totalVotos), 2);
            }else{
                $opcao->porcentagem = 0;
            }
        }
        return view('enquete.votar', compact('enquete', 'opcoes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquete $enquete)
    {
        $opcoes = EnqueteOpcoes::where('enquete_id', $enquete->id)->get();
        return view('enquete.edit', compact('enquete', 'opcoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquete $enquete)
    {
        $request->validate([
            'titulo' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'opcoes' => 'required','array','min:3'
        ]);

        if(count($request->opcoes) < 3){
            return redirect()->back()->with('mensagem', 'A enquete deve ter no mínimo 3 opções!');
        }

        $enquete->update($request->all());

        //save opcoes
        // delete all opcoes
        EnqueteOpcoes::where('enquete_id', $enquete->id)->delete();
        foreach($request->opcoes as $opcao){
            EnqueteOpcoes::create([
                'enquete_id' => $enquete->id,
                'opcao' => $opcao
            ]);
        }

        return redirect() ->route('enquete.index')->with('mensagem', 'Enquete atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquete $enquete)
    {
        $enquete->delete();
        return redirect()->route('enquete.index')->with('mensagem', 'Enquete excluida com sucesso!');
    }

    public function votar($opcao_id){

        $opcao = EnqueteOpcoes::find($opcao_id);
        $opcao->votos = $opcao->votos + 1;
        $opcao->save();

        return redirect()->back()->with('mensagem', 'Voto computado com sucesso!');
    }
}
