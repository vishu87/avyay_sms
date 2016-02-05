<?php

class StudentController extends BaseController {
    
   protected $layout = 'layout';

    public function addStudent(){
        $city = [""=>"select"]+City::get_city_array();
        $states = [""=>"select"]+States::state_list();
        $this->layout->tab_id = 1;
        $this->layout->sidebar = View::make('admin.sidebar',["page_id"=>1,"sub_id"=>0]);
        $this->layout->main = View::make('admin.students.addStudent',["city"=>$city,"states"=>$states]);
   }

    public function storeStudent(){
      $cre =[
            "first_group"=>Input::get('first_group'),
            'name'=>Input::get('name'),
            'dob'=>Input::get('dob'),
            'gender'=>Input::get('gender'),
            'father_name'=>Input::get('father_name'),
            'month_plan'=>Input::get('month_plan'),
            'dor'=>Input::get('dor'),
            'doe'=>Input::get('doe'),
            'dos'=>Input::get('dos')
            
            ];
      $rules =[
            "first_group"=>'required',
            'name'=>'required',
            'dob'=>'required',
            'gender'=>'required',
            'father_name'=>'required',
            'month_plan'=>'required',
            'dor'=>'required',
            'doe'=>'required',
            'dos'=>'required'
            
            ]; 
      $validator = Validator::make($cre,$rules);
      if($validator->passes()){
         $student = new Student;
         $student->name = Input::get('name');
         $student->dob = Input::get('dob');
         $student->gender = Input::get('gender');
         $student->first_group = Input::get('first_group');
         
         $student->dos = Input::get('dos');
         $student->doe = Input::get('doe');
         
         $student->added_by = Auth::User()->id;
         $student->add_date = strtotime("now");
         
         $student->save();
         $student_details = new StudentDetails;
         $student_details->student_id =$student->id;
         $student_details->school = Input::get('school_name');
         $student_details->status_email = Input::get('status_email');
         $student_details->status_mob = Input::get('status_mob');
         
         $student_details->father = Input::get('father_name');
         $student_details->mother = Input::get('mother');
         $student_details->father_mob = Input::get('father_mob');
         $student_details->father_email = Input::get('father_email');
         $student_details->mother_mob = Input::get('mother_mob');
         $student_details->mother_email = Input::get('mother_email');
         $student_details->address = Input::get('address');
         $student_details->city = Input::get('city');
         $student_details->state = Input::get('state');
         
         if(Input::hasFile('picture')){
            $picture=Input::file('picture');
            $filename=Input::file('picture')->getClientOriginalName();
            Input::file('picture')->move('uploads/','st_'.$filename);
            $student_details->pic = 'st_'.$filename;
         }
         $student_details->father_status_email = Input::get('father_status_email');
         $student_details->father_status_mob = Input::get('father_status_mob');
         $student_details->mother_status_mob = Input::get('mother_status_mob');
         $student_details->mother_status_email = Input::get('mother_status_email');
         $student_details->save();

         $payment = new PaymentHistory;
         $payment->student_id = $student->id;
         $payment->dos = Input::get('dos');
         $payment->dor = Input::get('dor');
         $payment->doe = Input::get('doe');
         $payment->reg_fee = Input::get('reg_fee');
         $payment->sub_fee = Input::get('sub_fee');
         $payment->kit_fee = Input::get('kit_fee');
         $payment->amount = Input::get('amount');
         $payment->months = Input::get('month_plan');
         $payment->adjustment = Input::get('adjustment');
         $payment->p_remark = Input::get('p_remark');
         $payment->a_remark = Input::get('a_remark');
         $payment->date = strtotime("now");
         
         $payment->payment_mode = Input::get('payment_mode');
         $payment->save();
         return Redirect::Back()->with('success','New Student Added Successfully');
         
      }  
             
      return "error";
   }

    public function viewAllStudent(){
        $students = Student::select('center.center_name','students.id','students.name','students_details.city as city_name','groups.group_name','students_details.school','students.doe','students_details.father','students.dob')
            ->join('students_details','students.id','=','students_details.student_id')
            ->join('groups','students.first_group','=','groups.id')
            ->join('center','groups.center_id','=','center.id')
            ->join('city','center.city_id','=','city.id')
            ->get();
        $custom_sidebar = Group::group_center_city();    
        // return $custom_sidebar->city;
        $this->layout->tab_id = 1;
        $this->layout->sidebar = View::make('admin.sidebar',["page_id"=>2,"sub_id"=>1,"customSidebar"=>$custom_sidebar]);   
        $this->layout->main = View::make('admin.browseStudent.view',["students"=>$students]);   

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

        $dos = strtotime(Input::get('dos'));

        if(Input::has('mplan')){
            $dos = strtotime('+'.Input::get('mplan').' month',$dos);
        }
        if(Input::has('adjust')){
            $dos = strtotime('+'.Input::get('adjust').' days',$dos);
        }
        $dos = $dos - 86400;

        $data['success'] = true;
        $data['message'] = date("d-m-Y", $dos); 
        return  json_encode($data);
    }
}