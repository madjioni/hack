<?php

class LogincheckController extends Controller {

    public function run()
    {
        $email = Request::POST('email');
        $pass = Request::POST('pass');
        $res = 'bad';

        if(Session::Login($email, $pass))
        {
            echo 'good';
            //Request::GotoAddress('/confirm/t/3');
        }

        echo $res;

    }
}