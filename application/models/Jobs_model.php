<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Jobs_model extends CI_Model {

    public function add_jobs($form_data){
        $this->db->insert('jobs', $form_data);
        $last_id = $this->db->insert_id();
        return  $last_id;
    }

    public function get_jobs_by_id($id){
        $this->db->where('job_id', $id);
        $result = $this->db->get('jobs');
        return $result->row();
    }

    public function update_status($id, $form_data){
        $this->db->where('job_id', $id);
        $this->db->update('jobs', $form_data);
    }

    public function get_jobs(){
        $query = $this->db->get('jobs');
        return $query->result(); 
    }

    public function clone_job($job_id){
        $this->db->where('job_id', $job_id);
        $result = $this->db->get('jobs');
        $job =  $result->row();
        $form_data['company']            =  $job->company;
        $form_data['start_date']         =  $job->start_date;
        $form_data['end_date']           =  $job->end_date;
        $form_data['job_category']       =  $job->job_category;
        $form_data['client_id']          =  $job->client_id;
        $form_data['service_type']       =  $job->service_type;
        $form_data['job_type']           =  $job->job_type;
        $form_data['product_type']       =  $job->product_type;
        $form_data['brand']              =  $job->brand;
        $form_data['fault_description']  =  $job->fault_description;
        $form_data['accessories']        =  $job->accessories;
        $form_data['model_no']           =  $job->model_no;
        $form_data['serial_no']          =  $job->serial_no;
        $form_data['status']             =  $job->status;
        $form_data['sales_person']       =  $job->sales_person;
        $form_data['remarks']            =  $job->remarks;
        $this->db->insert('jobs', $form_data);
    }

    public function update_jobs($id, $form_data){
        $this->db->where('job_id', $id);
        $this->db->update('jobs', $form_data);
    }

    public function delete_job($job_id){
        $this->db->where('job_id', $job_id);
		$job    = $this->db->get('jobs');
        $j_id = $job->result();
        foreach($j_id as $jid){
            $this->db->where('jobs_id', $jid->job_id);
            $this->db->delete('jobs_relation');
        }
        $this->db->where('job_id', $job_id);   
        $this->db->delete('jobs');
    }

    public function get_job_details($job_id){
        $this->db->select("jobs.*,client.*");
        $this->db->from('jobs');
        $this->db->join('client', 'client.client_id=jobs.client_id','inner');
        $this->db->where('jobs.job_id', $job_id);
        $result = $this->db->get();
        return $result->row();
    }


}