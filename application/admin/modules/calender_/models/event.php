<?php

class Event extends CI_Model {

    static $types = array(
        'CLASS' => 1,
        'PARTY' => 2,
        'CLUB' => 3,
        'EVENT' => 4,
        'RETAILS' => 9,
    );
    static $types1 = array(
        1 => 'CLASS__income',
        2 => 'PARTY__income',
        3 => 'CLUB__income',
        4 => 'EVENT__income',
        9 => 'RETAILS__retail_buyed',
    );
    static $report1 = array(
        'DAILY' => 1,
        'WEEKLY' => 2,
        'MONTHLY' => 3,
        'YEARLY' => 4
    );
    static $report = array(
        1 => 'DAILY',
        2 => 'WEEKLY',
        3 => 'MONTHLY',
        4 => 'YEARLY'
    );

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

}
