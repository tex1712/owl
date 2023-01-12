<?php

namespace App\Libraries;
use App\Models\Direction;

class Directions {

    /**
     * Returns Directions list
     *
     * @param int $agent_id
     * @return array
     */
    public function getAll()
    {
        return Direction::all()->pluck('title', 'id')->toArray();
    }
}