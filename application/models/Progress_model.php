<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Progress_model extends CI_Model {

    public function add_progress_report($form_data){
        $this->db->insert('progress', $form_data);
    }

    public function update_status($progress_id, $form_data){
        $this->db->where('progress_id', $progress_id);
        $this->db->update('progress', $form_data);
    }

    public function get_progress_by_id($progress_id){
        $this->db->where('progress_id', $progress_id);
        $result = $this->db->get('progress');
        return $result->row();
    }

    public function delete_progressreport($progress_id){
        $this->db->where('progress_id', $progress_id);   
        $this->db->delete('progress');
    }

}