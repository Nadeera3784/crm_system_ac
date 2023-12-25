<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Technicians</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/technician_list"><span>Technician</span></a></li>
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
                            <h6 class="panel-title txt-dark">Technician List</h6>
                        </div>
                        <div class="pull-right">
                           <a href="<?php echo base_url();?>admin/add_technician" class="btn btn-sm btn-primary shadow shadow--big">New</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                        <div class="table-wrap">
                                <table class="table mb-0" id="tableTechnician">
                                    <thead>
                                        <tr>
                                           <th>Employee No</th>
                                           <th>Name</th>
                                           <th>Active</th>
                                           <th>Email</th>
                                           <th>Phone</th>
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