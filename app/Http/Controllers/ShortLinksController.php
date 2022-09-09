<?php

namespace App\Http\Controllers;

use App\Models\ShortLinks;
use App\Http\Requests\StoreShortLinksRequest;
use App\Http\Requests\UpdateShortLinksRequest;

class ShortLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreShortLinksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortLinksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShortLinks  $shortLinks
     * @return \Illuminate\Http\Response
     */
    public function show(ShortLinks $shortLinks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShortLinks  $shortLinks
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortLinks $shortLinks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShortLinksRequest  $request
     * @param  \App\Models\ShortLinks  $shortLinks
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShortLinksRequest $request, ShortLinks $shortLinks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShortLinks  $shortLinks
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortLinks $shortLinks)
    {
        //
    }
}
