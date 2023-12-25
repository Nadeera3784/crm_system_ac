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
                            <h6 class="panel-title txt-dark">Job List</h6>
                        </div>
                        <div class="pull-right">
                           <a href="<?php echo base_url();?>admin/add_job" class="btn btn-sm btn-primary shadow shadow--big">New</a>
                           <button type="button" class="btn btn-sm btn-default" data-toggle="collapse" data-target="#filterElement" aria-expanded="false" aria-controls="filterElement">Filter</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                        <div class="form-inline mb-30 collapse"  id="filterElement">
                               <div class="form-group mr-15">
                                        <select name="company" id="company" class="form-control">
                                            <option value="" selected="selected">--Select Company--</option>
                                            <option value="ice_technologies">ICE Technologies</option>
                                            <option value="abc_trade_investments">ABC Trade & Investments</option>
                                        </select>
                                </div>
                                <div class="form-group ">
                                    <select name="client_id" id="client_id" class="form-control required">
                                         <option value="">---Select Client---</option>
                                           <?php foreach($clients as $client):?>
                                            <option value="<?=$client->client_id;?>"><?=$client->company_name;?></option>
                                            <?php endforeach;?>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="From">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="end_date" name="end_date"  placeholder="To">
                                </div>	
                                <div class="form-group">
                                    <select name="category" id="category" class="form-control">
                                        <option value="" selected="selected">-Select Category-</option>
                                        <option value="inhouse">In-House</option>
                                        <option value="onsite">On-Site</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <button type="button" name="apply" id="apply" class="btn btn-primary">Apply</button>
                                </div>
                                <div class="form-group">
                                        <button type="button" name="submit_booking_form" class="btn btn-default">Download</button>
                                </div>
                            </div>   
                        <div class="table-wrap">
                                <table class="table mb-0" id="tableJob">
                                    <thead>
                                        <tr>
                                           <th>Job ID</th>
                                           <th>Client</th>
                                           <th>End Date</th>
                                           <th>Assigned To</th>
                                           <th>Status</th>
                                           <th>Manage</th>
                                        </tr>
                                    </thead>

                                </table>
							</div>
                        </div>
                    </div>
                </div>	
            </div>
		</div>
		<?php $this->load->view('footer_copyright'); ?>
	</div>
</div>