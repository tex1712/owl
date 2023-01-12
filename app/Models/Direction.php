<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title'];

    public function targets() {
        return $this->hasMany('App\Models\Target');
    }

}
