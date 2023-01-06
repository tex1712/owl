<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Delta;


class DeltaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $deltas = Delta::select("*")
                ->when($request->filled('agent_id'), function ($query) use ($request) {
                    $query->where('agent_id', $request->agent_id);
                })
                ->when($request->filled('officer_id'), function ($query) use ($request) {
                    $query->where('officer_id', $request->officer_id);
                })
                ->when($request->filled('status'), function ($query) use ($request) {
                    $query->where('status', $request->status);
                })
                ->when($request->filled('source_id'), function ($query) use ($request) {
                    $query->where('source_id', $request->source_id);
                })
                ->when($request->filled('tags'), function ($query) use ($request) {
                    $query->withAnyTags($request->input('tags'));
                })
                ->when(\Auth::user()->isAgent(), function ($query) use ($request){
                    $query->where('agent_id', \Auth::id());
                })
                ->when(\Auth::user()->isOfficer(), function ($query) use ($request){
                    $query->where('officer_id', \Auth::id());
                })
                ->get();

        return view('delta.index', compact('deltas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!\Gate::allows('agent')) {
            abort(403);
        }

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
        if (!\Gate::allows('agent')) {
            abort(403);
        }

        $delta = new Delta;
        $delta->fill($request->except(['coordinates']));
        $delta->coordinates = json_encode($request->input('coordinates'));
        $delta->user_id = \Auth::id();
        if(\Auth::user()->isAgent()){
            $delta->agent_id = \Auth::id();
            $delta->officer_id = \Auth::user()->officer_id;
        }
        $delta->status = 0;
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

        if (!\Gate::allows('delta_view', $delta)) {
            abort(403);
        }
        
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

        if (!\Gate::allows('delta_manage', $delta)) {
            abort(403);
        }

        $coordinates = json_decode($delta->coordinates);

        return view('delta.edit', compact('delta', 'coordinates'));
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

        if (!\Gate::allows('delta_manage', $delta)) {
            abort(403);
        }

        $delta->fill($request->except(['tags']));
        $delta->syncTags($request->input('tags'));
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

        if (!\Gate::allows('delta_manage', $delta)) {
            abort(403);
        }
        
        $delta->delete();
        return redirect()->route('delta.index');
    }



    public function changeStatus(Request $request){
        $delta = Delta::find($request->input('id'));

        if($delta){
            $delta->status = boolval(json_decode($request->input('status')));
            $delta->save();
        }

    }

}
