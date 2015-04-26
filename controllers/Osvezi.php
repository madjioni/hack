<?php

class OsveziController extends Controller {

    public function run()
    {
        $id = Request::GET("id");
        $s = Request::GET('s');
        $jid = Request::GET('j');
        if($s=='1')
        {
            DB::Query("UPDATE apps SET ewdone=0, wedone=0 WHERE idworker=$id AND idjob=$jid");
        }
        else
        {
            DB::Query("DELETE FROM apps WHERE idjob=$jid AND idworker=$id");
        }
    }
}