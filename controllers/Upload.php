<?php

class UploadController extends Controller {

    public function run()
    {
        $name = Request::POST('filename');
        $file = Request::FILES('inp_file');
        $tmp_name = $file["tmp_name"];
        move_uploaded_file($tmp_name, Core::$config['MEDIA_DIR'].'/upload/'.$name);

        echo 'good';
        //Request::GotoAddress('/index');
    }
}