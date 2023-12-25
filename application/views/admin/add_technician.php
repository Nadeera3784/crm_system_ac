<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Technicians</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/technician_list">Technician</a></li>
                    <li><a href="<?=base_url();?>admin/add_technician"><span>Add Technician</span></a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
				<?php $this->load->view('notification'); ?>
                <div id="AjaxResponse"></div>
                <div class="panel panel-default border-panel card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Add Technician</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                        <?php $attr = array("class" => "form-horizontal", "id" => "add_technician_form", "novalidate" => "novalidate");?>
							<?php echo form_open_multipart('admin/add_technician', $attr);?>
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="full_name">Full Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="full_name" name="full_name" value="<?php echo $this->form_validation->set_value('full_name');?>">
                                        <?php echo form_error('full_name'); ?>
                                    </div>
                                </div>    

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="phone">Phone:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="phone" name="phone" value="<?php echo $this->form_validation->set_value('phone');?>">
                                        <?php echo form_error('phone'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="designation">Designation :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="designation" name="designation" value="<?php echo $this->form_validation->set_value('designation');?>">
                                        <?php echo form_error('designation'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="employee_no">Employee No :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="employee_no" name="employee_no" value="<?php echo $this->form_validation->set_value('employee_no');?>">
                                        <?php echo form_error('employee_no'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="vehicle_no">Vehicle No:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" value="<?php echo $this->form_validation->set_value('vehicle_no');?>">
                                        <?php echo form_error('vehicle_no'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="avatar">Avatar  :</label>
                                    <div class="col-sm-8">
                                    <div class="imageupload">
                                        <div class="file-tab" style="display: block;">
                                            <label class="btn btn-primary btn-file">
                                                <span>Browse</span>
                                                <input type="file" name="avatar">
                                            </label>
                                            <button type="button" class="btn btn-danger" style="display: none;">Delete image</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="email">Email:</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control required" id="email" name="email" value="<?php echo $this->form_validation->set_value('email');?>">
                                        <?php echo form_error('email'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="password">Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required" id="password" name="password">
                                        <?php echo form_error('password'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="password_confirm">Password Confirm:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required" id="password_confirm" name="password_confirm">
                                        <?php echo form_error('password_confirm'); ?>
                                    </div>
                                </div> 

       
                                <div class="form-group mb-0"> 
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-sm btn-primary"><span class="btn-text">Save</span></button>
                                    </div>
                                </div> 
                            <?php echo form_close();?> 
                        </div>
                    </div>
                </div>	
            </div>
		</div>
		<?php $this->load->view('footer_copyright'); ?>
	</div>
</div>