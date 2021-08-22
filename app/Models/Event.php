<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 'events';

	public function getAll($start = 0, $limit = 100)
	{
		try {
			$query = self::select();
			$query->skip($start);
			if(!empty($limit))
				$query->take($limit);
			return ["status" => true, "message" => "Event data", "data" => $query->with('workshops')->get() ];
		}
		catch(\Exception $e) {
			\Log::error($e->getFile(). ' - '. $e->getLine() .' - '. $e->getMessage());
			return ["status" => false, "message" => "Something went wrong"];
		}
	}

	public function activeWorkshop()
	{
		return $this->hasMany("App\Models\Workshop", "event_id", "id")->where("start", ">", date("Y-m-d H:i:s"));
	}

	public function workshops()
	{
		return $this->hasMany("App\Models\Workshop", "event_id", "id");
	}
}
