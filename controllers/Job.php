<?php

require 'models/worker.php';
require 'models/employer.php';
require 'models/job.php';
require 'models/japp.php';

class JobController extends Controller {

    public function run()
    {
        $opcija_prva = false;
        $opcija_druga = false;
        $opcija_treca = false;

        $logged = isset(Session::GetData()['email']);
        $korisnik = $logged ? Session::GetData()['email'] : 'niko';

        $job_id = Request::GET("id");

        $user = null;
        $poslodavac = null;
        $posao = null;

        $radnici = null;
        $aktivan = false;

        // dohvatanje posla
        $posao = Job::Query("SELECT * FROM job WHERE id=$job_id");
        $posao = $posao[0];
        $posao->pricetype = $posao->pricetype==1?'RSD/dan':$posao->pricetype==2?'RSD/h':'RSD/kg';

        // dohvatanje poslodavca
        $poslodavac = Employer::Query("SELECT * FROM employer WHERE id=".$posao->idemployer);
        $poslodavac = $poslodavac[0];

        // dohvatanje onoga ko pregleda stranicu
        if(!$logged)
        {
            $opcija_prva = true;
        }
        else
        {
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


            // odlucivanje za prikaz
            if($tbname=='employer')
            {
                if($poslodavac->id != $user->id)
                {
                    $opcija_prva = true;
                }
                else
                {
                    $opcija_druga = true;
                    $radnici = Japp::Query("SELECT * FROM apps WHERE wedone=1 AND ewdone=1 AND idjob=".$posao->id);
                    $ws = array();
                    foreach ($radnici as $radnik)
                    {
                        $r = Worker::Query("SELECT * FROM worker WHERE id=".$radnik->idworker)[0];
                    }
                    $radnici = $ws;

                    $now = date('m/d/Y h:i:s a', time());
                    $unix_now = strtotime($now);

                    $start = date('m/d/Y h:i:s a', strtotime($posao->activestart));
                    $unix_start = strtotime($start);

                    $diff = $posao->activeend * 24 * 60 * 60;

                    $aktivan = ($unix_start+$diff > $unix_now);
                }
            }

            if($tbname=='worker')
            {
                $opcija_treca = true;
            }
        }


        Template::load('base')
            ->title('Poslovi')
            ->logged($logged)
            ->korisnik($korisnik)
            ->content
            (
                Template::load('job_page')

                    ->poslodavac($poslodavac)
                    ->user($user)
                    ->posao($posao)

                    ->radnici($radnici)
                    ->aktivan($aktivan)

                    ->prvo($opcija_prva)
                    ->drugo($opcija_druga)
                    ->trece($opcija_treca)

                    ->get()
            )
            ->render();
    }
}