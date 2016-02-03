<?php


class States extends Eloquent  {

	protected $table = 'states';
	public static function state_list(){
		return States::lists('name','id');
	}
}
