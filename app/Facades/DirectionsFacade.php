<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

use App\Libraries\Directions;

class DirectionsFacade extends Facade {
	protected static function getFacadeAccessor() { return 'directions'; }
}
