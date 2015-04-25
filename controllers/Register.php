 <?php

 class RegisterController extends Controller {

     public function run()
     {
         Template::load('base')
            ->title('Registracija')
            ->content
            (
                Template::load('register_form')
                    ->get()
            )
            ->render();
     }
 }