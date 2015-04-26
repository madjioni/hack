<?php

class AccupController extends Controller {

    public function run()
    {
        $tb = Request::GET('t')=='w'?'worker':'employer';
        $id = Request::POST('id');
        $fn = Request::POST('fn');
        $ln = Request::POST('ln');
        $loc = Request::POST('loc');
        $ph = Request::POST('ph');
        $mail = Request::POST('mail');

        $q = "UPDATE $tb SET 
        firstname='$fn',
        lastname='$ln',
        location='$loc',
        phone='$ph',
        mail='$mail' 
        WHERE id=$id
        ";
        DB::Query($q);

        Request::GotoAddress("/user/id/$id/t/".Request::GET('t'));
    }
}