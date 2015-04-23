<?php

class IndexController extends Controller {

    public function run()
    {
        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';

        Template::load('base')
            ->title('Home')
            ->content
            (
                '<p>Ovo je <a href="/">glavna</a> strana.</p>'
                . Template::load('register_form')
                    ->get()
                . Template::load('login_form')
                    ->korisnik($korisnik)
                    ->logged($logged)
                    ->get()
                . Template::load('upload_form')
                    ->get()
            )
            ->render();
    }
}