<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_manager {

    public  $config = [];
    public  $user_date_format = "";	
    public  $ci;
    
    public function __construct(){
        $this->ci = &get_instance();
        $this->get_config();
        $this->get_user_date_format();
    }

    public function get_config(){
        $this->ci->db->select('conf_id, IFNULL(conf_key, false) AS conf_key, IFNULL(conf_value,false) AS conf_value');
        $this->ci->db->from('configure');
        $query = $this->ci->db->get();
        $config = $query->result_array();
        foreach ($config as $c) {
            if($c['conf_key']){
                if($c['conf_value']){
                    $this->config[trim($c['conf_key'])] = trim($c['conf_value']);
                }else{
                    $this->config[trim($c['conf_key'])] = false;
                }
            }
        }

    }

    public function get_mysql_date($date){
        if($date == "") return "";
        $dateformatter = preg_split("@[/.-]@", $this->config['conf_dateformat']);
        $date_part = preg_split("@[/.-]@", $date);		
        $date_array = array();	
        for($i=0; $i<3; $i++) {
			$date_array[$dateformatter[$i]] = $date_part[$i];
		}
		return $date_array['yy']."-".$date_array['mm']."-".$date_array['dd'];
    }

    public function get_user_date_format(){		
		$dtformatter = array('dd'=>'%d', 'mm'=>'%m', 'yyyy'=>'%Y', 'yy'=>'%Y');		
		$dtformat = preg_split("@[/.-]@", $this->config['conf_dateformat']);
		$dtseparator = ($dtformat[0] === 'yyyy')? substr($this->config['conf_dateformat'], 4, 1) : substr($this->config['conf_dateformat'], 2, 1);
		$this->user_date_format = $dtformatter[$dtformat[0]].$dtseparator.$dtformatter[$dtformat[1]].$dtseparator.$dtformatter[$dtformat[2]];	
    }
    
    public function date_format(){
        if($this->config['conf_dateformat']=='yy-mm-dd')
        $df='yy'.$this->config['conf_dateformat'];
        else
         $df=$this->config['conf_dateformat'].'yy';
         return $df;
    }



}