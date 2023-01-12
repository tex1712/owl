<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Target;


class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $targets = Target::select("*")
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

        return view('target.index', compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('target.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $target = new Target;
        $target->fill($request->all());
        $target->user_id = \Auth::id();
        if(\Auth::user()->isAgent()){
            $target->agent_id = \Auth::id();
        }
        $target->officer_id = \Users::getOfficerIdByAgentId($target->agent_id);
        $target->status = 0;
        $target->save();

        return redirect()->route('target.show', $target->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $target = Target::find($id);

        if (!\Gate::allows('target_access', $target)) {
            abort(403);
        }
        
        return view('target.show', compact('target'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $target = Target::find($id);
        $coordinates = json_decode($target->coordinates);

        if (!\Gate::allows('target_access', $target)) {
            abort(403);
        }

        return view('target.edit', compact('target', 'coordinates'));
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
        $target = Target::findOrFail($id);

        if (!\Gate::allows('target_access', $target)) {
            abort(403);
        }

        $target->fill($request->except(['tags']));
        $target->syncTags($request->input('tags'));
        $target->save();

        return redirect()->route('target.show', $target->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Target::findOrFail($id);

        if (!\Gate::allows('target_access', $target)) {
            abort(403);
        }
        
        $target->delete();
        return redirect()->route('target.index');
    }



    public function changeStatus(Request $request){
        $target = Target::find($request->input('id'));

        if($target){
            $target->status = boolval(json_decode($request->input('status')));
            $target->save();
        }

    }

}
