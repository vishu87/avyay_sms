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
            "group"=>Input::get('group'),
            "name"=>Input::get('name'),
            "dob"=>Input::get('dob'),
            "gender"=>Input::get('gender'),
            "father_name"=>Input::get('father_name'),
            "month_plan"=>Input::get('month_plan'),
            "date_payment"=>Input::get('date_payment'),
            "sub_end"=>Input::get('sub_end'),
            "subscription_start"=>Input::get('subscription_start'),
            ];
      $rules =[
            "group"=>'required',
            "name"=>'required',
            "dob"=>'required',
            "gender"=>'required',
            "father_name"=>'required',
            "month_plan"=>'required',
            "date_payment"=>'required',
            "sub_end"=>'required',
            "subscription_start"=>'required'
            ]; 
      $validator = Validator::make($cre,$rules);
      if($validator->passes()){
         $student = new Student;
         $student->name = Input::get('name');
         $student->dob = Input::get('dob');
         $student->gender = Input::get('gender');
         $student->email = Input::get('email');
         $student->school = Input::get('school');
         $student->mobile = Input::get('mobile');
         $student->save();
         $student_details = new Student_Details;
         $student_details->student_id =$studnet->id;
         $student_details->school = Input::get('school_name');
         $student_details->status_email = Input::get('status_email');
         $student_details->status_mob = Input::get('status_mob');
         $student_details->first_group = Input::get('first_group');
         $student_details->father = Input::get('father');
         $student_details->mother = Input::get('mother');
         $student_details->father_mob = Input::get('father_mob');
         $student_details->father_email = Input::get('father_email');
         $student_details->mother_mob = Input::get('mother_mob');
         $student_details->mother_email = Input::get('mother_email');
         $student_details->address = Input::get('address');
         $student_details->city = Input::get('city');
         $student_details->state = Input::get('state');
         $student_details->dos = Input::get('dos');
         $student_details->doe = Input::get('doe');
         if(Input::hasFile('picture')){
            $picture=Input::file('picture');
            $filename=Input::file('picture')->getClientOriginalName();
            Input::file('picture')->move('uploads/','st_'.$filename);
            $student_details->pic = 'st_'.$filename;
         }
         $student_details->add_date = strtotime("now");
         $student_details->added_by = Auth::User()->id;
         $student_details->father_status_email = Input::get('father_status_email');
         $student_details->father_status_mob = Input::get('father_status_mob');
         $student_details->mother_status_mob = Input::get('mother_status_mob');
         $student_details->mother_status_email = Input::get('mother_status_email');
         $student_details->save();

         $payment = new Payment_History;
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
         $payment->added_by = Auth::User()->id;
         $payment->payment_mode = Input::get('payment_mode');
         $payment->save();

         
      }  
      else{
         $data['success'] = 'true';
         $data['message'] ="All Marked Fields Are Mandatory..";
      }       
      return json_encode($data);
   }

    public function viewAllStudent(){
        $students = Student::select('students.*','students_details')
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