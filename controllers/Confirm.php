<?php

class ConfirmController extends Controller {

    public function run()
    {
        $t = intval(Request::GET('t'));
        $msg = '';
        if($t==1)
        {
            $msg = 'Greska tokom kreiranja oglasa.';
        }
        if($t==2)
        {
            $msg = 'Oglas uspesno kreiran.';
        }
        if($t==3)
        {
            $msg = 'Komentar uspesno ostavljen.';
        }
        if($t==4)
        {
            $msg = 'Registracija uspesna.';
        }
        if($t==5)
        {
            $msg = '';
        }
        if($t==6)
        {
            $msg = '';
        }

        Template::load('base')
            ->title('Confirmation')
            ->content
            (
                '<div id="home" class="static-confirm static-header light">
                    <div class="text-heading">
                    <p class="confirm-response">'.$msg.'</p></div>
                    <a id="showHere"></a>
                </div>'

            )
        ->render();
    }
}