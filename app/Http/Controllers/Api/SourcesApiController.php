<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Source;
use Illuminate\Http\Request;

class SourcesApiController extends Controller
{
    /**
     * Returns all sources by agent
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $agent_id
     * @return json
     */
    public function __invoke(Request $request, $agent_id)
    {
        if (!\Gate::allows('officer-to-agent', $agent_id)) {
            abort(403);
        }

        $sources_array = [];
        $sources = Source::where('user_id', $agent_id)->get();
        
        foreach($sources as $source)
        {
            $sources_array[] = [
                "id" => $source->id,
                "name" => $source->name
            ];
        }

        return json_encode($sources_array);
    }
}
