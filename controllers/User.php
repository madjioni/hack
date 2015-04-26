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
        $mail = $logged ? Session::GetData()['email'] : 'niko';




         if( isset($_GET['id']) ){

            $id=Request::GET('id');
            $user = Employer::Query("SELECT * FROM employer where id=".$id);
            if($user){
                $user = $user[0];
                $tip_korisnika='e';

            }
            else{

            $user = Worker::Query("SELECT * FROM worker where where id=".$id);

                if($user){
                    $user = $user[0];
                    $tip_korisnika='w';
                    $pol=$user->gender;

                }
            }


                //var_dump($user);
                Template::load('base')
                    ->title('Home')
                    ->logged($logged)
                    ->mail($mail)
                    ->content
                    (
                        Template::load('user')
                            ->user($user)
                            ->worker($tip_korisnika=='w'? 1:0)
                            ->employer($tip_korisnika=='e'? 1:0)
                            ->pol($pol?"Musko":"Zensko")
                            ->editable(false)
                            ->get()
                            
                    )
                    ->render();


       }

       else if($logged){

            $user = Employer::Query("SELECT * FROM employer where mail='".$mail."'");
            if($user){
                $user = $user[0];
                $tip_korisnika='e';

            }
            else{

            $user = Worker::Query("SELECT * FROM worker where mail='".$mail."'");

                if($user){
                    $user = $user[0];
                    $tip_korisnika='w';
                    $pol=$user->gender;

                }
            }


                //var_dump($user);
                Template::load('base')
                    ->title('Home')
                    ->logged($logged)
                    ->mail($mail)
                    ->content
                    (
                        Template::load('user')
                            ->user($user)
                            ->worker($tip_korisnika=='w'?1:0)
                            ->employer($tip_korisnika=='e'?1:0)
                            ->editable(true)
                            ->pol($pol?"Musko":"Zensko")
                            ->get()
                            
                    )
                    ->render();
            }
         
       


       
       else Request::GotoAddress('/');
    
        

        
    }
 }
      