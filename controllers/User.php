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
        $poslovi = array();
        $sadrzaj = '';


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
        if(!isset($_GET['id']) || !isset($_GET['t']))
        {
            $tbnamev = $tbname;
            $idview = $user->id;
        }
        else
        {
            $idview = Request::GET('id');
            $tbnamev = Request::GET('t')=='w'?'worker':'employer';
        }

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

        if($logged)
            $editable = ($user->id==$view->id && $tbname==$tbnamev);

        if($editable)
        {
            // svi poslovi
            if($tbname=='worker')
            {
                $poslovi = Japp::Query("SELECT * FROM apps WHERE idworker=$idview");
                //var_dump($poslovi);
                foreach ($poslovi as $posao) {
                    $posao->idjob = Job::Query("SELECT * FROM job WHERE id=". $posao->idjob)[0];
                }
            }
            else
            {
                $poslovi = array();
                $aa = Job::Query("SELECT * FROM job WHERE idemployer=".$user->id);
                foreach ($aa as $posao) {
                    $ps = Japp::Query('SELECT * FROM apps WHERE idjob='.$posao->id);
                    foreach ($ps as $pp) {
                        $pp->idjob = $posao;
                        $poslovi[] = $pp;
                    }
                }
                //var_dump($poslovi);
            }

            foreach ($poslovi as $posao)
            {

                if($posao->ewdone && $posao->wedone)
                {
                    $sadrzaj .= '<div class="ratee">';
                    $sadrzaj .= '<p class="job-title">Naziv: <a href="/job/id/'.$posao->idjob->id.'">'.$posao->idjob->title . '</a></p>';
                    $sadrzaj .= '<div class="job-rate">'.($tbnamev=='worker'?$posao->ewrate:$posao->werate) . '<span>☆</span></div>';
                    $sadrzaj .= '<p class="job-comm">'.($tbnamev=='worker'?$posao->ewcomm:$posao->wecomm) . '</p>';
                    $sadrzaj .= '</div>';
                }
                if(!$posao->wedone && $tbname=='worker')
                {
                    // TODO
                    $sadrzaj .=
                    '
                    <div class="container">
                        <div class="section-header rate animated hiding" data-animation="fadeInDown">
                           <h2>OCENI - <span class="highlight">'.$posao->idjob->title .'</span></h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                                <form class="form form-register dark" action="/potvrda/tip/we/id/'.$posao->idworker.'/poso/'.$posao->idjob->id.'" method="post">
                                    <div class="form-group">
                                        <label for="rate" class="col-sm-3 col-xs-12 control-label">Ocena</label>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="number" min="1" max="5" name="rate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comm" class="col-sm-3 col-xs-12 control-label">Komentar</label>
                                        <div class="col-sm-9 col-xs-12">
                                            <textarea type="text" name="comm" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" >Oceni</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    ';
                }
                if(!$posao->ewdone && $tbname=='employer')
                {
                    // TODO
                    $sadrzaj .=
                    '
                    <div class="container">
                        <div class="section-header rate animated hiding" data-animation="fadeInDown">
                           <h2>OCENI - <span class="highlight">'.$posao->idjob->title .'</span></h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                                <form class="form form-register dark" action="/potvrda/tip/ew/id/'.$posao->idworker.'/poso/'.$posao->idjob->id.'" method="post">
                                    <div class="form-group">
                                        <label for="rate" class="col-sm-3 col-xs-12 control-label">Ocena</label>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="number" min="1" max="5" name="rate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comm" class="col-sm-3 col-xs-12 control-label">Komentar</label>
                                        <div class="col-sm-9 col-xs-12">
                                            <textarea type="text" name="comm" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" >Oceni</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }

        }
        // else
        // {
        //     // uradjeni poslovi
        //     $poslovi = Japp::Query("SELECT * FROM apps WHERE idworker=$idview AND ewdone=1 AND wedone=1");
        //     foreach ($poslovi as $posao) {
        //         $posao->idjob = Job::Query("SELECT * FROM job WHERE id=". $posao->idjob)[0];
        //     }
        //     $sadrzaj = $poslovi;

        // }



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
