<?php

namespace App\Libraries;
use App\Models\Source;

class Sources {


    /**
     * Returns Sources list for given Agent
     *
     * @param int $agent_id
     * @return array
     */
    public function getByAgentId($agent_id)
    {
        if(!$agent_id){
            return [];
        }
        if (\Gate::allows('agent_access', $agent_id)) {
            return Source::where('user_id', $agent_id)->pluck('name', 'id')->toArray();
        }
        return []; 
    }


    /**
     * Returns Source's name by given ID
     *
     * @param int $agent_id
     * @return array
     */
    public function getNameById($source_id)
    {
        $source = Source::find($source_id);

        if (\Gate::allows('agent_access', $source->user_id)) {
            return $source->name;
        }

    }
}