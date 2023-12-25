<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('common');
        $this->load->model('Technician_model');
        $this->load->model('Client_model');
        $this->load->model('Jobs_model');
        $this->load->model('Attendance_model');
        $this->load->model('Estimates_model');
        $this->load->model('Progress_model');
        $this->load->model('Report_model');
        $this->access_only_admin();
        $this->form_validation->set_error_delimiters('<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>', '</div>');
    }

    public function index(){

        $data['css'] = array(
            'assets/css/morris.css'
        );
        $data['js'] = array(
            'assets/js/raphael.min.js',
            'assets/js/morris.min.js',
            'assets/js/app_report.js',
            'assets/js/clockfy.js'
        );
        
        $data['completed_job'] = $this->Report_model->get_completed_job_count();
        $data['started_job'] = $this->Report_model->get_started_job_count();
        $data['in_progress_job'] = $this->Report_model->get_in_progress_job_count();
        $data['cancel_job'] = $this->Report_model->get_cancel_job_count();
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard', $data);
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
        $this->load->view('admin/header', $data);
        $this->load->view('admin/job', $data);
        $this->load->view('footer', $data);
    }

    public function technician_list(){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/dialog.css',
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/dialog.js',
            'assets/js/app.js',
        );

        $this->load->view('admin/header', $data);
        $this->load->view('admin/technicians', $data);
        $this->load->view('footer', $data);
    }

    public function add_technician(){

        $full_name         = $this->input->post('full_name', TRUE);
        $email             = strtolower($this->input->post('email', TRUE));
        $phone             = $this->input->post('phone', TRUE);
        $designation       = $this->input->post('designation', TRUE);
        $employee_no       = $this->input->post('employee_no', TRUE);
        $vehicle_no        = $this->input->post('vehicle_no', TRUE);
        $password          = $this->input->post('password', TRUE);

        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', array('is_unique' => 'This %s already exists.'));
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('employee_no', 'Employee No', 'trim|required');
        $this->form_validation->set_rules('vehicle_no', 'Vehicle No', 'trim|required');
        $this->form_validation->set_rules('password', "Password", 'required|min_length[5]|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', "Password Confirm", 'required');

        if ($this->form_validation->run() == FALSE){
            $data['css'] = array('assets/css/imageupload.css');
            $data['js'] = array('assets/js/imageupload.js', 'assets/js/validate.js', 'assets/js/app.js');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/add_technician');
            $this->load->view('footer', $data);
        }else{
            if(isset($_FILES['avatar'])){
                $config['upload_path']          = './uploads/profile/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 300;
                $config['max_width']            = 2000;
                $config['max_height']           = 2000;
                $config['encrypt_name']         = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('avatar')){
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect("admin/technician_list", 'refresh');
                }else{
                    $identity =  $email;
                    $additional_data = array(
                        'full_name'     => $full_name,
                        'avatar'        => $this->upload->data()['file_name'],
                        'phone'         => $phone,
                        'designation'   => $designation,
                        'employee_no'   => $employee_no,
                        'vehicle_no'    => $vehicle_no,
                        'employee_no'   => $employee_no
                    );
                    $this->ion_auth->register($identity, $password, $email, $additional_data);
                    $this->session->set_flashdata('success','Technician has been added successfully!!!');
                    redirect("admin/technician_list", 'refresh');
                }
            }else{
                $identity =  $email;
                $additional_data = array(
                    'full_name'     => $full_name,
                    'avatar'        => "default.png",
                    'phone'         => $phone,
                    'designation'   => $designation,
                    'employee_no'   => $employee_no,
                    'vehicle_no'    => $vehicle_no,
                    'employee_no'   => $employee_no
                );
                $this->ion_auth->register($identity, $password, $email, $additional_data);
                $this->session->set_flashdata('success','Technician has been added successfully!!!');
                redirect("admin/technician_list", 'refresh');
            }
        }

    }

    public function get_technician_by_id($id){
        $data["technician"] = $this->Technician_model->get_technician_by_id($this->hasher->decrypt($id));
        $data['css'] = array('assets/css/imageupload.css');
        $data['js'] = array('assets/js/imageupload.js', 'assets/js/app.js');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/update_technician');
        $this->load->view('footer', $data);
    }
    
    public function update_technician(){

        $full_name         = $this->input->post('full_name', TRUE);
        $email             = strtolower($this->input->post('email', TRUE));
        $phone             = $this->input->post('phone', TRUE);
        $designation       = $this->input->post('designation', TRUE);
        $employee_no       = $this->input->post('employee_no', TRUE);
        $vehicle_no        = $this->input->post('vehicle_no', TRUE);
        $active            =  ($this->input->post('active', TRUE) == "on")? "1" : "0";
        $id    = $this->input->post('id', TRUE);
        $user = $this->ion_auth->user($this->hasher->decrypt($id))->row();
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('employee_no', 'Employee No', 'trim|required');
        $this->form_validation->set_rules('vehicle_no', 'Vehicle No', 'trim|required');

        // if ($this->input->post('email')){
        //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', array('is_unique' => 'This %s already exists.'));
        // }

        if ($this->input->post('password')){
            $this->form_validation->set_rules('password', "Password", 'required|min_length[5]|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', "Password Confirm", 'required');
        }

        if ($this->form_validation->run() == FALSE){
            $this->get_technician_by_id($id);
        }else{
            if($_FILES['avatar']['name'] != ""){
                $config['upload_path']          = './uploads/profile/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 300;
                $config['max_width']            = 2000;
                $config['max_height']           = 2000;
                $config['encrypt_name']         = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('avatar')){
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    //redirect("admin/technician_list", 'refresh');
                    $this->get_technician_by_id($id);
                }else{
                    $this->db->where('id', $this->hasher->decrypt($id));
                    $result = $this->db->get('users');
                    $image = $result->row()->avatar;
                    if (file_exists('./uploads/profile/'.$image)){
                       if($image != "default.png"){
                          unlink('./uploads/profile/'.$image);
                        }
                    }

                    $data = array(
                        'full_name'     => $full_name,
                        'avatar'        => $this->upload->data()['file_name'],
                        'phone'         => $phone,
                        'designation'   => $designation,
                        'employee_no'   => $employee_no,
                        'vehicle_no'    => $vehicle_no,
                        'employee_no'   => $employee_no,
                        'active'        => $active
                    );

                    if ($this->input->post('password')){
                        $data['password'] = $this->input->post('password');
                    }

                    // if($this->ion_auth->update($user->id, $data)){
                    //     $this->session->set_flashdata('success','Technician has been updated successfully!!!');
                    //     redirect("admin/technician_list", 'refresh');
                    // }

                }
                
            }else{
                $data = array(
                    'full_name'     => $full_name,
                    'phone'         => $phone,
                    'designation'   => $designation,
                    'employee_no'   => $employee_no,
                    'vehicle_no'    => $vehicle_no,
                    'employee_no'   => $employee_no,
                    'active'        => $active
                );

                if ($this->input->post('password')){
                    $data['password'] = $this->input->post('password');
                }

                if($this->ion_auth->update($user->id, $data)){
                    $this->session->set_flashdata('success','Technician has been updated successfully!!!');
                    redirect("admin/technician_list", 'refresh');
                }

            }
        }


    }

    public function client_list(){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/dialog.css',
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/dialog.js',
            'assets/js/app.js',
        );

        $this->load->view('admin/header', $data);
        $this->load->view('admin/client', $data);
        $this->load->view('footer', $data);
    }

    public function add_client(){
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('contact_general', 'Contact general', 'trim|required');
        $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('contact_mob', 'Contact(mob)', 'trim|required');
        $this->form_validation->set_rules('contact_fixed', 'Contact(fixed)', 'trim|required');
        $this->form_validation->set_rules('ext', 'ext', 'trim|required');
        $this->form_validation->set_rules('vat_no', 'Vat No', 'trim|required');
        $this->form_validation->set_rules('svat_no', 'SVAT No', 'trim|required');
        $this->form_validation->set_rules('web', 'Web', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            $data['js'] = array('assets/js/validate.js', 'assets/js/app.js');
            $this->load->view('admin/header');
            $this->load->view('admin/add_client');
            $this->load->view('footer', $data);    
        }else{
            $form_data['company_name']      = $this->input->post('company_name', TRUE);
            $form_data['address']           = $this->input->post('address', TRUE);
            $form_data['contact_general']   = $this->input->post('contact_general', TRUE);
            $form_data['contact_person']    = $this->input->post('contact_person', TRUE);
            $form_data['designation']       = $this->input->post('designation', TRUE);
            $form_data['contact_mob']       = $this->input->post('contact_mob', TRUE);
            $form_data['contact_fixed']     = $this->input->post('contact_fixed', TRUE);
            $form_data['ext']               = $this->input->post('ext', TRUE);
            $form_data['vat_no']            = $this->input->post('vat_no', TRUE);
            $form_data['svat_no']           = $this->input->post('svat_no', TRUE);
            $form_data['web']               = $this->input->post('web', TRUE);
            $form_data['email']             = $this->input->post('email', TRUE);
            $form_data['location']          = $this->input->post('location', TRUE);
            $form_data['remarks']           = $this->input->post('remarks', TRUE);
            $this->Client_model->add_client($form_data);
            $this->session->set_flashdata('success','Client has been added successfully!!!');
            redirect('admin/client_list', 'refresh');
        }
    }

    public function get_client_by_id($id){
        $data["client"] = $this->Client_model->get_client_by_id($this->hasher->decrypt($id));
        $this->load->view('admin/header');
        $this->load->view('admin/update_client', $data);
        $this->load->view('footer');

    }

    public function update_client(){
        $id   =  $this->hasher->decrypt($this->input->post('id', TRUE));

        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('contact_general', 'Contact general', 'trim|required');
        $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('contact_mob', 'Contact(mob)', 'trim|required');
        $this->form_validation->set_rules('contact_fixed', 'Contact(fixed)', 'trim|required');
        $this->form_validation->set_rules('ext', 'ext', 'trim|required');
        $this->form_validation->set_rules('vat_no', 'Vat No', 'trim|required');
        $this->form_validation->set_rules('svat_no', 'SVAT No', 'trim|required');
        $this->form_validation->set_rules('web', 'Web', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            $this->get_client_by_id($this->input->post('id', TRUE));
        }else{
            $form_data['company_name']      = $this->input->post('company_name', TRUE);
            $form_data['address']           = $this->input->post('address', TRUE);
            $form_data['contact_general']   = $this->input->post('contact_general', TRUE);
            $form_data['contact_person']    = $this->input->post('contact_person', TRUE);
            $form_data['designation']       = $this->input->post('designation', TRUE);
            $form_data['contact_mob']       = $this->input->post('contact_mob', TRUE);
            $form_data['contact_fixed']     = $this->input->post('contact_fixed', TRUE);
            $form_data['ext']               = $this->input->post('ext', TRUE);
            $form_data['vat_no']            = $this->input->post('vat_no', TRUE);
            $form_data['svat_no']           = $this->input->post('svat_no', TRUE);
            $form_data['web']               = $this->input->post('web', TRUE);
            $form_data['email']             = $this->input->post('email', TRUE);
            $form_data['location']          = $this->input->post('location', TRUE);
            $form_data['remarks']           = $this->input->post('remarks', TRUE);

            $this->Client_model->update_client($form_data, $id);
            $this->session->set_flashdata('success','Client has been updated successfully!!!');
            redirect('admin/client_list', 'refresh');
        }
    }

    public function add_job(){

        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
        $this->form_validation->set_rules('model_no', 'Model No', 'trim|required');
        $this->form_validation->set_rules('serial_no', 'Serial No', 'trim|required');
        $this->form_validation->set_rules('sales_person', 'Sales Person', 'trim|required');
        $this->form_validation->set_rules('estimate_charges', 'Estimate Charges', 'trim|required');
        $this->form_validation->set_rules('assigned[]', 'Assigned To', 'trim|required', array('required' => 'Please select at least one user.'));
        if ($this->form_validation->run() == FALSE){
            $data['css'] = array(
                'assets/css/datepicker.css'
            );
            $data['js'] = array(
                'assets/js/datepicker.js',
                'assets/js/app.js',
            );
            $data["clients"]    = $this->Client_model->get_client();
            $data['technicians'] = $this->ion_auth->users(array('technician'))->result(); 
            $this->load->view('admin/header', $data);
            $this->load->view('admin/add_job', $data);
            $this->load->view('footer', $data);
        }else{
            $form_data['company']            = $this->input->post('company', TRUE);
            $form_data['start_date']         = $this->input->post('start_date', TRUE);
            $form_data['end_date']           = $this->input->post('end_date', TRUE);
            $form_data['job_category']       = $this->input->post('job_category', TRUE);
            $form_data['client_id']          = $this->input->post('client_id', TRUE);
            $form_data['service_type']       = ($this->input->post('service_type', TRUE) != "service_type_other") ? $this->input->post('service_type', TRUE) :  $this->input->post('service_type_other_custom', TRUE);
            $form_data['job_type']           = $this->input->post('job_type', TRUE);
            $form_data['product_type']       = ($this->input->post('product_type', TRUE) != "product_type_other") ? $this->input->post('product_type', TRUE) :  $this->input->post('product_type_other_custom', TRUE);
            $form_data['brand']              = ($this->input->post('brand', TRUE) != "brand_other") ? $this->input->post('brand', TRUE) :  $this->input->post('brand_other_custom', TRUE);
            $form_data['fault_description']  = ($this->input->post('fault_description', TRUE) != "fault_description_other") ? $this->input->post('fault_description', TRUE) :  $this->input->post('fault_description_other_custom', TRUE);
            $form_data['accessories']        = ($this->input->post('accessories', TRUE) != "accessories_other") ? $this->input->post('accessories', TRUE) :  $this->input->post('accessories_other_custom', TRUE);
            $form_data['model_no']           = $this->input->post('model_no', TRUE);
            $form_data['serial_no']          = $this->input->post('serial_no', TRUE);
            $form_data['status']             = $this->input->post('status', TRUE);
            $form_data['sales_person']       = $this->input->post('sales_person', TRUE);
            $form_data['remarks']            = $this->input->post('remarks', TRUE);
            $form_data['estimate_charges']   = $this->input->post('estimate_charges', TRUE);
            $job_id =  $this->Jobs_model->add_jobs($form_data);

            foreach ($this->input->post('assigned', TRUE) as $key => $user_id) {
                $form_data_rel['users_id']    = $user_id;
                $form_data_rel['jobs_id']     =  $job_id;
                $this->db->insert('jobs_relation', $form_data_rel);
            }

            $this->session->set_flashdata('success','Job has been created successfully!!!');
            redirect('admin/job_list', 'refresh');

        }
 
    }

    public function get_job_by_id($id){
        $data['css'] = array(
            'assets/css/datepicker.css'
        );
        $data['js'] = array(
            'assets/js/datepicker.js',
            'assets/js/app.js',
        );
        $data["job"]         = $this->Jobs_model->get_jobs_by_id($this->hasher->decrypt($id));
        $data["assigned_technician"]         = $this->Technician_model->get_assigned_technician_by_job_id($this->hasher->decrypt($id));
        $data['technicians'] = $this->ion_auth->users(array('technician'))->result(); 
        $data["clients"]    = $this->Client_model->get_client();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/update_job', $data);
        $this->load->view('footer', $data);
    }

    public function update_job(){

        $job_id =  $this->hasher->decrypt($this->input->post('update_id', TRUE));

        $assigned_user_id = $this->input->post('assigned', TRUE);
            
        $this->db->select("jobs_relation_id,jobs_id,users_id");
        $this->db->from("jobs_relation");
        $this->db->where("jobs_id",$job_id); 
        $query = $this->db->get();
        $result = $query->result_array();
        $al_ready_user = [];
        if($result){
            foreach ($result as $key => $value) { 
                $al_ready_user[] = $value['users_id'];
                if(!in_array($value['users_id'],$assigned_user_id)){
                    $this->db->delete("jobs_relation",array("jobs_relation_id"=>$value['jobs_relation_id']));
                }
            }
        }
        foreach ($assigned_user_id as $k => $val) {
            if(!in_array($val, $al_ready_user)){
                $form_datax = array(
                    "jobs_id"    =>  $job_id,
                    "users_id"   =>  $val,
                ); 
                $this->db->insert('jobs_relation', $form_datax);
            }
        }

        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
        $this->form_validation->set_rules('model_no', 'Model No', 'trim|required');
        $this->form_validation->set_rules('serial_no', 'Serial No', 'trim|required');
        $this->form_validation->set_rules('sales_person', 'Sales Person', 'trim|required');
        $this->form_validation->set_rules('estimate_charges', 'Estimate Charges', 'trim|required');
        $this->form_validation->set_rules('assigned[]', 'Assigned To', 'trim|required', array('required' => 'Please select at least one user.'));

        if ($this->form_validation->run() == FALSE){
            $data['css'] = array(
                'assets/css/datepicker.css'
            );
            $data['js'] = array(
                'assets/js/datepicker.js',
                'assets/js/app.js',
            );
            $data["job"]         = $this->Jobs_model->get_jobs_by_id($job_id);
            $data["assigned_technician"]         = $this->Technician_model->get_assigned_technician_by_job_id($job_id);
            $data['technicians'] = $this->ion_auth->users(array('technician'))->result(); 
            $data["clients"]    = $this->Client_model->get_client();
    
            $this->load->view('admin/header', $data);
            $this->load->view('admin/update_job', $data);
            $this->load->view('footer', $data);
        }else{
            $form_data['company']            = $this->input->post('company', TRUE);
            $form_data['start_date']         = $this->input->post('start_date', TRUE);
            $form_data['end_date']           = $this->input->post('end_date', TRUE);
            $form_data['job_category']       = $this->input->post('job_category', TRUE);
            $form_data['client_id']          = $this->input->post('client_id', TRUE);
            $form_data['service_type']       = ($this->input->post('service_type', TRUE) != "service_type_other") ? $this->input->post('service_type', TRUE) :  $this->input->post('service_type_other_custom', TRUE);
            $form_data['job_type']           = $this->input->post('job_type', TRUE);
            $form_data['product_type']       = ($this->input->post('product_type', TRUE) != "product_type_other") ? $this->input->post('product_type', TRUE) :  $this->input->post('product_type_other_custom', TRUE);
            $form_data['brand']              = ($this->input->post('brand', TRUE) != "brand_other") ? $this->input->post('brand', TRUE) :  $this->input->post('brand_other_custom', TRUE);
            $form_data['fault_description']  = ($this->input->post('fault_description', TRUE) != "fault_description_other") ? $this->input->post('fault_description', TRUE) :  $this->input->post('fault_description_other_custom', TRUE);
            $form_data['accessories']        = ($this->input->post('accessories', TRUE) != "accessories_other") ? $this->input->post('accessories', TRUE) :  $this->input->post('accessories_other_custom', TRUE);
            $form_data['model_no']           = $this->input->post('model_no', TRUE);
            $form_data['serial_no']          = $this->input->post('serial_no', TRUE);
            $form_data['status']             = $this->input->post('status', TRUE);
            $form_data['sales_person']       = $this->input->post('sales_person', TRUE);
            $form_data['remarks']            = $this->input->post('remarks', TRUE);   
            $form_data['estimate_charges']   = $this->input->post('estimate_charges', TRUE); 
            $this->Jobs_model->update_jobs($job_id, $form_data);  
            $this->session->set_flashdata('success','Job has been updated successfully!!!');
            redirect('admin/job_list', 'refresh');      
        }
    }

    public function global_settings(){
        $this->load->view('admin/header');
        $this->load->view('admin/global_settings');
        $this->load->view('footer');
    }
    
    public function change_status($project_id, $status){
        $form_data['status'] =  $status;
        $this->Jobs_model->update_status($project_id, $form_data);
        redirect('admin/job_list', 'refresh');
    }

    public function job_calendar(){
        $data['css'] = array(
            'assets/css/fullcalendar.css'
        );
        $data['js'] = array(
            'assets/js/moment.min.js',
            'assets/js/fullcalendar.js',
            'assets/js/calendar.js',
        );
        $this->load->view('admin/header',  $data);
        $this->load->view('admin/job_calendar');
        $this->load->view('footer',  $data);
    }

    public function clone_job($job_id){
        $this->Jobs_model->clone_job($this->hasher->decrypt($job_id));
        $this->session->set_flashdata('success','Job has been cloned successfully!!!');
        redirect('admin/job_list', 'refresh');
    }

    public function estimates_list(){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/datepicker.css',
            'assets/css/dialog.css'
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/datepicker.js',
            'assets/js/dialog.js',
            'assets/js/app.js'
        );

        $this->load->view('admin/header', $data);
        $this->load->view('admin/estimates');
        $this->load->view('footer', $data);
    }

    public function add_estimates(){

        $this->form_validation->set_rules('estimate_no', 'Estimate  No', 'trim|required');
        $this->form_validation->set_rules('estimate_date', 'Estimate Date', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            $data['css'] = array(
                'assets/css/select2.css',
                'assets/calculator/SimpleCalculadorajQuery.css',
                'assets/css/jquery.datetimepicker.css'
            );
    
            $data['js'] = array(
                'assets/js/jquery.datetimepicker.js',
                'assets/calculator/SimpleCalculadorajQuery.js',
                'assets/js/select2.js',
                'assets/js/app.js'
            );
            $data["jobs"] = $this->Jobs_model->get_jobs();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/add_estimates', $data);
            $this->load->view('footer', $data);
        }else{
            $form_data['company']        = $this->input->post('company', TRUE);
            $form_data['estimate_no']    = $this->input->post('estimate_no', TRUE);
            $form_data['estimate_date']  =  $this->input->post('estimate_date', TRUE);
            $form_data['job_no']         =  $this->input->post('job_no', TRUE);
            $form_data['tax']            =  ($this->input->post('tax', TRUE)) ? $this->input->post('tax', TRUE) : "0";
            $form_data['total_amount']   =  ($this->input->post('total_amount', TRUE)) ? $this->input->post('total_amount', TRUE) : "0" ;
            $form_data['srcharges']      =  ($this->input->post('srcharges', TRUE)) ? $this->input->post('srcharges', TRUE) : "0" ;

            $return_id = $this->Estimates_model->add_estimates($form_data);

            $part_no        =  $this->input->post('part_no', TRUE);
            $description    =  $this->input->post('description', TRUE);
            $unit_price     =  $this->input->post('unit_price', TRUE);
            $quantity       =  $this->input->post('quantity', TRUE);
            $discount       =  ($this->input->post('discount', TRUE)) ? $this->input->post('discount', TRUE) : "0"  ;
            $price          =  $this->input->post('price', TRUE);

            if(!empty($part_no)){
                foreach($part_no as $key => $k ) {
                    $form_data2 = array(
                        'estimates_id' => $return_id,
                        'part_no'      => $k,
                        'description'  =>  $description[$key],
                        'unit_price'   =>  $unit_price[$key],
                        'quantity'     =>  $quantity[$key],
                        'discount'     =>  $discount[$key],
                        'price'        =>  $price[$key]
                    );
                    $this->db->insert('estimates_data', $form_data2);
                }
            }
            $this->session->set_flashdata('success','Estimate has been created successfully!!!');
            redirect('admin/estimates_list', 'refresh');
        }
    }

    public function job_details($job_id){
        $data["job"] = $this->Jobs_model->get_job_details($this->hasher->decrypt($job_id));
        $this->load->view('admin/header');
        $this->load->view('admin/job_details', $data);
        $this->load->view('footer');
    }

    public function attendance_list(){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/datepicker.css',
            'assets/css/dialog.css'
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/dialog.js',
            'assets/js/datepicker.js',
            'assets/js/app.js'
        );

        $data['technicians'] = $this->ion_auth->users(array('technician'))->result(); 
        $this->load->view('admin/header', $data);
        $this->load->view('admin/attendance');
        $this->load->view('footer', $data);
    }

    public function update_attendance($attendance_id){
        $data['css'] = array(
            'assets/css/jquery.datetimepicker.css',
            'assets/css/dialog.css'
        );
        $data['js'] = array(
            'assets/js/jquery.datetimepicker.js',
            'assets/js/app.js'
        );
        $data['attendance_id'] = $attendance_id;
        $data["attendance"] = $this->Attendance_model->get_attendance_by_id($this->hasher->decrypt($attendance_id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/update_attendance', $data);
        $this->load->view('footer', $data);
    }
    
    public function save_attendance(){
        $in_time  = $this->input->post('in_time', TRUE);
        $out_time  = $this->input->post('out_time', TRUE);
        $attendance_id  = $this->input->post('attendance_id', TRUE);

        $this->form_validation->set_rules('in_time', 'In Time', 'required');
        $this->form_validation->set_rules('out_time', 'Out Time', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->update_attendance($attendance_id);
        }else{
            $form_data['in_time']    = $in_time;     
            $form_data['out_time']   = $out_time;         
            $this->Attendance_model->update_attendance($this->hasher->decrypt($attendance_id), $form_data);
            $this->session->set_flashdata('success','Your attendance has been marked!!!');
            redirect('admin/attendance_list', 'refresh');
        }

    }

    public function attendance_chart(){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/dialog.css'
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/dataTables.fixedColumns.min.js',
            'assets/js/moment.min.js',
            'assets/js/app.js'
        );
        $data['technicians'] = $this->ion_auth->users(array('technician'))->result(); 
        $this->load->view('admin/header', $data);
        $this->load->view('admin/attendance_chart', $data);
        $this->load->view('footer', $data);
    }

    public function update_estimate($estimate_id){
        $data['css'] = array(
            'assets/css/select2.css',
            'assets/css/jquery.datetimepicker.css'
        );

        $data['js'] = array(
            'assets/js/jquery.datetimepicker.js',
            'assets/js/select2.js',
            'assets/js/app.js'
        );

        $data["jobs"]           = $this->Jobs_model->get_jobs();
        $data["estimate"]       = $this->Estimates_model->get_estimates_by_id($this->hasher->decrypt($estimate_id));
        $data["estimates_data"] = $this->Estimates_model->get_estimates_data_by_id($this->hasher->decrypt($estimate_id));
        $this->load->view('admin/header', $data);
        $this->load->view('admin/update_estimates', $data);
        $this->load->view('footer', $data);
    }

    public function save_estimates(){
        $estimate_id  = $this->input->post('update_id', TRUE);

        $this->form_validation->set_rules('estimate_no', 'Estimate  No', 'trim|required');
        $this->form_validation->set_rules('estimate_date', 'Estimate Date', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            redirect('admin/update_estimate/'.$estimate_id, 'refresh');
        }else{
            $this->db->where('estimates_id', $this->hasher->decrypt($estimate_id));
            $query = $this->db->get('estimates_data');
            $result = $query->result_array();
            $data_insert_array=[];
            if($result){
                foreach ($result as $key => $value) { 
                    $part_no =  $this->input->post($value['estimates_data_id'].'_part_no', TRUE);
                    if(isset($part_no)){
                        $description    =  $this->input->post($value['estimates_data_id'].'_description', TRUE);
                        $unit_price     =  $this->input->post($value['estimates_data_id'].'_unit_price', TRUE);
                        $quantity       =  $this->input->post($value['estimates_data_id'].'_quantity', TRUE);
                        $discount       =  ($this->input->post($value['estimates_data_id'].'_discount', TRUE)) ? $this->input->post($value['estimates_data_id'].'_discount', TRUE) : "0"  ;
                        $price          =  $this->input->post($value['estimates_data_id'].'_price', TRUE);
                        $form_data2 = array(
                            'estimates_id' => $this->hasher->decrypt($estimate_id),
                            'part_no'      => $part_no,
                            'description'  =>  $description,
                            'unit_price'   =>  $unit_price,
                            'quantity'     =>  $quantity,
                            'discount'     =>  $discount,
                            'price'        =>  $price,
                        );
                        $this->db->where('estimates_data_id',$value['estimates_data_id']);
                        $this->db->where('estimates_id', $this->hasher->decrypt($estimate_id));
                        $this->db->update('estimates_data', $form_data2);
                        
                    }
                }
                $part_no_new        =  $this->input->post('part_no', TRUE);
                $description_new    =  $this->input->post('description', TRUE);
                $unit_price_new     =  $this->input->post('unit_price', TRUE);
                $quantity_new       =  $this->input->post('quantity', TRUE);
                $discount_new       =  ($this->input->post('discount', TRUE)) ? $this->input->post('discount', TRUE) : "0"  ;
                $price_new          =  $this->input->post('price', TRUE);
                if(isset($part_no_new) && isset($price_new)){
                    foreach($part_no_new as $key => $val){
                        $form_data3 = array(
                        'estimates_id' => $this->hasher->decrypt($estimate_id),
                        'part_no'      => $part_no_new[$key],
                        'description'  =>  $description_new[$key],
                        'unit_price'   =>  $unit_price_new[$key],
                        'quantity'     =>  $quantity_new[$key],
                        'discount'     =>  $discount_new[$key],
                        'price'        =>  $price_new[$key]
                    );
                        if( $part_no_new[$key] !=""){
                            $this->db->insert('estimates_data', $form_data3);
                        }
                    
                    }
                    
                }

            }
    
            $form_data4['company']        = $this->input->post('company', TRUE);
            $form_data4['estimate_no']    = $this->input->post('estimate_no', TRUE);
            $form_data4['estimate_date']  =  $this->input->post('estimate_date', TRUE);
            $form_data4['job_no']         =  $this->input->post('job_no', TRUE);
            $form_data4['tax']            =  ($this->input->post('tax', TRUE)) ? $this->input->post('tax', TRUE) : "0";
            $form_data4['total_amount']   =  ($this->input->post('total_amount', TRUE)) ? $this->input->post('total_amount', TRUE) : "0" ;
            $form_data4['srcharges']      =  ($this->input->post('srcharges', TRUE)) ? $this->input->post('srcharges', TRUE) : "0";

            $this->Estimates_model->update_estimates($this->hasher->decrypt($estimate_id), $form_data4);

            $this->session->set_flashdata('success','Estimate has been updated successfully!!!');
            redirect('admin/estimates_list', 'refresh');

        }
    }

    public function download_estimate($estimate_id){
        $data["estimate"]  = $this->Estimates_model->get_estimates_by_id($this->hasher->decrypt($estimate_id));
        $data["estimate_data"] = $this->Estimates_model->get_estimates_data_by_id($this->hasher->decrypt($estimate_id));
        $viewfile = $this->load->view('admin/estimate_download', $data, TRUE);
        $this->load->helper('dompdf');
        $date = date('Y_m_d');
        pdf_create($viewfile, "Estimate_".$date, 1, 1);
    }

    public function job_progress(){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/datepicker.css',
            'assets/css/select2.css',
            'assets/css/dialog.css'
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/datepicker.js',
            'assets/js/dialog.js',
            'assets/js/select2.js',
            'assets/js/app.js'
        );
        $data["jobs"]      = $this->Jobs_model->get_jobs();
        $data["estimates"] = $this->Estimates_model->get_estimates();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/job_progress', $data);
        $this->load->view('footer', $data);
    }

    public function change_progress_status($progress_id, $status){
        $form_data['status'] =  rawurldecode($status);
        $this->Progress_model->update_status($progress_id, $form_data);
        redirect('admin/job_progress', 'refresh');
    }

    public function update_progress_report($progress_id){
        $data['css'] = array(
            'assets/css/jquery.dataTables.min.css',
            'assets/css/responsive.dataTables.min.css',
            'assets/css/datepicker.css',
            'assets/css/select2.css',
            'assets/css/dialog.css'
        );
        $data['js'] = array(
            'assets/js/jquery.dataTables.min.js',
            'assets/js/responsive.dataTables.min.js',
            'assets/js/datepicker.js',
            'assets/js/dialog.js',
            'assets/js/select2.js',
            'assets/js/app.js'
        );
        $data["jobs"]      = $this->Jobs_model->get_jobs();
        $data["estimates"] = $this->Estimates_model->get_estimates();
        $data["progress"]  = $this->Progress_model->get_progress_by_id($this->hasher->decrypt($progress_id));

        $this->load->view('admin/header', $data);
        $this->load->view('admin/update_progress_report', $data);
        $this->load->view('footer', $data);
    }

    public function save_progress_report(){
        $progress_id = $this->input->post('id', TRUE);

        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('estimate_value', 'Estimate Value', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            $this->update_progress_report($progress_id);
        }else{
            $form_data['estimate_date']     = $this->input->post('date', TRUE);
            $form_data['estimate_value']    = $this->input->post('estimate_value', TRUE);
            $form_data['job_no']            = $this->input->post('job_no', TRUE);
            $form_data['status']            = $this->input->post('status', TRUE);
            $form_data['estimate_no']       = $this->input->post('estimate_no', TRUE);
            $this->Progress_model->update_status($this->hasher->decrypt($progress_id), $form_data);
            $this->session->set_flashdata('success','Progress report has been updated successfully!!!');
            redirect('admin/job_progress', 'refresh');
        }

    }
    
    public function estimate_report(){
        $data['css'] = array(
            'assets/css/morris.css'
        );
        $data['js'] = array(
            'assets/js/raphael.min.js',
            'assets/js/morris.min.js',
            'assets/js/app_report.js'
        );
        $this->load->view('admin/header', $data);
        $this->load->view('admin/estimate_report');
        $this->load->view('footer', $data);
    }

    public function job_report(){
        $data['js'] = array(
            'assets/js/app.js'
        );
        $this->load->view('admin/header');
        $this->load->view('admin/job_report');
        $this->load->view('footer', $data);
    }

    public function generate_job_report(){
        $data['report_term']= $this->input->post('report_term');
        $data['reports'] = $this->Report_model->generate_job_report();
        $viewfile = $this->load->view('admin/job_download', $data, TRUE);
        $this->load->helper('dompdf');
        $date = date('Y_m_d');
        pdf_create($viewfile, "Job_Report".$date, 1, 1);

    }

    public function technician_report(){
        $data['css'] = array(
            'assets/css/select2.css'
        );

        $data['js'] = array(
            'assets/js/select2.js',
            'assets/js/app.js'
        );

        $data['technicians'] = $this->ion_auth->users(array('technician'))->result(); 
        $this->load->view('admin/header', $data);
        $this->load->view('admin/technician_report', $data);
        $this->load->view('footer', $data);
    }

    public function generate_technician_report(){
        $data['report_term']= $this->input->post('report_term');
        $data["technician"] = $this->ion_auth->user($this->input->post('technician'))->row();
        $data['reports'] = $this->Report_model->generate_technician_report();
        $viewfile = $this->load->view('admin/technician_download', $data, TRUE);
        $this->load->helper('dompdf');
        $date = date('Y_m_d');
        pdf_create($viewfile, "Technician_Report_".$date, 1, 1);
    }

    public function single_job_download($job_id){
        $data["job"] = $this->Jobs_model->get_job_details($this->hasher->decrypt($job_id));
        $viewfile = $this->load->view('admin/single_job_download', $data, TRUE);
        $this->load->helper('dompdf');
        $date = date('Y_m_d');
        pdf_create($viewfile, "Job_".$date, 1, 1);
    }

    public function access_only_admin(){
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
            return true;
        }else{
            $this->session->set_flashdata('message', "You must be an administrator to view this page");
            redirect('auth/login');
        }
    }
}