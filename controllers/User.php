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
                // $sadrzaj .= 'Naziv: '.$posao->idjob->title . '<br>';
                if($posao->ewdone && $posao->wedone)
                {
                    $sadrzaj .= 'Rate: '.$tbnamev=='worker'?$posao->werate:$posao->ewrate . '<br>';
                    $sadrzaj .= 'Comm: '.$tbnamev=='worker'?$posao->wecomm:$posao->ewcomm . '<br>';
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
