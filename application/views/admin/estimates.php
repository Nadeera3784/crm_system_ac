<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Estimates</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/estimates_list"><span>Estimates</span></a></li>
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
                            <h6 class="panel-title txt-dark">Estimates List</h6>
                        </div>
                        <div class="pull-right">
                           <a href="<?php echo base_url();?>admin/add_estimates" class="btn btn-sm btn-primary shadow shadow--big">New</a>
                           <button type="button" class="btn btn-sm btn-default" data-toggle="collapse" data-target="#filterElement" aria-expanded="false" aria-controls="filterElement">Filter</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                           <div class="form-inline mb-30 collapse" id="filterElement">
                                <div class="form-group mr-15">
                                    <label class="control-label mr-10" for="company">Company:</label>
                                    <select name="company" id="company" class="form-control required">
                                           <option value="">---Select Company ---</option>
                                            <option value="ice_technologies">ICE Technologies</option>
                                            <option value="abc_trade_investments">ABC Trade & Investments</option>
                                     </select>  
                                </div>
                                <div class="form-group mr-15">
                                    <label class="control-label mr-10" for="start_date">From:</label>
                                    <input type="text" class="form-control" id="start_date" name="start_date">
                                </div>
                                <div class="form-group mr-15">
                                    <label class="control-label mr-10" for="end_date">To:</label>
                                    <input type="text" class="form-control" id="end_date" name="end_date">
                                </div>	
                                <div class="form-group mr-15">
                                        <button type="button" name="applyEstimates" id="applyEstimates" class="btn btn-primary">Apply</button>
                                </div>
                                <div class="form-group mr-15">
                                        <button type="button" name="resetEstimates" id="resetEstimates" class="btn btn-outline btn-primary">Clear</button>
                                </div>
                                <div class="form-group">
                                        <button type="button" name="submit_booking_form" class="btn btn-default">Download</button>
                                </div>
                            </div>
                            <div class="table-wrap">
                                <table class="table mb-0" id="tableEstimates">
                                    <thead>
                                        <tr>
                                           <th>Estimate No </th>
                                           <th>Job No</th>
                                           <th>Company</th>
                                           <th>Amount(LKR)</th>
                                           <th>Date</th>
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