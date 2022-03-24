<?php

namespace App\Http\Controllers;

use App\Models\Enquete;
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
        //
        //return view('enquetes.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //traz a view para cadastrar uma nova enquete
    public function create(){
        return view('enquetes.create');
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
            'pergunta'=> 'required',
            'resposta'=> 'required'
        ]);

        // pega os valores do formulario
        Enquete::create($request->all());

        //retorna sucesso da operação
        return redirect() ->route('enquetes.create')
            ->with('mensagem', 'Enquete salva com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function show(Enquete $enquete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquete $enquete)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquete $enquete)
    {
        //
    }
}
