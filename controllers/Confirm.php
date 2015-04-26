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
            $msg = '';
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
                '<div id="home" class="static-header small-header light">
                    <div class="text-heading"></div>
                </div>
                <section class="confirm-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="response">'.$msg.'</p>
                            </div>
                        </div>
                    </div>
                </section>
                <a id="showHere"></a>'
            )
        ->render();
    }
}