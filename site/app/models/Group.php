<?php

class Group extends Eloquent  {

	protected $table = 'groups';

	public static function group_center_city(){
		$city = Group::select('city.city_name','city.id as cityId','groups.group_name','center.id as cid','center.center_name','groups.id')
			->join('center','groups.center_id','=','center.id')
			->join('city','center.city_id','=','city.id')
			->orderBy('cityId','asc')
			->get();
		return $city;	
	}
}
