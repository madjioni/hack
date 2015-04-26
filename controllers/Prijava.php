<?php

class PrijavaController extends Controller {

    public function run()
    {
        $iduser = Request::POST('iduser');
        $idposao = Request::POST('idposao');
        $tip = Request::POST('tip');

        if($tip=='prijava')
        {
            if(DB::Query("INSERT INTO apps(idjob, idworker) VALUES ($idposao, $iduser)"))
            {
                echo 'prijavljen';
            }
        }
        else if($tip=='odjava')
        {
            if(DB::Query("DELETE FROM apps WHERE idjob=$idposao AND idworker=$iduser"))
            {
                echo 'odjavljen';
            }
        }
    }
}