<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Technicians Report</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/client_list"><span>Technicians</span></a></li>
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
                            <h6 class="panel-title txt-dark">Technicians Report</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                           <div class="form-wrap">
						    	<?php echo form_open('admin/generate_technician_report');?>
                                     <div class="form-group mr-15">
                                        <label class="control-label mr-10" for="technician">Technician:</label>
                                        <select name="technician" id="technician" class="form-control selectJobId">
                                            <?php foreach($technicians as $technician): ?>
                                            <option value="<?=$technician->id;?>"><?=$technician->full_name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group mr-15">
                                        <label class="control-label mr-10" for="report_term">Report Term:</label>
                                        <select class="form-control" name="report_term" id="report_term">
                                            <option value="daily">Daily</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Generate</button>
                                <?php echo form_close();?> 
							</div>
                        </div>
                    </div>
                </div>	
            </div>
		</div>
		<?php $this->load->view('footer_copyright'); ?>
	</div>
</div>