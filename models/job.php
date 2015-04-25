<?php

class Job extends Model
{
    protected static $table = 'job';
    protected static $map = array
                            (
                                'id' => 'id',
                                'title' => 'title',
                                'description' => 'description',
                                'location' => 'location',
                                'datestart' => 'datestart',
                                'dateend' => 'dateend',
                                'num' => 'num',
                                'price' => 'price',
                                'pricetype' => 'pricetype',
                                'time' => 'time',
                                'transportation' => 'transportation',
                                'activestart' => 'activestart',
                                'activeend' => 'activeend',
                                'idemployer' => 'idemployer',
                                'idcat' => 'idcat',
                            );

    public $id;
    public $title;
    public $description;
    public $location;
    public $datestart;
    public $dateend;
    public $num;
    public $price;
    public $pricetype;
    public $time;
    public $transportation;
    public $activestart;
    public $activeend;
    public $idemployer;
    public $idcat;
}