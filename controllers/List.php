<?php

require 'models/job.php';
require 'models/employer.php';

class ListController extends Controller {

    public function run()
    {
        $format = 'Y-m-d H:i:s';
        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';
            //strtotime('+1 day', $timestamp) dodaje dan na timestmp
        $cur_date = DateTime::createFromFormat($format,date('Y-m-d H:i:s'));

        $poslovi = Job::Query("SELECT * FROM job ORDER BY activeend ASC");
        $sadrzaj = '';
        $n = count($poslovi);
        $i = 0;
        foreach($poslovi as $posao)
        {


            $q = "SELECT * FROM employer WHERE id=" . $posao->idemployer;
            $poslodavac = Employer::Query($q);
            $ime =  $poslodavac[0]->firstname;
            $id = $poslodavac[0]->id;

           //  //var_dump($poslovi[$i++]->title);
           //  $start = ($poslovi[$i]->activestart);
           //  //var_dump($start);
           //  //$start_plus_end = date_add($start, date_interval_create_from_date_string(($poslovi[$i]->activeend).'days'));;

           //  $start_plus_end = DateTime::createFromFormat($format, $start);

           // //var_dump($start_plus_end);
           // // var_dump($poslovi[$i]->activeend);
           //  $start_plus_end->modify('+'.$poslovi[$i]->activeend.' days');
           // // var_dump($start_plus_end);
           //  $i++;


             
           // // var_dump($start_plus_end);
           // /* echo("\n\n");
           //  */
           // // var_dump($cur_date);


           //  //POREDJENJE LOSE!
           //  if($start_plus_end>$cur_date){
                $sadrzaj .= Template::load('posao')->ime($ime)->posao($posao)->poslid($id)->get();
                $posao->pricetype = $posao->pricetype==1?'RSD/dan':$posao->pricetype==2?'RSD/h':'RSD/kg';
            // }

        }

        Template::load('base')
            ->title('Home')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                Template::load('list')
                    ->sadrzaj($sadrzaj)
                    ->get()
            )
            ->render();
    }
}