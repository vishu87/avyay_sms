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
			$count = City::count();
			$data['success'] = 'true';
			$data['message'] = html_entity_decode(View::make('admin.manage.cities.view',["data"=>$city,"count"=>$count]));
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
		$centers = DB::table('center')->join('city','center.city_id','=','city.id')->select('center.center_name','city.city_name','center.id')->get();
		$this->layout->tab_id = 3;
		$this->layout->sidebar = View::make('admin.manage.sidebar',["page_id"=>2]);
 		$this->layout->main = View::make('admin.manage.centers.list',["centers"=>$centers]);
	}
	public function addCenter(){
		$cities = [""=>"select"] + City::get_city_array();
		return View::make('admin.manage.centers.add',["cities"=>$cities]);
	}
	public function insertCenter(){
		$cre = ["center"=>Input::get('center')];
		$rules = ["center"=>'required'];

		$validator = Validator::make($cre,$rules);
		if($validator->passes()){
			$center = new Center;
			$center->center_name = Input::get('center');
			$center->city_id = Input::get('city_id');
			$center->paid_to = Input::get('cheque');
			$center->save();
			$center_info=Center::select('center.center_name','city.city_name','center.id')
								->join('city','center.city_id','=','city.id')
								->where('center.id','=',$center->id)
								->first();
			
			$count = Center::count();
			$data['success'] = 'true';
			$data['message'] = html_entity_decode(View::make('admin.manage.centers.view',["data"=>$center_info,"count"=>$count]));
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
	public function editCenter($center_id){
		$center = Center::find($center_id);
		$cities = [""=>"select"] + City::get_city_array();
		return html_entity_decode(View::make('admin.manage.centers.add',["center"=>$center, "cities" =>$cities]));	
	}
	public function updateCenter($center_id){
		$cre = ["center"=>Input::get('center')];
		$rules = ["center"=>'required'];

		$validator = Validator::make($cre,$rules);
		if($validator->passes()){
			$center = Center::find($center_id);
			$center->center_name = Input::get('center');
			$center->city_id = Input::get('city_id');
			$center->paid_to = Input::get('cheque');
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

	/*------function for groups starts--------*/

	public function indexGroup(){
		$groups = Group::select('center.center_name','groups.group_name','city.city_name','groups.id')
						->join('center','groups.center_id','=','center.id')
						->join('city','center.city_id','=','city.id')
						->get();
		$this->layout->tab_id = 3;
		$this->layout->sidebar = View::make('admin.manage.sidebar',["page_id"=>3]);
 		$this->layout->main = View::make('admin.manage.groups.list',["groups"=>$groups]);
	}
	public function addGroup(){
		$centers = [""=>"select"] + Center::get_center_array();
		return View::make('admin.manage.groups.add',["centers"=>$centers]);	
	}
	public function insertGroup(){
		$cre = ["group"=>Input::get('group')];
		$rules = ["group"=>'required'];

		$validator = Validator::make($cre,$rules);
		if($validator->passes()){
			$group = new Group;
			$group->group_name = Input::get('group');
			$group->center_id = Input::get('center_id');
			$group->save();
			$group_info=Group::select('center.center_name','groups.group_name','city.city_name','groups.id')
								->join('center','groups.center_id','=','center.id')
								->join('city','center.city_id','=','city.id')
								->where('groups.id','=',$group->id)
								->first();
			
			$count = Group::count();
			$data['success'] = 'true';
			$data['message'] = html_entity_decode(View::make('admin.manage.groups.view',["data"=>$group_info,"count"=>$count]));
		}
		else{
			$data["success"] = false;
			$data["message"] = "All fields are not filled";
		}
		return json_encode($data);
	}
	public function deleteGroup($id){
		$delete = Group::find($id)->delete();
		$data["success"] = true;
		$data["message"] = "Suffefasdafsdga";
		return json_encode($data);
	}
}
