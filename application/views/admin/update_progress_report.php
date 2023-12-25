<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Progress Report</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/client_list"><span>Client</span></a></li>
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
                            <h6 class="panel-title txt-dark">Update Progress Report</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                        <?php $attr = array("class" => "form-horizontal");?>
							<?php echo form_open('admin/save_progress_report', $attr);?>
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="job_no">Job No:</label>
                                    <div class="col-sm-8">
                                        <select name="job_no" id="job_no" class="form-control selectJobId">
                                            <?php foreach($jobs as $job): ?>
                                            <?php
                                                if($progress->job_no == $job->job_id){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option  <?php echo $selected; ?> value="<?=$job->job_id;?>"><?=$job->job_id;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>    

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="status">Status:</label>
                                    <div class="col-sm-8">
                                    <?php
                                        $statusList = array(
                                            0 => 'In process',
                                            1 => 'Waiting for Approval',
                                            2 => 'Pending Repair',
                                            3 => 'Pending estimate',
                                            4 => 'Waiting for payment',
                                            5 => 'Ready for Collection',
                                            6 => 'Waiting for delivery',
                                            7 => 'Not Approved',
                                            8 => 'Out for delivery'
                                        );
                                    ?>
                                        <select name="status" id="status" class="form-control">
                                            <?php foreach($statusList as $key => $value):?>
                                            <?php
                                                if($value == $progress->status){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option <?php echo $selected; ?> value="<?=$value;?>"><?=$value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>    



                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="estimate_no">Estimate No:</label>
                                    <div class="col-sm-8">
                                        <select name="estimate_no" id="estimate_no" class="form-control selectJobId">
                                            <?php foreach($estimates as $estimate): ?>
                                            <?php
                                                if($progress->estimate_no == $estimate->estimate_no){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option  <?php echo $selected; ?> value="<?=$estimate->estimate_no;?>"><?=$estimate->estimate_no;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="date">Estimate Date :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="date" name="date" value="<?php echo $progress->estimate_date;?>">
                                        <?php echo form_error('date'); ?>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="estimate_value">Estimate Value(LKR) :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="estimate_value" name="estimate_value" value="<?php echo $progress->estimate_value;?>">
                                        <input type="hidden"  name="id" value="<?php echo  $this->hasher->encrypt($progress->progress_id);?>">
                                        <?php echo form_error('estimate_value'); ?>
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