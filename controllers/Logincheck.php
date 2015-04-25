<?php

class LogincheckController extends Controller {

    public function run()
    {
        $email = Request::POST('email');
        $pass = Request::POST('pass');
        $res = 'bad';

        if(Session::Login($email, $pass))
        {
            $res = 'good';
            //Request::GotoAddress('/');
        }

        echo $res;

    }
}