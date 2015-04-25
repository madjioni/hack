<?php

class Employer extends Model
{
    protected static $table = 'employer';
    protected static $map = array
                            (
                                'id' => 'id',
                                'firstname' => 'firstname',
                                'lastname' => 'lastname',
                                'location' => 'location',
                                'mail' => 'mail',
                                'pass' => 'pass',
                                'phone' => 'phone',
                                'description' => 'description',
                                'active' => 'active',
                            );

    public $id;
    public $firstname;
    public $lastname;
    public $location;
    public $mail;
    public $pass;
    public $phone;
    public $description;
    public $active;
}