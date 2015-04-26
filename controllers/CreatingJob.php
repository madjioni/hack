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

/*
".$empl_res[0] ."
*/

/*
            echo $empl_res[0][0];
            echo "---";
            var_dump($title);
            var_dump($description);
            var_dump($location);
            var_dump($date_start);
            var_dump($date_end);
            var_dump($num);
            var_dump($price);
            var_dump($price_type);
            var_dump($time);

            var_dump($category);
*/


            $res = DB::Query("INSERT INTO job(id, title, description, location, datestart, dateend, num, price, pricetype, time, transportation, activeend, idemployer, idcat) VALUES (0, '$title', '$description', '$location', '$datestart', '$dateend', '$num', $price , $pricetype, $time,'$transport',$activeend,".$emplres[0][0].",$category)");

/*

            $res = DB::Query("INSERT INTO job VALUES (0, 'wqdq', 'des', 'BG', '2015-03-31', '2016-03-31', 4, 100 , 2,8,'trans',0,7, 1, 1)
");
 */

            if($res){
                $result="Uspesno oglasen posao!";
            }

            else{

                $result="Nespesno oglasen posao!";

            }

            echo $result;
        }
        else{

            echo "Greska u upitu o id-u poslodavca";

        }
    }
}