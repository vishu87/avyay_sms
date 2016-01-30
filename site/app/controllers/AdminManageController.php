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
	/********* functions For Centers  starts*********/
	
	public function indexCenter(){
		$centers = Center::get();
		$this->layout->tab_id = 3;
		$this->layout->sidebar = View::make('admin.manage.sidebar',["page_id"=>2]);
 		$this->layout->main = View::make('admin.manage.centers.list',["centers"=>$centers]);

	}
	public function addCenter(){
		$cities =[""=>"select"] + City::lists("city_name","id");
		return View::make('admin.manage.centers.add',["city"=>$cities]);
	}
	public function insertCenter(){
		$cre = ["center"=>Input::get('center')];
		$rules = ["center"=>'required'];

		$validator = Validator::make($cre,$rules);
		if($validator->passes()){
			$center = new Center;
			$center->center_name = Input::get('center');
			$center->save();
			$center_data = Center::where('id','=',$center->id)->first();
			$count = Center::count();
			$data['success'] = 'true';
			$data['message'] = html_entity_decode(View::make('admin.manage.centers.view',["data"=>$center_data,"count"=>$count]));
		}
		else{
			$data["success"] = false;
			$data["message"] = "All fields are not filled";
		}
		return json_encode($data);
	}
	public function deleteCenter($id){
		$delete = Center::find($id)->delete();
		$data["success"] = true;
		$data["message"] = "";
		return json_encode($data);
	}
	public function editCenter($id){
		$city = Center::find($id);
		$count = Input::get('count');
		return (View::make('admin.manage.centers.add',["center"=>$city,"count"=>$count]));
		
	}
	public function updateCenter($id){
		$cre = ["center"=>Input::get('center')];
		$rules = ["center"=>'required'];

		$validator = Validator::make($cre,$rules);
		if($validator->passes()){
			$center = Center::find($id);
			$center->center_name = Input::get('center');
			$center->save();
			$count = Input::get('count');
			$data["success"] = true;
			$data["message"] = html_entity_decode(View::make('admin.manage.centers.view',["data"=>$center,"count"=>$count]));
			
		}
		else{
			$data["success"] = false;
			$data["message"] = "All fields are not filled";
		}
		return json_encode($data);
	}

}
