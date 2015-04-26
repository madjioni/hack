<?php

class UpdatejobController extends Controller {

    public function run()
    {

        //preko POST
        $id = Request::POST('id');
        $title=Request::POST('title');
        $description=Request::POST('description');
        $location=Request::POST('location');
        $datestart=Request::POST('datestart');
        $dateend=Request::POST('dateend');
        $num=Request::POST('num');
        $price=Request::POST('price');
        $pricetype=Request::POST('pricetype');
        $time=Request::POST('time');
        $transportation=Request::POST('transportation');
        $activeend = Request::POST('activeend');
        $category=Request::POST('category');

        //$emplres = DB::Query(" SELECT id from employer where mail='".Session::GetData()['email']."'");

            $q = "UPDATE job SET 
            title='$title',
            description='$description',
            location='$location',
            datestart='$datestart',
            dateend='$dateend',
            num=$num,
            price=$price,
            pricetype=$pricetype,
            time='$time',
            transportation='$transportation',
            activeend=$activeend,
            idcat=$category 
            WHERE id=$id
            ";

            $res = DB::Query($q);

            echo $res?'ok':'err';
    }
}