<?php

namespace App\Libraries;

use App\Models\User;

class Users {


    /**
     * Returns User's name by given ID.
     *
     * @param int $id
     * @return string
     */
    public function getNameById($id)
    {
        $user = User::find($id);

        if($user->role == 'officer'){
            if (\Gate::allows('admin')) {
                return $user->name;
            }
        }

        if($user->role == 'agent'){
            if (\Gate::allows('officer-to-officer', $user->officer_id)) {
                return $user->name;
            }
        }

        return null;

    }


    /**
     * Returns Officer ID by Agent ID
     *
     * @param int $id
     * @return int
     */
    public function getOfficerIdByAgentId($agent_id){
        return User::find($agent_id)->officer_id;
    }


    /**
     * Returns list of Officers (only for admin)
     *
     * @return int
     */
    public function getOfficersList(){
        if (!\Gate::allows('admin')) {
            return false;
        }

        return User::where('role', 'officer')->pluck('name', 'id')->toArray();
    }


    /**
     * Returns list of Agents by given Officer ID
     *
     * @param int $officer_id
     * @return array
     */
    public function getAgentsListByOfficerId($officer_id){
        if(!$officer_id){
            return [];
        }
        if (!\Gate::allows('officer-to-officer', $officer_id)) {
            return [];
        }

        return User::where('role', 'agent')->where('officer_id', $officer_id)->pluck('name', 'id')->toArray();
    }


    /**
     * Update current user's API Token
     *
     * @return null
     */
    public function updateApiToken()
    {
        $user = \Auth::user();
        $user->api_token = \Str::random(60);
        $user->save();
    }

}