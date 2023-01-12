<?php

namespace App\Libraries;

use App\Models\Target;

class Targets {


    /**
     * Display a listing of the resource.
     *
     * @param string $param
     * @return array
     */
    public function getFormData($param){

        $data['reliability'] = [
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

        if(array_key_exists($param, $data))
            return $data[$param];
            
        return [];

    }


    /**
     * Returns the hall Tags list.
     *
     * @return array
     */
    public function getAllTags(){
        $tags_list = [];

        $tagIds = \DB::table('taggables')
        ->distinct()
        ->select('tag_id')
        ->where('taggable_type', Target::class)
        ->get()
        ->pluck('tag_id');
        $tags = \Spatie\Tags\Tag::whereIn('id', $tagIds)->get();

        foreach($tags as $tag){
            $tags_list[$tag->name] = $tag->name;
        }

        return $tags_list;
    }

    /**
     * Returns Tags list by Target ID.
     *
     * @param int $target_id
     * @return array
     */
    public function getTagsByTargetId($target_id)
    {
        $target = Target::find($target_id);
        $tags = [];

        foreach($target->tags as $tag){
            $tags[$tag->name] = $tag->name;
        }

        return $tags;
    }



    /**
     * Returns Target's coordinates for displaying
     *
     * @param int $target_id
     * @return array
     */
    public function getCoordinates($target_id)
    {
        $target = Target::findOrFail($target_id);
        $coordinates = json_decode($target->coordinates, true) ?? [];

        $coordinates_array = [];

        foreach($coordinates as $coordinates_types){
            foreach($coordinates_types as $coordinates_type){
                $coordinates_id = random_int(1000, 10000);
                $coordinates_array[$coordinates_id] = '';
    
                $i = 0;
                foreach($coordinates_type['coordinates'] as $coordinates){
                    if($i == 0){
                        $coordinates_array[$coordinates_id] .= $coordinates;
                    }
                    else{
                        $coordinates_array[$coordinates_id] .= '; ' . $coordinates;
                    }
                    $i++;
                }
                $coordinates_array[$coordinates_id] .= ' - ' . $coordinates_type['description'];
            }
        }

        return $coordinates_array;
        
    }

}