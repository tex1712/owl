<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentsApiController extends Controller
{
   /**
     * Returns all agents connected with given officer
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $officer_id
     * @return json
     */
    public function __invoke(Request $request, $officer_id)
    {
        if (!\Gate::allows('admin')) {
            abort(403);
        }

        $agents_array = [];
        $agents = User::where('officer_id', $officer_id)->get();
        
        foreach($agents as $agent)
        {
            $agents_array[] = [
                "id" => $agent->id,
                "name" => $agent->name
            ];
        }

        return json_encode($agents_array);
    }
}
