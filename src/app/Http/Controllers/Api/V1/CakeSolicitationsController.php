<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cake;
use App\Models\CakeSolicitation;
use Illuminate\Http\Request;

class CakeSolicitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function index(Cake $cake)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cake $cake)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cake  $cake
     * @param  \App\Models\CakeSolicitation  $cakeSolicitation
     * @return \Illuminate\Http\Response
     */
    public function show(Cake $cake, CakeSolicitation $cakeSolicitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cake  $cake
     * @param  \App\Models\CakeSolicitation  $cakeSolicitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cake $cake, CakeSolicitation $cakeSolicitation)
    {
        //
    }
}
