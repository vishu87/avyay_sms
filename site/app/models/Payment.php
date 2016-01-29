<?php


class Payment extends Eloquent  {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'payment_table';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
