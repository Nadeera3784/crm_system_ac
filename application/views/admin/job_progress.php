<style>
.datepicker {
    z-index: 11111;
}
</style>
<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Job Progress</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
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
                            <h6 class="panel-title txt-dark">Progress</h6>
                        </div>
                        <div class="pull-right">
                           <button type="button" class="btn btn-sm btn-primary shadow shadow--big" data-toggle="modal" data-target="#progressReportModal" data-backdrop="static">New</button>
                           <button type="button" class="btn btn-sm btn-default" data-toggle="collapse" data-target="#filterElement" aria-expanded="false" aria-controls="filterElement">Filter</button>
                           <div id="progressReportModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title" id="myModalLabel">New Progress Report</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form  id="progressReportForm">
                                                        <div class="form-group">
                                                            <div id="errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="control-label" for="job_no">Job No:</label>
                                                            <select name="job_no" id="job_no" class="form-control selectJobId">
                                                                <?php foreach($jobs as $job): ?>
                                                                <option value="<?=$job->job_id;?>"><?=$job->job_id;?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="control-label" for="status">Status:</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="In process">In process</option>
                                                                <option value="Waiting for Approval">Waiting for Approval</option>
                                                                <option value="Pending Repair">Pending Repair</option>
                                                                <option value="Pending estimate">Pending estimate</option>
                                                                <option value="Waiting for payment">Waiting for payment</option>
                                                                <option value="Ready for Collection">Ready for Collection</option>
                                                                <option value="Waiting for delivery">Waiting for delivery</option>
                                                                <option value="Not Approved">Not Approved</option>
                                                                <option value="Out for delivery">Out for delivery</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="control-label" for="estimate_no">Estimate No:</label>
                                                            <select name="estimate_no" id="estimate_no" class="form-control selectJobId">
                                                                <?php foreach($estimates as $estimate): ?>
                                                                <option value="<?=$estimate->estimate_no;?>"><?=$estimate->estimate_no;?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="date">Estimate Date:</label>
                                                            <input type="text" class="form-control" name="date" id="date">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="estimate_value">Estimate Value(LKR):</label>
                                                            <input type="text" class="form-control" name="estimate_value" id="estimate_value">
                                                        </div>
												    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-primary" id="save_progress_report">Save</button>
                                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
									</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                           <div class="form-inline mb-30 collapse" id="filterElement">
                                <div class="form-group mr-15">
                                    <label class="control-label mr-10" for="job_id">Job No:</label>
                                    <select name="job_id" id="job_id" class="form-control">
                                        <option value="">---Select Job No---</option>
                                        <?php foreach($jobs as $job): ?>
                                        <option value="<?=$job->job_id;?>"><?=$job->job_id;?></option>
                                        <?php endforeach;?>
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
                                        <button type="button" name="applyProgress" id="applyProgress" class="btn btn-primary">Apply</button>
                                </div>
                                <div class="form-group mr-15">
                                        <button type="button" name="resetProgress" id="resetProgress" class="btn btn-outline btn-primary">Clear</button>
                                </div>
                                <div class="form-group">
                                        <button type="button" name="submit_booking_form" class="btn btn-default">Download</button>
                                </div>
                            </div>
                        <div class="table-wrap">
                                <table class="table mb-0" id="progressReportTable">
                                    <thead>
                                        <tr>
                                           <th>Job No</th>
                                           <th>Estimate No</th>
                                           <th>Estimate Date</th>
                                           <th>Status</th>
                                           <th>Estimate Value(LKR)</th>
                                           <th>MANAGE</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" id="totalHours"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
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