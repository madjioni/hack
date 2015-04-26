<?php

class Japp extends Model
{
    protected static $table = 'apps';
    protected static $map = array
                            (
                                'idjob' => 'idjob',
                                'idworker' => 'idworker',

                                'ewdone' => 'ewdone',
                                'ewrate' => 'ewrate',
                                'ewcomm' => 'ewcomm',

                                'wedone' => 'wedone',
                                'wecomm' => 'wecomm',
                                'werate' => 'werate',
                            );

    public $idjob;
    public $idworker;
    public $ewdone;
    public $ewrate;
    public $ewcomm;
    public $wedone;
    public $wecomm;
    public $werate;
}