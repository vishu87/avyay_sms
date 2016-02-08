<?php

class Group extends Eloquent  {

	protected $table = 'groups';

	public static function group_center_city(){
		$city = Group::select('city.city_name','city.id as city_id','groups.group_name','center.id as center_id','center.center_name','groups.id as group_id')
			->join('center','groups.center_id','=','center.id')
			->join('city','center.city_id','=','city.id')
			->orderBy('center_id','asc')
			->orderBy('city_id','asc')
			->get();	
		return $city;	
	}
}
