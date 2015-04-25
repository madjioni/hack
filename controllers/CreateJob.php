<?php

class CreateJobController extends Controller {

    public function run()
    {


        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';
        // var_dump($logged);
        // var_dump($korisnik);

        Template::load('base')
            ->title('Oglasi posao')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                Template::load('create_job_form')
                    ->get()
            )
        ->render();

    }
}