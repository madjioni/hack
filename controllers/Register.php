 <?php

 class RegisterController extends Controller {

     public function run()
     {
        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';

         Template::load('base')
            ->title('Registracija')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                Template::load('register_form')
                    ->get()
            )
            ->render();
     }
 }