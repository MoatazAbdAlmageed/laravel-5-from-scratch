<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	protected $fillable = [ 'body' ];

//	protected $quarded = ['body'];

	protected static function incomplete() {
		return static::where( 'completed', 0 )->get();
	}

	public  function toDayDateTimeString($date) {
		return $date->toDayDateTimeString();
	}

	protected static function complete() {
		return static::where( 'completed', 1 )->get();
	}


	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
