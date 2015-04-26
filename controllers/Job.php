<?php

require 'models/worker.php';
require 'models/employer.php';
require 'models/job.php';

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

        // dohvatanje posla
        $posao = Job::Query("SELECT * FROM job WHERE id=$job_id");
        $posao = $posao[0];

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
                    $radnici = array();
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

                    ->prvo($opcija_prva)
                    ->drugo($opcija_druga)
                    ->trece($opcija_treca)

                    ->get()
            )
            ->render();
    }
}