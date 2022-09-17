<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

use App\Libraries\Delta;

class DeltaFacade extends Facade {
	protected static function getFacadeAccessor() { return 'delta'; }
}
