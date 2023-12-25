<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Client_model extends CI_Model {

    public function add_client($form_data){
        $this->db->insert('client', $form_data);
    }

    public function get_client(){
        $query = $this->db->get('client');
        return $query->result();
    }

    public function get_client_by_id($id){
        $this->db->where('client_id', $id);
        $result = $this->db->get('client');
        return $result->row();
    }

    public function update_client($form_data, $id){
        $this->db->where('client_id', $id);
        $this->db->update('client', $form_data); 
    }

    public function delete_client($client_id){
        $this->db->where('client_id', $client_id);
		$job    = $this->db->get('jobs');
        $job_id = $job->result();
        foreach($job_id as $jid){
            $this->db->where('jobs_id', $jid->job_id);
            $this->db->delete('jobs_relation');
            $this->db->where('job_no', $jid->job_id);
            $estimates   = $this->db->get('estimates');
            $est = $estimates->result();
            foreach($est as $es){
                $this->db->where('estimates_id', $es->estimates_id);   
                $this->db->delete('estimates_data');
            }
            $this->db->where('job_no', $jid->job_id);
            $this->db->delete('estimates');
        }
        $this->db->where('client_id', $client_id);   
        $this->db->delete('jobs');
        $this->db->where('client_id', $client_id);
        $this->db->delete('client');
        
    }

}