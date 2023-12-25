<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Technician extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('Client_model');
        $this->load->model('Attendance_model'); 
        $this->load->model('Jobs_model'); 
        $this->access_only_technician();
        $this->form_validation->set_error_delimiters('<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>', '</div>');
    }

    public function index(){
        $this->load->view('technician/header');
        $this->load->view('technician/dashboard');
        $this->load->view('footer');
    }

    public function job_list(){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/dialog.css',
            'assets/css/datepicker.css'
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/dialog.js',
            'assets/js/datepicker.js',
            'assets/js/app.js',
        );
        $data["clients"]    = $this->Client_model->get_client();
        $this->load->view('technician/header', $data);
        $this->load->view('technician/job', $data);
        $this->load->view('footer', $data);
    }

    public function attendance_list(){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/dialog.css',
            'assets/css/datepicker.css',
            'assets/css/jquery.datetimepicker.css'
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/dialog.js',
            'assets/js/datepicker.js',
            'assets/js/jquery.datetimepicker.js',
            'assets/js/app.js',
        );
        $data['user'] = $this->ion_auth->user()->row();
        $this->load->view('technician/header', $data);
        $this->load->view('technician/attendance', $data);
        $this->load->view('footer', $data);
    }

    public function update_attendance_by_technician($attendance_id){
        $data['css'] = array(
            'assets/css/jquery.datetimepicker.css'
        );
        $data['js'] = array(
            'assets/js/jquery.datetimepicker.js',
            'assets/js/app.js',
        );
        $data['attendance_id'] = $attendance_id;

        $this->load->view('technician/header',  $data);
        $this->load->view('technician/update_attendance', $data);
        $this->load->view('footer', $data);
    }

    public function save_attendance(){
        $out_time  = $this->input->post('out_time', TRUE);
        $attendance_id  = $this->input->post('attendance_id', TRUE);

        $this->form_validation->set_rules('out_time', 'Out Time', 'required|callback_is_out_time_added');

        if ($this->form_validation->run() == FALSE){
             $this->update_attendance_by_technician($attendance_id);
        }else{
             $form_data['out_time']   = $out_time;         
            $this->Attendance_model->update_attendance_technician($this->hasher->decrypt($attendance_id), $form_data);
            $this->session->set_flashdata('success','Your attendance has been marked!!!');
            redirect('technician/attendance_list', 'refresh');
        }
    }

    public function is_out_time_added() {
        $this->db->select('out_time');
        $this->db->from('attendance');
        $this->db->where('attendance_id', $this->hasher->decrypt($this->input->post('attendance_id', TRUE)));
        $this->db->where('date(out_time)', date('Y-m-d'));
        $query = $this->db->get();
        if ($query->num_rows() > 0 ){
            $this->form_validation->set_message('is_out_time_added', 'Your attendance has already been submitted');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function job_details($job_id){
        $data["job"] = $this->Jobs_model->get_job_details($this->hasher->decrypt($job_id));
        $this->load->view('technician/header');
        $this->load->view('technician/job_details', $data);
        $this->load->view('footer');
    }


    public function access_only_technician(){
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group("technician")){
            return true;
        }else{
            $this->session->set_flashdata('message', "You must be an administrator to view this page");
            redirect('auth/login', 'refresh');
        }
    }
}