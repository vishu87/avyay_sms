<?php


class City extends Eloquent  {

	protected $table = 'city';

	public static function get_city_array(){
		return City::lists('city_name','id');
	}
}
