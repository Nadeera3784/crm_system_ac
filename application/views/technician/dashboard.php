<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Link1</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>dashboard/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>dashboard/room_type"><span>Link1</span></a></li>
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
                            <h6 class="panel-title txt-dark">Link1</h6>
                        </div>
                        <div class="pull-right">
                           <button type="button" class="btn btn-sm btn-primary shadow shadow--big" data-toggle="modal" data-target="#roomTypeModal">New</button>
                           <div id="roomTypeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5 class="modal-title" id="myModalLabel">Add New</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form  id="roomTypeForm">
                                                        <div class="form-group">
                                                            <div id="errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="roomtype_title">Type Title:</label>
                                                                <input type="text" class="form-control" name="roomtype_title" id="roomtype_title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="description">Facilities:</label>
                                                                <textarea rows="5" cols="3" name="description" id="description" class="form-control"></textarea>
                                                        </div>
												    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-default" id="save_roomtype">Save</button>
                                                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
									</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table mb-0" id="roomtypeTable">
                                    <thead>
                                        <tr>
                                           <th>Type name</th>
                                           <th>Amenities</th>
                                           <th>MANAGE</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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