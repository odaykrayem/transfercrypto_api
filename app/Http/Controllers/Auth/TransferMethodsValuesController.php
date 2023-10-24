<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Http\Resources\TransferMethodsValuesCollection;
use App\Http\Resources\TransferMethodsValuesResource;
use App\Models\TransferMethodsValues;
use Illuminate\Http\Request;

class TransferMethodsValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TransferMethodsValuesCollection(TransferMethodsValues::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new TransferMethodsValuesResource(TransferMethodsValues::create($request->all()));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MethodsValues  $MethodsValues
     * @return \Illuminate\Http\Response
     */
    public function show(TransferMethodsValues $MethodsValues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MethodsValues  $MethodsValues
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferMethodsValues $MethodsValues)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MethodsValues  $MethodsValues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransferMethodsValues $MethodsValues)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MethodsValues  $MethodsValues
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferMethodsValues $MethodsValues)
    {
        //
    }
}
