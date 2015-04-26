<?php

class PotvrdaController extends Controller {

    public function run()
    {
        $tip = Request::GET('tip');
        $id = Request::GET('id');
        $posaoid = Request::GET('poso');
        $rate = Request::POST('rate');
        $comm = Request::POST('comm');

        $q = 
        "UPDATE apps 
        SET ".
        $tip . 'done=1, '.$tip.'comm=\''.$comm.'\', '.$tip.'rate='.$rate.
        " WHERE idjob=$posaoid AND idworker=$id
        ";

        echo $q;

        DB::Query($q);
        //Request::GotoAddress('/');
    }
}