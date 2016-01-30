<?php

class AdminManageController extends BaseController {

	protected $layout = 'layout';
	public function index(){
		$this->layout->tab_id = 3;
		$this->layout->sidebar = View::make('admin.manage.sidebar',["page_id"=>0]);
 		$this->layout->main = View::make('admin.manage.index');
	}

	/********* functions For City  starts*********/

	public function indexCity(){
		$cities = City::get();
		$this->layout->tab_id = 3;
		$this->layout->sidebar = View::make('admin.manage.sidebar',["page_id"=>1]);
 		$this->layout->main = View::make('admin.manage.cities.list',["cities"=>$cities]);

	}
	public function addCity(){
		return View::make('admin.manage.cities.add');
	}
	public function insertCity(){
		$cre = ["city"=>Input::get('city')];
		$rules = ["city"=>'required'];

		$validator = Validator::make($cre,$rules);
		if($validator->passes()){
			$city = new City;
			$city->city_name = Input::get('city');
			$city->save();
			$city_data = City::where('id','=',$city->id)->first();
			$count = City::count();
			$data['success'] = 'true';
			$data['message'] = html_entity_decode(View::make('admin.manage.cities.view',["data"=>$city_data,"count"=>$count]));
		}
		else{
			$data["success"] = false;
			$data["message"] = "All fields are not filled";
		}
		return json_encode($data);
	}
	public function deleteCity($id){
		$delete = City::find($id)->delete();
		$data["success"] = true;
		$data["message"] = "";
		return json_encode($data);
	}
	public function editCity($id){
		$city = City::find($id);
		$count = Input::get('count');
		return (View::make('admin.manage.cities.add',["city"=>$city,"count"=>$count]));
		
	}
	public function updateCity($id){
		$cre = ["city"=>Input::get('city')];
		$rules = ["city"=>'required'];

		$validator = Validator::make($cre,$rules);
		if($validator->passes()){
			$city = City::find($id);
			$city->city_name = Input::get('city');
			$city->save();
			$count = Input::get('count');
			$data["success"] = true;
			$data["message"] = html_entity_decode(View::make('admin.manage.cities.view',["data"=>$city,"count"=>$count]));
			
		}
		else{
			$data["success"] = false;
			$data["message"] = "All fields are not filled";
		}
		return json_encode($data);
	}
	/********* functions For City  starts*********/
	public function myfnc(){
		return "dfajsdklafjdsljaljds";
	}
}
