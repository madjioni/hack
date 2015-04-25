<?php

class CreatingJobController extends Controller {

    public function run()
    {

        //preko POST
        $title=Request::POST('title');
        $description=Request::POST('description');
        $location=Request::POST('location');
        $date_start=Request::POST('date_start');
        $date_end=Request::POST('date_end');
        $num=Request::POST('num');
        $price=Request::POST('price');
        $price_type=Request::POST('price_type');
        $time=Request::POST('time');
        $transport=Request::POST('transport');
        $active_end = Request::POST('active_end');
        $category=Request::POST('category');


//dragan.okan@gmail.com
/*
".Session::
            GetData()['email']."
*/
        $empl_res = DB::Query(" SELECT id from employer where mail='".Session::
            GetData()['email']."'");


        if($empl_res){

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
                        var_dump($transport);


            $res = DB::Query("INSERT INTO job(id, title, description, location, datestart, dateend, num, price, pricetype, time, transportation, activeend, idemployer, idcat) VALUES (0, '$title', '$description', '$location', '$date_start', '$date_end', '$num', $price , $price_type, $time,'$transport',$active_end,".$empl_res[0][0].",$category)");

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