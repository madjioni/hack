<?php

class LogoutController extends Controller {

    public function run()
    {
        Session::Logout();
        Request::GotoAddress('/index');
    }
}