<?php

namespace App\Libraries;

use App\Models\Direction;
use App\Models\Source;
use App\Models\User;

class Delta {


    /**
     * Display a listing of the resource.
     *
     * @param string $param
     * @return array
     */
    public function getFormData($param){

        $data['directions'][''] = '';
        foreach(Direction::all() as $direction){
            $data['directions'][$direction->id] = $direction->title;
        }

        $data['sources'][''] = '';
        foreach(Source::all() as $source){
            $data['sources'][$source->id] = $source->name;
        }

        $data['reliability'] = [
            '' => '',
            'a' => 'A - Надійне',
            'b' => 'B - У цілому надійне',
            'c' => 'C - Зазвичай надійне',
            'd' => 'D - Не завжди надійне',
            'e' => 'E - Не надійне',
            'f' => 'F - Нове'
        ];

        $data['specific'] = [
            '' => '',
            'p' => 'Можливе',
            'i' => 'Неможливе',
            'd' => 'Ускладнене'
        ];

        $data['agents'] = User::where('role', 'agent')->pluck('name', 'id')->toArray();
        $data['officers'] = User::where('role', 'officer')->pluck('name', 'id')->toArray();

        return $data[$param];
    }
}