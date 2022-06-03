<?php

namespace App\Http\Controllers;

use App\Models\Enquete;
use App\Http\Requests\EnqueteRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class EnqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $filter = $request->filter ;
        $filtered = '' ;

        $enquetes = Enquete::all() ;
        if($filter){

            $enquetes = $enquetes->filter(function($value, $key)use($filter) {
                if($value['status'] == $filter) {
                    return $value;
                }
            });
            $filtered = $filter ;
        }

        return view('Main.Enquete.index', [

            'enquetes' => $enquetes,
            'filter' => $filtered
        ]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Main.Enquete.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EnqueteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnqueteRequest $request)
    {

        $form = $request->all() ;

        $enquete = Enquete::create($form) ;

        foreach ($form['option'] as $key => $value)
            if($value != '')
            Option::create([

                'content' => $value,
                'enquete_id' => $enquete->id
            ])
        ;

        // dd($enquete) ;
        return back()->with([

            'success' => true,
            'message' => 'Enquete Criada com Sucesso!'
        ]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function show(Enquete $enquete)
    {

        // dd($enquete->toArray()) ;
        return view('Main.Enquete.show', [
            'enquete' => $enquete
        ]) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquete $enquete)
    {

        // dd($enquete) ;
        return view('Main.Enquete.edit', [
            'enquete' => $enquete
        ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EnqueteRequest  $request
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function update(EnqueteRequest $request, Enquete $enquete)
    {

        $form = $request->all() ;

        // dd($enquete) ;

        if($enquete->update($form)){

            foreach($enquete->options as $option)
                $option->delete()
            ;

            foreach ($form['option'] as $key => $value)
                if($value != '')
                Option::create([

                    'content' => $value,
                    'enquete_id' => $enquete->id
                ])
            ;

            return redirect(route('enquete-edit', $enquete->id))->with([

                'success' => true,
                'message' => 'Enquete Alterada com Sucesso!'
            ]) ;
        }else return redirect(route('enquete-edit', $enquete->id))->with([

            'error' => true,
            'message' => 'Sinto Muito. ALgo deu Errado.'
        ]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquete  $enquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquete $enquete)
    {

        // dd($enquete) ;
        if($enquete->delete())
            return back()->with([

                'success' => true,
                'message' => 'Enquete Excluida com Sucesso!'
            ]) ;
        else return back()->with([

            'error' => true,
            'message' => 'Sinto Muito. Algo deu Errado'
        ]) ;
    }
}
