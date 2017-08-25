<?php

namespace App\Libraries;

use Exception;
use Carbon\Carbon;
use Goutte\Client;

class Scoreboard{

	protected $client;

	public function __construct()
	{
		$this->client  = new Client;
		$this->client->setHeader('user-agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36');
	}

	public static function league($league, $date = null)
	{
    if(!is_null($date)) $date = sprintf("/_/date/%s", Carbon::parse($date)->format('Ymd') );

    $self     = new static;
    $base     = sprintf("http://www.espn.com/%s/scoreboard%s", $league, $date);
    $crawler  = $self->client->request('GET', $base);

    $javascripts = collect($crawler->filter('script')->each(function ($node) {
    	if(substr( $node->text(), 0, 26 ) === "window.espn.scoreboardData") return $node->text();
    }))->filter()->first();

    return json_decode(trim(collect(explode("};", $javascripts))->first() . "}", ' window.espn.scoreboardData 	= '));
	}
}