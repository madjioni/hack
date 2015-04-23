<?php

class LoginController extends Controller {

    public function run()
    {
        $email = Request::GET('email');
        $pass = Request::GET('pass');
        $res = 'not good';

        if(Session::Login($email, $pass))
        {
            $res = 'all good';
        }

        echo $res;
    }
}