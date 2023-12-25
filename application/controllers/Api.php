<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('TDTechnician_model');
        $this->load->model('TDClient_model');
        $this->load->model('TDJobs_model');
        $this->load->model('TDJobstechnician_model');
        $this->load->model('TDTechnicianattendance_model');
        $this->load->model('TDAttendance_model');
        $this->load->model('TDEstimates_model');
        $this->load->model('TDProgress_model');
        $this->load->model('Jobs_model');
        $this->load->model('Attendance_model');
        $this->load->model('Client_model');
        $this->load->model('Estimates_model');
        $this->load->model('Progress_model');
        $this->load->model('Report_model');

    }

    public function technician_list(){
        if($this->input->is_ajax_request()){
            $list = $this->TDTechnician_model->get_datatables();
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $technicians) {
                $no++;
                $row = array();
                $row[] = $technicians->employee_no;
                $row[] = ucwords($technicians->full_name);
                $row[] = ($technicians->active == 1)? "Yes"  : "No";
                $row[] = $technicians->email;
                $row[] = $technicians->phone;
                $row[] = $this->hasher->encrypt($technicians->userID);
                $data[] = $row;
            }
    
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->TDTechnician_model->count_all(),
                "recordsFiltered" => $this->TDTechnician_model->count_filtered(),
                "data" => $data,
            );
            header('Content-Type: application/json');
            echo json_encode($output);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function delete_technician(){
        if($this->input->is_ajax_request()){
            $technician_id   = $this->hasher->decrypt($this->input->post('technician_id', TRUE));
            $user = $this->ion_auth->user($technician_id)->row();
            if (file_exists('./uploads/profile/'.$user->avatar)){
				unlink('./uploads/profile/'.$user->avatar);
            }
            $this->ion_auth->delete_user($user->id);
            $this->db->where('users_id', $technician_id);
			$this->db->delete('jobs_relation');
            $response  =  array('type' => 'success', 'message' =>  "Technician has been successfully deleted");
			header("Content-type: application/json");	
			echo json_encode($response);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function client_list(){
        if($this->input->is_ajax_request()){
            $list = $this->TDClient_model->get_datatables();
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $client) {
                $no++;
                $row = array();
                $row[] = ucwords($client->company_name);
                $row[] = $client->contact_general;
                $row[] = $client->contact_person;
                $row[] = $client->email;
                $row[] = $client->location;
                $row[] = $this->hasher->encrypt($client->client_id);
                $data[] = $row;
            }
    
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->TDClient_model->count_all(),
                "recordsFiltered" => $this->TDClient_model->count_filtered(),
                "data" => $data,
            );
            header('Content-Type: application/json');
            echo json_encode($output);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function job_list(){
        if($this->input->is_ajax_request()){
            $list = $this->TDJobs_model->get_datatables();
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $jobs) {
                $no++;
                $html = "";
                $row = array();
                $row[] = '<a href="' . base_url() ."admin/job_details/". $this->hasher->encrypt($jobs->job_id). '">'.$jobs->job_id .'</a>';
                $row[] = ucwords($jobs->company_name);
                $row[] = $jobs->end_date;
                $this->db->select("users.full_name, users.avatar");
                $this->db->from("jobs");
                $this->db->join('jobs_relation', 'jobs_relation.jobs_id = jobs.job_id', 'left');
                $this->db->join('users', 'jobs_relation.users_id = users.id', 'left');
                $this->db->where('jobs.job_id', $jobs->job_id);
                $query = $this->db->get();
                $users = $query->result();
                foreach($users as $user){
                    $html  .=  '<a href="#" id="avatarpop"  title="'.$user->full_name.'"><img  src="'.base_url().'uploads/profile/'.$user->avatar.'" class="img-circle img-xs job-avatar" alt=""></a>';
                }

                $row[] = $html;
                $change_status = '<div class="btn-group">'.
                                 '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">'.
                                 'Change <span class="caret"></span></button>'.
                                 '<ul class="dropdown-menu animated zoomIn">'.
                                 '<li><a href="' . base_url() ."admin/change_status/". $jobs->job_id . '/started' . '">Started</a></li>'.
                                 '<li><a href="' . base_url() ."admin/change_status/". $jobs->job_id . '/in_progress' .'">In Progress</a></li>'.
                                 '<li><a href="' . base_url() ."admin/change_status/". $jobs->job_id . '/cancel' . '">Cancel</a></li>'.
                                 '<li><a href="' . base_url() ."admin/change_status/". $jobs->job_id . '/on_hold' . '">On Hold</a></li>'.
                                 '<li><a href="' . base_url() ."admin/change_status/". $jobs->job_id . '/completed' . '">Completed</a></li>'.
                                 '</ul></div>';

                $row[] = '<span class="label label-primary">'.status_transformer($jobs->status).'</span> '.$change_status;
                $row[] = $this->hasher->encrypt($jobs->job_id);
                $data[] = $row;
            }
    
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->TDJobs_model->count_all(),
                "recordsFiltered" => $this->TDJobs_model->count_filtered(),
                "data" => $data,
            );
            header('Content-Type: application/json');
            echo json_encode($output);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function get_calendar_events(){
        if ($this->ion_auth->logged_in()){
            if($this->input->is_ajax_request()){      
                $calendar_events = $this->Jobs_model->get_jobs();
                $data = array();
                foreach($calendar_events as $ce){
                    $events = new stdClass();
                    $events->id = $ce->job_id;
                    $events->start = $ce->start_date;
                    $events->end = $ce->end_date;
                    $events->title = ucwords($ce->job_type);    
                    if($ce->status == "started"){
                        $events->className = 'status-started';
                    }else if($ce->status == "in-progress"){
                        $events->className = 'status-in-progress';
                    }else if($ce->status == "on-hold"){
                        $events->className = 'status-on-hold';
                    }else if($ce->status == "cancel"){
                        $events->className = 'status-cancel';
                    }else if($ce->status == "completed"){
                        $events->className = 'status-completed';
                    }   
                    //$events->backgroundColor = '#ED1317';            
                    array_push($data, $events);
                       
                }
               header("Content-type: application/json");	
               echo json_encode($data);                
            }else{
                $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
                header("Content-type: application/json");	
                echo json_encode($response); 
            }

		}else{
            $response  =  array('type' => 'error', 'message' =>  "Unauthorized access");
            header("Content-type: application/json");	
            echo json_encode($response); 
        }        
    }

    public function technician_job_list(){
        if($this->input->is_ajax_request()){
            $list = $this->TDJobstechnician_model->get_datatables();
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $jobs) {
                $no++;
                $row = array();
                $row[] = $jobs->job_id;
                $row[] = ucwords($jobs->company_name);
                $row[] = $jobs->end_date;
                $row[] = '<span class="label label-primary">'.status_transformer($jobs->status).'</span> ';
                $row[] = $this->hasher->encrypt($jobs->job_id);
                $data[] = $row;
            }
    
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->TDJobstechnician_model->count_all(),
                "recordsFiltered" => $this->TDJobstechnician_model->count_filtered(),
                "data" => $data,
            );
            header('Content-Type: application/json');
            echo json_encode($output);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }

    }

    public function attendance_list_technician(){
        if($this->input->is_ajax_request()){
            $list = $this->TDTechnicianattendance_model->get_datatables();
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $attendance) {
                $no++;
                $row = array();
                $date_now = (new DateTime())->format('Y-m-d'); 
                $check_date = (new DateTime($attendance->in_time))->format('Y-m-d'); 
                $row[] = "<span class=\"label label-primary\">".date("Y-m-d", strtotime($attendance->in_time))."</span>";
                $row[] = $attendance->in_time;
                $row[] = $attendance->out_time ;
                $row[] = $attendance->hours;
                $row[] =  ($date_now ==  $check_date ? '<a href="'.base_url().'technician/update_attendance_by_technician/'.$this->hasher->encrypt($attendance->attendance_id).'" class="btn btn-xs btn-primary mr-10">Update</a>' : '<a href="" class="btn btn-xs btn-primary mr-10 disabled">Update</a>');
                $data[] = $row;
            }
    
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->TDTechnicianattendance_model->count_all(),
                "recordsFiltered" => $this->TDTechnicianattendance_model->count_filtered(),
                "data" => $data,
            );
            header('Content-Type: application/json');
            echo json_encode($output);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }
    
    public function add_attendance_by_technician(){
        if($this->input->is_ajax_request()){
            $in_time  = $this->input->post('in_time', TRUE);
            $user_id  = $this->input->post('user_id', TRUE);

            $this->form_validation->set_rules('in_time', 'in_time', 'required|callback_is_in_time_added');

            if ($this->form_validation->run() == FALSE){
                $response  =  array('type' => 'error', 'message' =>  "Please pick a date");
                header("Content-type: application/json");	
                echo json_encode($response);
            }else{
                $form_data['user_id']   = $user_id;
                $form_data['in_time']   = $in_time;
                $this->Attendance_model->add_attendance_by_technician($form_data);
                $response  =  array('type' => 'success', 'message' =>  "Your attendance has been marked!!!");
                header("Content-type: application/json");	
                echo json_encode($response);
            }
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function is_in_time_added() {
        $this->db->select('in_time');
        $this->db->from('attendance');
        $this->db->where('user_id', $this->input->post('user_id', TRUE));
        $this->db->where('date(in_time)', date('Y-m-d'));
        $query = $this->db->get();
        if ($query->num_rows() > 0 ){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function  attendance_list(){
        if($this->input->is_ajax_request()){
            $list = $this->TDAttendance_model->get_datatables();
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $attendance) {
                $no++;
                $row = array();
                $row[] = (new DateTime($attendance->in_time))->format('F-d');
                $row[] = ucwords($attendance->full_name);
                $row[] = $attendance->in_time;
                $row[] = $attendance->out_time;
                $row[] = $attendance->hours;
                $row[] = $this->hasher->encrypt($attendance->attendance_id);
                $data[] = $row;
            }
    
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->TDAttendance_model->count_all(),
                "recordsFiltered" => $this->TDAttendance_model->count_filtered(),
                "data" => $data,
            );
            header('Content-Type: application/json');
            echo json_encode($output);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function attendance_chart_list(){
        $this->db->select('*');
        $this->db->from('attendance');
        $this->db->join('users', 'attendance.user_id  = users.id', 'INNER');
        $query = $this->db->get();
        $attendance =  $query->result();
        $data = array();
        foreach($attendance as $at){
            $events = new stdClass();
            $events->id = $at->attendance_id;
            $events->name = $at->full_name  ;
            $events->series = array(
                'name' =>  $at->full_name,
                'start' => (new DateTime($at->in_time))->format('Y-m-d'),
                'end' => (new DateTime($at->out_time))->format('Y-m-d')
            );          
            array_push($data, $events);
                
        } 
        header("Content-type: application/json");	
        echo json_encode($data);                

    }

    public function estimate_list(){
       if($this->input->is_ajax_request()){
            $list = $this->TDEstimates_model->get_datatables();
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $estimates) {
                $no++;
                $row = array();
                $row[] = $estimates->estimate_no;
                $row[] = $estimates->job_no;
                $row[] = status_transformer($estimates->company);
                $row[] = $estimates->total_amount;
                $row[] = $estimates->estimate_date;
                $row[] = $this->hasher->encrypt($estimates->estimates_id);
                $data[] = $row;
            }
    
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->TDEstimates_model->count_all(),
                "recordsFiltered" => $this->TDEstimates_model->count_filtered(),
                "data" => $data,
            );
            header('Content-Type: application/json');
            echo json_encode($output);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function delete_client(){
        if($this->input->is_ajax_request()){
            $client_id = $this->hasher->decrypt($this->input->post('client_id', TRUE));
            $this->Client_model->delete_client($client_id);
            $response  =  array('type' => 'success', 'message' =>  "Client has been deleted!!!");
            header("Content-type: application/json");	
            echo json_encode($response);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function delete_job(){
        if($this->input->is_ajax_request()){
            $job_id = $this->hasher->decrypt($this->input->post('job_id', TRUE));
            $this->Jobs_model->delete_job($job_id);
            $response  =  array('type' => 'success', 'message' =>  "Job has been deleted!!!");
            header("Content-type: application/json");	
            echo json_encode($response);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function delete_estimates(){
        if($this->input->is_ajax_request()){
            $estimates_id = $this->hasher->decrypt($this->input->post('estimates_id', TRUE));
            $this->Estimates_model->delete_estimates($estimates_id);
            $response  =  array('type' => 'success', 'message' =>  "Estimate has been deleted!!!");
            header("Content-type: application/json");	
            echo json_encode($response);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function add_progress_report(){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules('estimate_date', 'estimate_date', 'trim|required');
            $this->form_validation->set_rules('estimate_value', 'estimate_value', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $response  =  array('type' => 'error', 'message' =>  "You must fill in all of the fields");
                header("Content-type: application/json");	
                echo json_encode($response);
            }else{
                $form_data['estimate_date']     = $this->input->post('estimate_date', TRUE);
                $form_data['estimate_value']    = $this->input->post('estimate_value', TRUE);
                $form_data['job_no']            = $this->input->post('job_no', TRUE);
                $form_data['status']            = $this->input->post('status', TRUE);
                $form_data['estimate_no']       = $this->input->post('estimate_no', TRUE);
                $this->Progress_model->add_progress_report($form_data);
                $response  =  array('type' => 'success', 'message' =>  "Progress report has been created!!!");
                header("Content-type: application/json");	
                echo json_encode($response);
            }
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function progress_report_list(){
        if($this->input->is_ajax_request()){
            $list = $this->TDProgress_model->get_datatables();
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $progress) {
                $no++;
                $row = array();
                $row[] = $progress->job_no;
                $row[] = $progress->estimate_no;
                $row[] = $progress->estimate_date;
                $change_status = '<div class="btn-group">'.
                '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">'.
                'Change <span class="caret"></span></button>'.
                '<ul class="dropdown-menu">'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("In process"). '">In process</a></li>'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("Waiting for Approval").'">Waiting for Approval</a></li>'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("Pending Repair"). '">Pending Repair</a></li>'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("Pending estimate"). '">Pending estimate</a></li>'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("Waiting for payment") . '">Waiting for payment</a></li>'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("Ready for Collection") . '">Ready for Collection</a></li>'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("Waiting for delivery") . '">Waiting for delivery</a></li>'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("Not Approved"). '">Not Approved</a></li>'.
                '<li><a href="' . base_url() ."admin/change_progress_status/". $progress->progress_id . '/'.rawurlencode("Out for delivery") . '">Out for delivery</a></li>'.

                '</ul></div>';
                $row[] = '<span class="label label-primary">'.$progress->status."</span>" . $change_status ;
                $row[] = $progress->estimate_value;
                $row[] = $this->hasher->encrypt($progress->progress_id);
                $data[] = $row;
            }
    
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->TDProgress_model->count_all(),
                "recordsFiltered" => $this->TDProgress_model->count_filtered(),
                "data" => $data,
            );
            header('Content-Type: application/json');
            echo json_encode($output);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function delete_progressreport(){
        if($this->input->is_ajax_request()){
            $progress_repor_id = $this->hasher->decrypt($this->input->post('progress_repor_id', TRUE));
            $this->Progress_model->delete_progressreport($progress_repor_id);
            $response  =  array('type' => 'success', 'message' =>  "Estimate has been deleted!!!");
            header("Content-type: application/json");	
            echo json_encode($response);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function get_estimates_week_report(){
        if($this->input->is_ajax_request()){
            $data['weekdata']	=	array();
            $weekstart	=	date("Y-m-d", strtotime("- 6 DAYS"));
            $wbegin = new DateTime($weekstart);
            $wend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
            $winterval = DateInterval::createFromDateString('1 day');
            $wperiod = new DatePeriod($wbegin, $winterval, $wend);
            $i=0;
            
            foreach($wperiod as $dt){
                $date		=	 $dt->format( "Y-m-d" );	
                $dayno		=	 $dt->format( "N" );
                $day		=	 $dt->format( "D" );
                $day		=	strtolower($day);
                $weekdata	=	$this->Report_model->get_estimates_week_report($date);
                $data['weekdata'][$i]['date']	=	date('d M', strtotime($date));
                $data['weekdata'][$i]['booking']	=	@$weekdata->total;
            $i++;
            }
            header("Content-type: application/json");	
            echo json_encode($data);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function get_estimates_month_report(){
        if ($this->ion_auth->logged_in()){
            if($this->input->is_ajax_request()){
                $data['monthdata']	=	array();
                $mbegin             = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
                $mend               = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
                $minterval          = DateInterval::createFromDateString('1 day');
                $mperiod            = new DatePeriod($mbegin, $minterval, $mend);
                $i=0;
                foreach($mperiod as $dt){
                    $date		=	 $dt->format( "Y-m-d" );	
                    $dayno		=	 $dt->format( "N" );
                    $day		=	 $dt->format( "D" );
                    $day		=	strtolower($day);
                    $monthdata	=	$this->Report_model->get_estimates_week_report($date);
                    $data['monthdata'][$i]['date']	=	date('d M', strtotime($date));
                    $data['monthdata'][$i]['booking']	=	@$monthdata->total;
                $i++;
                }
                $response  =  array('type' => 'success', 'message' =>  $data);
                header("Content-type: application/json");	
                echo json_encode($response);                
            }else{
                $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
                header("Content-type: application/json");	
                echo json_encode($response); 
            }

		}else{
            $response  =  array('type' => 'error', 'message' =>  "Unauthorized access");
            header("Content-type: application/json");	
            echo json_encode($response); 
        }  
    }

    public function get_estimates_year_report(){
        if ($this->ion_auth->logged_in()){
            if($this->input->is_ajax_request()){
                $data['yeardata']	=	array();
                $start = $month = strtotime("- 365 days");
				$end = strtotime('+ 1 day');
                $i=0;
                while($month < $end){
                    $month = strtotime("+1 month", $month);
                     $Y	= date('Y', $month);
                     $M	= date('m', $month);
                    $yeardata	=	$this->Report_model->get_estimates_year_report($Y,$M); 
                    $data['yeardata'][$i]['date']	    =	date('M', $month)." ".date('Y', $month);
                    $data['yeardata'][$i]['booking']	=	@$yeardata->total;
                    $i++;	 
                }                        
                $response  =  array('type' => 'success', 'message' =>  $data);
                header("Content-type: application/json");	
                echo json_encode($response);                
            }else{
                $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
                header("Content-type: application/json");	
                echo json_encode($response); 
            }

		}else{
            $response  =  array('type' => 'error', 'message' =>  "Unauthorized access");
            header("Content-type: application/json");	
            echo json_encode($response); 
        }  
    }
    
    public function get_job_week_report(){
        if($this->input->is_ajax_request()){
            $data['weekdata']	=	array();
            $weekstart	=	date("Y-m-d", strtotime("- 6 DAYS"));
            $wbegin = new DateTime($weekstart);
            $wend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
            $winterval = DateInterval::createFromDateString('1 day');
            $wperiod = new DatePeriod($wbegin, $winterval, $wend);
            $i=0;
            
            foreach($wperiod as $dt){
                $date		=	 $dt->format( "Y-m-d" );	
                $dayno		=	 $dt->format( "N" );
                $day		=	 $dt->format( "D" );
                $day		=	strtolower($day);
                $weekdata	=	$this->Report_model->get_job_week_report($date);
                $data['weekdata'][$i]['date']	=	date('d M', strtotime($date));
                $data['weekdata'][$i]['booking']	=	@$weekdata->total;
            $i++;
            }
            header("Content-type: application/json");	
            echo json_encode($data);
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }

    public function get_job_month_report(){
        if ($this->ion_auth->logged_in()){
            if($this->input->is_ajax_request()){
                $data['monthdata']	=	array();
                $mbegin             = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
                $mend               = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
                $minterval          = DateInterval::createFromDateString('1 day');
                $mperiod            = new DatePeriod($mbegin, $minterval, $mend);
                $i=0;
                foreach($mperiod as $dt){
                    $date		=	 $dt->format( "Y-m-d" );	
                    $dayno		=	 $dt->format( "N" );
                    $day		=	 $dt->format( "D" );
                    $day		=	strtolower($day);
                    $monthdata	=	$this->Report_model->get_job_week_report($date);
                    $data['monthdata'][$i]['date']	=	date('d M', strtotime($date));
                    $data['monthdata'][$i]['booking']	=	@$monthdata->total;
                $i++;
                }
                $response  =  array('type' => 'success', 'message' =>  $data);
                header("Content-type: application/json");	
                echo json_encode($response);                
            }else{
                $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
                header("Content-type: application/json");	
                echo json_encode($response); 
            }

		}else{
            $response  =  array('type' => 'error', 'message' =>  "Unauthorized access");
            header("Content-type: application/json");	
            echo json_encode($response); 
        }  
    }

    public function get_job_year_report(){
        if ($this->ion_auth->logged_in()){
            if($this->input->is_ajax_request()){
                $data['yeardata']	=	array();
                $start = $month = strtotime("- 365 days");
				$end = strtotime('+ 1 day');
                $i=0;
                while($month < $end){
                    $month = strtotime("+1 month", $month);
                     $Y	= date('Y', $month);
                     $M	= date('m', $month);
                    $yeardata	=	$this->Report_model->get_job_year_report($Y,$M); 
                    $data['yeardata'][$i]['date']	    =	date('M', $month)." ".date('Y', $month);
                    $data['yeardata'][$i]['booking']	=	@$yeardata->total;
                    $i++;	 
                }                        
                $response  =  array('type' => 'success', 'message' =>  $data);
                header("Content-type: application/json");	
                echo json_encode($response);                
            }else{
                $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
                header("Content-type: application/json");	
                echo json_encode($response); 
            }

		}else{
            $response  =  array('type' => 'error', 'message' =>  "Unauthorized access");
            header("Content-type: application/json");	
            echo json_encode($response); 
        } 
    }

    public function access_checker(){
        if($this->input->is_ajax_request()){
            if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()){
                $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
                header("Content-type: application/json");	
                echo json_encode($response);
            }else{
                $response  =  array('type' => 'success', 'message' =>  "Default API endpoint");
                header("Content-type: application/json");	
                echo json_encode($response); 
            }
        }else{
            $response  =  array('type' => 'error', 'message' =>  "No direct script access allowed");
            header("Content-type: application/json");	
            echo json_encode($response);
        }
    }
}
