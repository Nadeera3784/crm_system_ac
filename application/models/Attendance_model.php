<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Attendance_model extends CI_Model {

    public function add_attendance_by_technician($form_data){
        $this->db->insert('attendance', $form_data);
    }

    
    public function get_attendance_by_id($attendance_id){
        $this->db->where('attendance_id', $attendance_id);
        $result = $this->db->get('attendance');
        return $result->row();
    }

    public function update_attendance_technician($attendance_id, $form_data){
        $this->db->where('attendance_id', $attendance_id);
        $result = $this->db->get('attendance');
        $data =  $result->row();
        $datetime1 = new DateTime($data->in_time);
        $datetime2 = new DateTime($form_data['out_time']);
        $interval = $datetime1->diff($datetime2);
        $form_data['hours'] =  $interval->h;
        $this->db->where('attendance_id', $attendance_id);
        $this->db->update('attendance', $form_data);
    }


    public function update_attendance($attendance_id, $form_data){
        $this->db->where('attendance_id', $attendance_id);
        $result = $this->db->get('attendance');
        $data =  $result->row();
        $datetime1 = new DateTime($data->in_time);
        $datetime2 = new DateTime($data->out_time);
        $interval = $datetime1->diff($datetime2);
        $form_data['hours'] =  $interval->h;
        $this->db->where('attendance_id', $attendance_id);
        $this->db->update('attendance', $form_data);
    }
    

}