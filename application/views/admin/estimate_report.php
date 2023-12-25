<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Estimates</h5>
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
                            <h6 class="panel-title txt-dark">Estimate Report</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                           <div class="table-wrap">
                           <ul role="tablist" class="nav nav-pills" id="myTabs_6">
								<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="week_tab" href="#week">Weekly</a></li>
                                <li role="presentation" class=""><a data-toggle="tab" id="month_tab" role="tab" href="#month" aria-expanded="false">Monthly</a></li>
                                <li role="presentation" class=""><a data-toggle="tab" id="yearly_tab" role="tab" href="#yearly" aria-expanded="false">Yearly</a></li>
                            </ul>
                                        
                            <div class="tab-content" id="myTabContent_6">
                                <div id="week" class="tab-pane fade active in" role="tabpanel">
                                    <div id="weekchart"></div>
                                </div>
                                <div id="month" class="tab-pane fade" role="tabpanel">
                                    <div id="monthchart"></div>
                                </div>
                                <div id="yearly" class="tab-pane fade" role="tabpanel">
                                    <div id="yearchart"></div>
                                </div>
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