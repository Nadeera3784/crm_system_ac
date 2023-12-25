<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Estimates_model extends CI_Model {

    public function add_estimates($form_data){
        $this->db->insert('estimates', $form_data);
        $last_id = $this->db->insert_id();
        return  $last_id;
    }

    public function delete_estimates($estimates_id){
        $this->db->where('estimates_id', $estimates_id);
		$query = $this->db->get('estimates_data');
        $data_array = $query->result();
        foreach($data_array as $esti){
            $this->db->where('estimates_id', $esti->estimates_id);   
            $this->db->delete('estimates_data');
        }
        $this->db->where('estimates_id', $estimates_id);   
        $this->db->delete('estimates');

    }
    
    public function get_estimates_by_id($estimates_id){
        $this->db->select("estimates.*,client.*,jobs.estimate_charges");
        $this->db->from('estimates');
        $this->db->join('jobs', 'jobs.job_id=estimates.job_no','inner');
        $this->db->join('client', 'client.client_id=jobs.client_id','inner');
        $this->db->where('estimates.estimates_id', $estimates_id);
        $query = $this->db->get();
        return $query->row();
        
    }

    public function get_estimates_data_by_id($estimates_id){
        $this->db->where('estimates_id', $estimates_id);
        $query = $this->db->get('estimates_data');
        return $query->result(); 
    }

    public function update_estimates($estimate_id, $form_data){
        $this->db->where('estimates_id', $estimate_id);
        $this->db->update('estimates', $form_data);
    }

    public function get_estimates(){
        $query = $this->db->get('estimates');
        return $query->result();
    }

}