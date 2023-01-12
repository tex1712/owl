<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

use App\Libraries\Targets;

class TargetsFacade extends Facade {
	protected static function getFacadeAccessor() { return 'targets'; }
}
