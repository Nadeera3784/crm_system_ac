<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Job</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/job_list">Job</a></li>
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
                            <h6 class="panel-title txt-dark">2334 JOB ID</h6>
                        </div>
                        <div class="pull-right">
                           <a href="<?php echo base_url();?>admin/single_job_download/<?php echo $this->hasher->encrypt($job->job_id);?>" class="btn btn-sm btn-primary shadow shadow--big">PDF</a>
						   <a href="<?php echo base_url();?>admin/get_job_by_id/<?php echo $this->hasher->encrypt($job->job_id);?>" class="btn btn-sm btn-default shadow shadow--big">Edit</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
						<table class="table  table-bordered">
							<tbody>
								<tr>
								  <td>Job ID</td>
								  <td><?php echo $job->job_id;?></td>
								</tr>
								<tr>
								  <td>Company</td>
								  <td><?php echo status_transformer($job->company);?></td>
								</tr>
								<tr>
								  <td>Start Date </td>
								  <td><?php echo $job->start_date;?></td>
								</tr>
								<tr>
								  <td>End Date </td>
								  <td><?php echo $job->end_date;?></td>
								</tr>
								<tr>
								  <td>Job Category </td>
								  <td><?php echo status_transformer($job->job_category);?></td>
								</tr>
								<tr>
								  <td>Client</td>
								  <td><?php echo $job->company_name;?></td>
								</tr>
								<tr>
								  <td>Service Type </td>
								  <td><?php echo ucfirst($job->service_type);?></td>
								</tr>
								<tr>
								  <td>Job Type </td>
								  <td><?php echo ucfirst($job->job_type);?></td>
								</tr>
								<tr>
								  <td>Product Type </td>
								  <td><?php echo ucfirst($job->product_type);?></td>
								</tr>
								<tr>
								  <td>Brand</td>
								  <td><?php echo ucfirst($job->brand);?></td>
								</tr>
								<tr>
								  <td>Model No </td>
								  <td><?php echo $job->model_no;?></td>
								</tr>
								<tr>
								  <td>Serial No </td>
								  <td><?php echo $job->serial_no;?></td>
								</tr>		
								<tr>
								  <td>Fault Description </td>
								  <td><?php echo status_transformer($job->fault_description);?></td>
								</tr>
								<tr>
								  <td>Accessories </td>
								  <td><?php echo status_transformer($job->accessories);?></td>
								</tr>
								<tr>
								  <td>Status </td>
								  <td><?php echo status_transformer($job->status) ;?></td>
								</tr>
								<tr>
								  <td>Sales Person </td>
								  <td><?php echo $job->sales_person;?></td>
								</tr>	
								<tr>
								  <td>Estimate Charges(LKR)</td>
								  <td><?php echo $job->estimate_charges;?></td>
								</tr>	
								<tr>
								  <td>Remarks  </td>
								  <td><?php echo $job->remarks ;?></td>
								</tr>																				
							</tbody>
						</table>
                        </div>
                    </div>
                </div>	
            </div>
		</div>
		<?php $this->load->view('footer_copyright'); ?>
	</div>
</div>