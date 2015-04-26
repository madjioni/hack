<?php

class CreatingJobController extends Controller {

    public function run()
    {

        //preko POST
        $title=Request::POST('title');
        $description=Request::POST('description');
        $location=Request::POST('location');
        $datestart=Request::POST('datestart');
        $dateend=Request::POST('dateend');
        $num=Request::POST('num');
        $price=Request::POST('price');
        $pricetype=Request::POST('pricetype');
        $time=Request::POST('time');
        $transport=Request::POST('transport');
        $activeend = Request::POST('activeend');
        $category=Request::POST('category');

        $emplres = DB::Query(" SELECT id from employer where mail='".Session::GetData()['email']."'");


        if($emplres){

            $res = DB::Query("INSERT INTO job(id, title, description, location, datestart, dateend, num, price, pricetype, time, transportation, activeend, idemployer, idcat)
                                    VALUES (0, '$title', '$description', '$location', '$datestart', '$dateend', $num, $price , $pricetype, '$time','$transport',$activeend,".$emplres[0][0].",$category)");

            if($res){
                Request::GotoAddress('/confirm/t/2');
            }

            else{

                Request::GotoAddress('/confirm/t/1');

            }

            echo $result;
        }
        else{

            Request::GotoAddress('/confirm/t/1');

        }
    }
}