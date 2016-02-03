<?php


class Center extends Eloquent  {

	protected $table = 'center';

	public static function get_center_array(){
		return Center::lists('center_name','id');
	}
}
