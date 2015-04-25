<?php

class Worker extends Model
{
    protected static $table = 'worker';
    protected static $map = array
                            (
                                'id' => 'id',
                                'firstname' => 'firstname',
                                'lastname' => 'lastname',
                                'location' => 'location',
                                'mail' => 'mail',
                                'pass' => 'pass',
                                'gender' => 'gender',
                                'age' => 'age',
                                'phone' => 'phone',
                                'active' => 'active',
                            );

    public $id;
    public $firstname;
    public $lastname;
    public $location;
    public $mail;
    public $pass;
    public $gender;
    public $phone;
    public $age;
    public $active;
}