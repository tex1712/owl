<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Delta extends Model
{
    use HasFactory;
    use SoftDeletes;
	use HasTags;

	protected $table = 'delta';

	protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'date', 'time', 'location', 'direction_id', 'reliability', 'content', 'specific', 'civil', 'correction', 'coordinates', 'source_id', 'media', 'user_id', 'status', 'result', 'agent_id', 'officer_id', 'tags'
	];


	public function user() {
        return $this->belongsTo('App\Models\User');
    }

	public function agent() {
        return $this->belongsTo('App\Models\User');
    }

	public function officer() {
        return $this->belongsTo('App\Models\User');
    }

	public function direction() {
        return $this->belongsTo('App\Models\Direction');
    }

	public function source() {
        return $this->belongsTo('App\Models\Source');
    }


}
