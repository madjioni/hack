<?php

class RegistrationController extends Controller {

    public function run()
    {

        //preko POST
        

        $type_reg = Request::GET('t');
        $res = null;
        if($type_reg=='e')
        {
            $firstname = Request::POST('firstname_rfe');
            $lastname = Request::POST('lastname_rfe');
            $email = Request::POST('email_rfe');
            $pass = sha1(Request::POST('pass_rfe'));
            $location = Request::POST('location_rfe');
            $phone = Request::POST('phone_rfe');
            $description = Request::POST('description_rfe');
            $res = DB::Query("INSERT INTO employer VALUES (0, '$firstname', '$lastname', '$location', '$email', '$pass', '$phone', '$description', 0)");
        }
        else if($type_reg=='w')
        {
            $firstname = Request::POST('firstname_rfw');
            $lastname = Request::POST('lastname_rfw');
            $email = Request::POST('email_rfw');
            $pass = sha1(Request::POST('pass_rfw'));
            $location = Request::POST('location_rfw');
            $phone = Request::POST('phone_rfw');
            $age = Request::POST('age_rfw');
            $gender = Request::POST('gender_rfw');
            $res = DB::Query("INSERT INTO worker VALUES (0, '$firstname', '$lastname', '$location', '$email', '$pass', 1, $age, '$phone', 0)");
        }

        if( $res )
        {
            $result = "All good.";

            
            $to      = $email;
            $subject = 'Registration';
            $message = 'To confirm your registration, please click on the link below: <a href="'.Core::$config['WEBSITE'].'/t/'.$type_reg.'/activate/user/'.$pass.'">confirm</a>.<br>Thank you, paprika.rs team';
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $headers .= "Reply-To: NoReply <noreply@paprika.rs>\r\n";
            $headers .= "From: paprikaregistration <noreply@paprika.rs>\r\n"; 

            // TODO: send email confirmation
            mail($to, $subject, $message, $headers);
        }

        echo $res;
    }
}