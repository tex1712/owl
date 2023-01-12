<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

use App\Libraries\Sources;

class SourcesFacade extends Facade {
	protected static function getFacadeAccessor() { return 'sources'; }
}
