<?php

class RegisterController extends Controller {

    public function run()
    {
        // preko GET
        // $email = Request::GET('email');
        // $pass = Request::GET('pass');

        //preko POST
        $email = Request::POST('email');
        $pass = sha1(Request::POST('pass'));



        $result = "Not good.";

        if( DB::Query("INSERT INTO users VALUES (0, '$email', '$pass', 0)") )
        {
            $result = "All good.";

            
            $to      = $email;
            $subject = 'Registration';
            $message = 'To confirm your registration, please click on the link: <a href="'.Core::$config['WEBSITE'].'/confirm/user/'.$email.'">confirm</a>.';
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            // TODO: send email confirmation
            mail($to, $subject, $message, $headers);
        }

        echo $result;
    }
}