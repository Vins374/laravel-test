<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Workshop extends Model
{
	protected $table = 'workshops';

	public function getActiveWorkShops()
	{
		$query = self::select();
		$query->where("start", ">", date("Y-m-d H:i:s"));
		$query->groupBy("event_id");
		return $query->with('event')->get();
	}

	public function event()
	{
		return $this->hasOne("App\Models\Event", "id", "event_id");
	}
}
