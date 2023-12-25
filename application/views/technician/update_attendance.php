<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Update Attendance</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>technician/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>technician/change_password"><span>Change Password</span></a></li>
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
                            <h6 class="panel-title txt-dark">Update Attendance</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                        
                            <?php $attr = array("class" => "form-horizontal");?>
							<?php echo form_open('technician/save_attendance', $attr);?>
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="out_time">Out Time :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="out_time" name="out_time">
                                        <input type="hidden"  id="attendance_id" name="attendance_id" value="<?=$attendance_id;?>">
                                        <?php echo form_error('out_time'); ?>
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