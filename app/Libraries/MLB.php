<?php

namespace App\Libraries;

use Exception;
use App\Libraries\Scoreboard;

class MLB{

	public static function scoreboard($date = null)
	{
      return collect(Scoreboard::league('mlb', $date)->events)->map(function($event){
        return collect((array) $event)->only(['competitions', 'weather'])->all();
      })->all();
  }
}