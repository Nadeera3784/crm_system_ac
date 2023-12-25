<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Technician_model extends CI_Model {

    public function get_technician_by_id($id){
        $this->db->where('id', $id);
        $result = $this->db->get('users');
        return $result->row();
    }

    public function get_assigned_technician_by_job_id($id){
        $this->db->where('jobs_id', $id);
        $result = $this->db->get('jobs_relation');
        return $result->result();
    }

    public function get_technician(){
        $result = $this->db->get('jobs_relation');
        return $result->result();
    }

}