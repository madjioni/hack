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