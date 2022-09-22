<?php

namespace App\Libraries;

use App\Models\User;

class Users {


    /**
     * Returns User param by ID.
     *
     * @param int $id
     * @param string $param
     * @return string
     */
    public function getUserParamById($id, $param){
        $user = User::find($id);

        if($user)
            return $user->$param;
    }

}