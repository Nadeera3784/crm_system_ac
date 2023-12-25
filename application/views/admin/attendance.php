<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Attendance</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/attendance_list"><span>Attendance</span></a></li>
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
                            <h6 class="panel-title txt-dark">Attendance</h6>
                        </div>
                        <div class="pull-right">
                           <a href="<?php echo base_url();?>admin/attendance_chart" class="btn btn-sm btn-primary shadow shadow--big">Chart</a>
                           <button type="button" class="btn btn-sm btn-default" data-toggle="collapse" data-target="#filterElement" aria-expanded="false" aria-controls="filterElement">Filter</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                           <div class="form-inline mb-30 collapse" id="filterElement">
                                <div class="form-group mr-15">
                                    <label class="control-label mr-10" for="technician_id">Technician:</label>
                                    <select name="technician_id" id="technician_id" class="form-control required">
                                         <option value="">---Select Technician---</option>
                                         <?php foreach($technicians as $technician):?>
                                            <option value="<?=$technician->id;?>"> <?=ucwords($technician->full_name);?></option>
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
                                        <button type="button" name="applyAttendance" id="applyAttendance" class="btn btn-primary">Apply</button>
                                </div>
                                <div class="form-group mr-15">
                                        <button type="button" name="resetAttendance" id="resetAttendance" class="btn btn-outline btn-primary">Clear</button>
                                </div>
                                <div class="form-group">
                                        <button type="button" name="submit_booking_form" class="btn btn-default">Download</button>
                                </div>
                            </div>
                            <div class="table-wrap">
                                <table class="table mb-0" id="tableAttendance">
                                    <thead>
                                        <tr>
                                           <th>Date</th>
                                           <th>Technician</th>
                                           <th>In Time</th>
                                           <th>Out Time</th>
                                           <th>Hours</th>
                                           <th>Manage</th>
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