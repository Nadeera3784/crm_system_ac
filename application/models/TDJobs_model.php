<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class TDJobs_model extends CI_Model {
 
    var $table = 'jobs';
    var $column_order = array(null, 'job_id'); 
    var $column_search = array('job_id'); 
    var $order = array('job_id' => 'desc'); 
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query(){
        $this->db->select("jobs.job_id, jobs.end_date, client.company_name, jobs.status");

        if($this->input->post('start_date') && $this->input->post('end_date')){
            $this->db->where('jobs.start_date >=', $this->input->post('start_date')); 
            $this->db->where('jobs.start_date <=', $this->input->post('end_date'));
        }

        if($this->input->post('company')){
            $this->db->like('jobs.company', $this->input->post('company'));
        }

        if($this->input->post('client_id')){
            $this->db->like('client.client_id', $this->input->post('client_id'));
        }

        if($this->input->post('category')){
            $this->db->like('jobs.job_category', $this->input->post('category'));
        }

        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start(); 
                    $this->db->like("jobs.".$item, $_POST['search']['value']);
                }else{
                    $this->db->or_like("jobs.".$item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    public function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->join('client', 'jobs.client_id = client.client_id', 'INNER');
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered(){
        $this->_get_datatables_query();
        $this->db->join('client', 'jobs.client_id = client.client_id', 'INNER');
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
 
}