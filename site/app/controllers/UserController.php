<?php

class UserController extends BaseController {
    
    public function login(){
        return View::make('login');
    }

    public function postLogin()
    {
        $cre=["username"=>Input::get('username'),"password"=>Input::get('password')];
        $rules=['username'=>'required','password'=>'required'];
        $validator=Validator::make($cre,$rules);
        if($validator->passes()){
            if(Auth::attempt($cre)){
                return Redirect::to('/admin');
                   
            } else {
                return  Redirect::Back()->withErrors($validator)->withInput()->with('fail','Username and password does not match');
            }
            
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
    }

    
}