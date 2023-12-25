<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Dashboard</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li> <?php echo date('l') . ' ' . date('jS') . ' ' . date('F'). ' ' . date('\- Y'); ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                <span class="txt-dark block counter">
                                                    <span><?php echo ($completed_job->total)? $completed_job->total : "0" ;?></span>
                                                </span>
                                                <span class="capitalize-font block">Completed</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="pe-7s-check data-right-rep-icon text-blue"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                <span class="txt-dark block counter"><?php echo ($started_job->total)? $started_job->total : "0" ;?></span>
                                                <span class="capitalize-font block">Started</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="pe-7s-hourglass data-right-rep-icon text-blue"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                <span class="txt-dark block counter"><?php echo ($in_progress_job->total)? $in_progress_job->total : "0" ;?></span>
                                                <span class="capitalize-font block">In Progress</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="pe-7s-refresh-2  data-right-rep-icon text-blue"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                <span class="txt-dark block counter"><?php echo ($cancel_job->total)? $cancel_job->total : "0" ;?></span>
                                                <span class="capitalize-font block">Cancel</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="pe-7s-info  data-right-rep-icon text-blue"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                   <?php $this->load->view('notification'); ?>
                </div>
                <div class="col-sm-12">
                  <div class="panel panel-default border-panel card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Job Report</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <ul role="tablist" class="nav nav-pills" id="myTabs_6">
								<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="week_tab" href="#week1">Weekly</a></li>
                                <li role="presentation" class=""><a data-toggle="tab" id="month_tab" role="tab" href="#month1" aria-expanded="false">Monthly</a></li>
                                <li role="presentation" class=""><a data-toggle="tab" id="yearly_tab" role="tab" href="#yearly1" aria-expanded="false">Yearly</a></li>
                            </ul>
                                        
                            <div class="tab-content" id="myTabContent_6">
                                <div id="week1" class="tab-pane fade active in" role="tabpanel">
                                    <div id="job_weekchart"></div>
                                </div>
                                <div id="month1" class="tab-pane fade" role="tabpanel">
                                    <div id="job_monthchart"></div>
                                </div>
                                <div id="yearly1" class="tab-pane fade" role="tabpanel">
                                    <div id="job_yearchart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
		</div>
		<?php $this->load->view('footer_copyright'); ?>
	</div>
</div>