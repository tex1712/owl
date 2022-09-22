<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

use App\Libraries\Users;

class UsersFacade extends Facade {
	protected static function getFacadeAccessor() { return 'users'; }
}
