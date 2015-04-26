<?php

require 'models/job.php';
require 'models/employer.php';

class IndexController extends Controller {

    public function run()
    {
        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';

        $poslovi = Job::Query("SELECT * FROM job ORDER BY activeend ASC");
        $sadrzaj = '';
        $n = count($poslovi);
        foreach($poslovi as $posao)
        {
            $q = "SELECT * FROM employer WHERE id=" . $posao->idemployer;
            $poslodavac = Employer::Query($q);
            $ime =  $poslodavac[0]->firstname;
            $id = $poslodavac[0]->id;
            $posao->pricetype = $posao->pricetype==1?'RSD/dan':$posao->pricetype==2?'RSD/h':'RSD/kg';
            $now = date('m/d/Y h:i:s a', time());
            $unix_now = strtotime($now);

            $start = date('m/d/Y h:i:s a', strtotime($posao->activestart));
            $unix_start = strtotime($start);

            $diff = $posao->activeend * 24 * 60 * 60;
            if($unix_start+$diff > $unix_now)
                $sadrzaj .= Template::load('posao-short')->ime($ime)->posao($posao)->poslid($id)->get();

        }

        Template::load('base')
            ->title('Paprika - Oglasnik poljoprivrednih poslova')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                Template::load('home')
                ->sadrzaj($sadrzaj)
                -> get()
            )
            ->render();
    }
}