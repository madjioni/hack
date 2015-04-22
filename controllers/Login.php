<?php

class LoginController extends Controller {

    public function run()
    {
        Template::load('base')
            ->title("Login")
            
            ->content
            (
                Template::load('login_form') -> get()
            )

            ->render();
    }
}