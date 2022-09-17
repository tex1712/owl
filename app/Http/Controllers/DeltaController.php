<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Delta;


class DeltaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deltas = Delta::all();
        return view('delta.index', compact('deltas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('delta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $delta = new Delta;
        $delta->fill($request->except('coordinates'));
        $delta->coordinates = json_encode($request->input('coordinates'));
        $delta->user_id = 1;
        $delta->save();

        return redirect()->route('delta.show', $delta->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delta = Delta::find($id);
        return view('delta.show', compact('delta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delta = Delta::find($id);
        return view('delta.edit', compact('delta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $delta = Delta::findOrFail($id);
        $delta->fill($request->except('coordinates'));
        $delta->coordinates = json_encode($request->input('coordinates'));
        $delta->save();

        return redirect()->route('delta.show', $delta->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delta = Delta::findOrFail($id);
        $delta->delete();

        return redirect()->route('delta.index');
    }


}
