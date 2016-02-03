<?php
class AdminController extends BaseController {
	
	protected $layout = 'layout';
	
	public function index(){
		$this->layout->tab_id = 0;
		$this->layout->sidebar = View::make('admin.sidebar',["page_id"=>4,"sub_id"=>0]);
		$this->layout->main = View::make('admin.index');
	}
	
}
?>