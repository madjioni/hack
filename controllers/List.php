<?php

require 'models/job.php';
require 'models/employer.php';

class ListController extends Controller {

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
            $sadrzaj .= Template::load('posao')->ime($ime)->posao($posao)->poslid($id)->get();
        }

        Template::load('base')
            ->title('Home')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                '<p>Ovo je stranica sa listom poslova.</p>'
                . $sadrzaj
            )
            ->render();
    }
}