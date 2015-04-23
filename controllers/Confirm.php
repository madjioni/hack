<?php

class ConfirmController extends Controller {

    public function run()
    {
        $email = Request::GET('user');
        $result = "not confirmed";

        if( DB::Query("UPDATE users SET active=1 WHERE email='$email'") )
        {
            $result = "confirmed";
        }

        Template::load('base')
            ->title('Confirmation')
            ->content('Registration: '.$result.' ('.$email.').')
        ->render();
    }
}