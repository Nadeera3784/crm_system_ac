<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Common {

public $ci;

public function __construct(){
    $this->ci = &get_instance();
}

public function get_block($user_id, $date){
    $query = $this->ci->db->query('SELECT DATE_FORMAT(in_time, "%D") AS StartDate FROM `app_attendance` WHERE user_id = '.$user_id.' AND  DATE_FORMAT(in_time, "%Y-%m-%d") =  "'.$date.'"');
    if($query->num_rows()){
         echo 'check';
    }else{
        echo 'close';
    }
}

}