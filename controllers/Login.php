<?php

class LoginController extends Controller {

    public function run()
    {
        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';
        // var_dump($logged);
        // var_dump($korisnik);

        Template::load('base')
            ->title('Ulaz')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                Template::load('login_form')
                    ->get()
            )
        ->render();

    }
}