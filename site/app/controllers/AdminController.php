<?php
class AdminController extends BaseController {
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected $layout = 'layout';
	
	public function index(){
		$this->layout->tab_id = 1;
		$this->layout->sidebar = View::make('admin.sidebar',["page_id"=>4,"sub_id"=>0]);
		$this->layout->main = View::make('admin.index');
	}
	public function addStudent(){
		$city = [""=>"select"]+DB::table('city')->lists('city_name','id');
		$this->layout->tab_id = 1;
		$this->layout->sidebar = View::make('admin.sidebar',["page_id"=>1,"sub_id"=>0]);
		$this->layout->main = View::make('admin.addStudent',["city"=>$city]);
	}
	public function getCenter(){
		$id = Input::get('city');
		$centers = Center::where('city_id',$id)->lists('center_name','id');
		$final_list = [];
			foreach ($centers as $key => $value) {
				array_push($final_list, array("id"=>$key, "value"=>$value)); 
			}
		$data['success'] = 'true';
		$data['message'] = $final_list;
		return json_encode($data);
	}
	public function getGroup(){
		$id = Input::get('center');
		$month_plans = Payment::where('center_id',$id)->orderBy('month_plan','desc')->lists('month_plan','id');
		$groups = Group::where('center_id',$id)->lists('group_name','id');
		$final_list = [];
			foreach ($groups as $key => $value) {
				array_push($final_list, array("id"=>$key, "value"=>$value)); 
			}
		$month_list = [];
		foreach ($month_plans as $key => $value) {
			array_push($month_list, array("id"=>$value, "value"=>$value)); 
		}
		$data['success'] = 'true';
		$data['message'] = $final_list;
		$data['plans'] = $month_list;
		return json_encode($data);
	}

	public function getFee(){
		$id = Input::get('month_plan');
		$fees = Payment::where('id',$id)->first();
		$total = $fees->reg_fee + $fees->sub_fee + $fees->kit_fee;
		$data['success'] = 'true';
		$data['message'] = $fees;
		$data['total'] = $total;
		return json_encode($data);
	}
	public function calDate(){
		$dob = (Input::get('dos'));
		return $dob;
		if(Input::has('mplan')){
			$dos = strtotime('+'.Input::get('mplan').' month',$dos);
		}
		if(Input::has('adjust')){
			$dos = strtotime('+'.Input::get('adjust').' days',$dos);
		}
		$dos = $dos - 86400;
		$data['success'] = 'true';
		$data['message'] = date("d-m-Y", $dos);
		return  json_encode($data);
	}
}
?>