 <?php
require 'models/worker.php';
require 'models/employer.php';

 class UserController extends Controller {

     public function run()
     {
        $tip_korisnika;
        $pol = 0;
//

        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';


        $user = null;
        $view = null;
        $worker = false;
        $employer = false;
        $editable = false;

        if($logged)
        {
            // onaj ko pregleda stranicu
            $tbname = Session::GetData()['type'];
            if($tbname=='worker')
            {
                $user = Worker::Query("SELECT * FROM worker WHERE mail='$korisnik'");
                $user = $user[0];
            }
            else if($tbname=='employer')
            {
                $user = Employer::Query("SELECT * FROM employer WHERE mail='$korisnik'");
                $user = $user[0];
            }
        }

        // cija stranica se pregleda
        $idview = Request::GET('id');
        $tbnamev = Request::GET('t')=='w'?'worker':'employer';
        if($tbnamev=='worker')
        {
            $view = Worker::Query("SELECT * FROM worker WHERE id=$idview");
            $view = $view[0];
            $view->gender = $view->gender==1?'muski':'zenski';
            $worker = true;
        }
        else if($tbnamev=='employer')
        {
            $view = Employer::Query("SELECT * FROM employer WHERE id=$idview");
            $view = $view[0];
            $employer = true;
        }

        $editable = ($user->id==$view->id && $tbname==$tbnamev);

        
         
        Template::load('base')
            ->title('Korisnik')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                Template::load('user')
                    ->worker($worker)
                    ->employer($employer)
                    ->editable($editable)
                    ->user($view)
                    ->get() 
            )
            ->render();
        
    }
 }
      