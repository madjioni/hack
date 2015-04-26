 <?php
require 'models/worker.php';
require 'models/employer.php';
require 'models/job.php';
require 'models/japp.php';

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
        $poslovi = null;

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

        if($editable)
        {
            // svi poslovi
            $sadrzaj = '';
            $poslovi = Japp::Query("SELECT * FROM apps WHERE idworker=$idview ORDER BY ewdone, wedone ASC");
            foreach ($poslovi as $posao) {
                $posao->idjob = Job::Query("SELECT * FROM job WHERE id=". $posao->idjob)[0];
            }

            //var_dump($poslovi);
            
            $sadrzaj .= '<p>';
            foreach ($poslovi as $posao)
            {
                $sadrzaj .= 'Naziv: '.$posao->idjob->title . '<br>';
                if($posao->ewdone && $posao->wedone)
                {
                    $sadrzaj .= 'Rate: '.$tbnamev=='worker'?$posao->werate:$posao->ewrate . '<br>';
                    $sadrzaj .= 'Comm: '.$tbnamev=='worker'?$posao->wecomm:$posao->ewcomm . '<br>';
                }
                if($posao->wedone && $tbname=='worker')
                {
                    // TODO
                    $sadrzaj .=
                    '
                    <form action="/potvrda/tip/we/id//poso/" method="get">
                        <input type="text" name="comm">
                        <input type="text" name="comm">
                        <button type="submit" value="Posalji">Posalji</button>
                    </form>
                    ';
                }
                if($posao->ewdone && $tbname=='employer')
                {
                    // TODO
                }
            }
            $sadrzaj .= '</p>';
        }
        else
        {
            // uradjeni poslovi
            $poslovi = Japp::Query("SELECT * FROM apps WHERE idworker=$idview AND ewdone=1 AND wedone=1");
            foreach ($poslovi as $posao) {
                $posao->idjob = Job::Query("SELECT * FROM job WHERE id=". $posao->idjob)[0];
            }
            
        }

        
         
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
                    ->poslovi($sadrzaj)
                    ->get() 
            )
            ->render();
        
    }
 }
      