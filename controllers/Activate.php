<?php

require 'models/job.php';
require 'models/employer.php';

class ActivateController extends Controller {

    public function run()
    {
        $t = Request::GET('t');
        $pass = Request::GET('user');
        $q = "UPDATE " .($t=='w'?'worker':'employer') . " SET active=1 WHERE pass=".$pass;
        DB::Query($q);
        Request::GotoAddress('/confirm/t/4');
    }
}