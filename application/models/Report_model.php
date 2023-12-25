<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model{

    public function get_estimates_week_report($date){
        $this->db->group_by(array('MONTH(estimate_date)'));
        $this->db->where('DATE(estimate_date)', $date);
        $this->db->select('SUM(total_amount) as total');
        return  $this->db->get('estimates')->row();
    }

    public function get_estimates_year_report($y,$m){
        $this->db->where('MONTH(estimate_date)', $m);
        $this->db->where('YEAR(estimate_date)', $y);
        $this->db->select('SUM(total_amount) as total');
        return  $this->db->get('estimates')->row();
    }

    public function generate_job_report(){
        $this->db->select("jobs.job_id,jobs.end_date,client.company_name");

        if($this->input->post('job_type')){
            $this->db->where('jobs.job_category ', $this->input->post('job_type')); 
        }
        if($this->input->post('report_term') == "daily"){
            $this->db->where('jobs.end_date > DATE_SUB(NOW(), INTERVAL 1 DAY)');
            $this->db->order_by('jobs.job_id', 'DESC');
        }
        if($this->input->post('report_term') == "weekly"){
            $this->db->where('jobs.end_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)');
            $this->db->order_by('jobs.job_id', 'DESC');
        }
        if($this->input->post('report_term') == "monthly"){
            $this->db->where('jobs.end_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)');
            $this->db->order_by('jobs.job_id', 'DESC');
        }

        $this->db->from('jobs');
        $this->db->join('client', 'client.client_id=jobs.client_id','inner');
        $query = $this->db->get();
        return $query->result();
    }

    public function generate_technician_report(){
        $this->db->select("jobs.job_id,jobs.end_date,client.company_name");
        $this->db->from('jobs');
        $this->db->join('jobs_relation', 'jobs_relation.jobs_id=jobs.job_id','inner');
        $this->db->join('client', 'client.client_id=jobs.client_id','inner');
        $this->db->where('jobs.status', "completed");
        $this->db->where('jobs_relation.users_id ', $this->input->post('technician'));
        if($this->input->post('report_term') == "daily"){
            $this->db->where('jobs.end_date > DATE_SUB(NOW(), INTERVAL 1 DAY)');
            $this->db->order_by('jobs.job_id', 'DESC');
        }
        if($this->input->post('report_term') == "weekly"){
            $this->db->where('jobs.end_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)');
            $this->db->order_by('jobs.job_id', 'DESC');
        }
        if($this->input->post('report_term') == "monthly"){
            $this->db->where('jobs.end_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)');
            $this->db->order_by('jobs.job_id', 'DESC');
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_completed_job_count(){
        $this->db->select('COUNT(job_id) as total');
        $this->db->where('status', "completed");
        return  $this->db->get('jobs')->row();
    }

    public function get_started_job_count(){
        $this->db->select('COUNT(job_id) as total');
        $this->db->where('status', "started");
        return  $this->db->get('jobs')->row();
    }

    public function get_in_progress_job_count(){
        $this->db->select('COUNT(job_id) as total');
        $this->db->where('status', "in_progress");
        return  $this->db->get('jobs')->row();
    }

    public function get_cancel_job_count(){
        $this->db->select('COUNT(job_id) as total');
        $this->db->where('status', "cancel");
        return  $this->db->get('jobs')->row();
    }

    public function get_job_week_report($date){
        $this->db->group_by(array('MONTH(end_date)'));
        $this->db->where('DATE(end_date)', $date);
        $this->db->select('COUNT(job_id) as total');
        return  $this->db->get('jobs')->row();
    }

    public function get_job_year_report($y,$m){
        $this->db->where('MONTH(end_date)', $m);
        $this->db->where('YEAR(end_date)', $y);
        $this->db->select('COUNT(job_id) as total');
        return  $this->db->get('jobs')->row();
    }



}