<?php

class IndexController extends Controller {

    public function run()
    {
        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';

        Template::load('base')
            ->title('Home')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                '<p>Ovo je <a href="/">glavna</a> strana.</p>'
            )
            ->render();
    }
}