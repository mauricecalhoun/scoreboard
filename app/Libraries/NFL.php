<?php

namespace App\Libraries;

use Exception;
use App\Libraries\Scoreboard;

class NFL{

	public static function scoreboard($date = null)
	{
      return Scoreboard::league('nfl', $date)->events;
  }
}