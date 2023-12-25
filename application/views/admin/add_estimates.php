<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Estimates</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/estimates_list">Estimates</a></li>
                    <li><a href="<?=base_url();?>admin/add_estimates"><span>Create Estimate</span></a></li>
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
                            <h6 class="panel-title txt-dark">Create Estimate</h6>
                        </div>
                        <div class="pull-right">
                           <button type="button" class="btn btn-sm btn-primary create_calculator" data-toggle="modal" data-target="#calculatorModal" data-backdrop="static">Calculator</button>
                           <div id="calculatorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myModalLabel">Calculator</h5>
                                        </div>
                                        <div class="modal-body">
                                        <div id="idCalculadora"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
							<?php echo form_open('admin/add_estimates');?>
                            <div class="row">
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <label class="control-label mb-10" for="company">Company:</label>
                                       <select name="company" id="company" class="form-control">
                                            <option value="ice_technologies">ICE Technologies</option>
                                            <option value="abc_trade_investments">ABC Trade & Investments</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-md-3">
                                   <div class="form-group">
                                    <label class="control-label mb-10" for="estimate_no">Estimate No:</label>
                                        <input type="text" class="form-control" id="estimate_no" name="estimate_no" value="<?php echo $this->form_validation->set_value('estimate_no');?>">
                                        <?php echo form_error('estimate_no'); ?>
                                    </div>
                                </div>    
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label class="control-label mb-10" for="estimate_date">Estimate Date:</label>
                                        <input type="text" class="form-control" id="estimate_date" name="estimate_date" value="<?php echo $this->form_validation->set_value('estimate_date');?>">
                                        <?php echo form_error('estimate_date'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                   <div class="form-group">
                                       <label class="control-label mb-10" for="job_no">Job No:</label>
                                        <select name="job_no" id="job_no" class="form-control selectJobId">
                                            <?php foreach($jobs as $job): ?>
                                            <option value="<?=$job->job_id;?>"><?=$job->job_id;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div> 
                                <hr>
                                <div class="col-md-12">
                                    <table class="table table-hover" id="tableEstimate">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th>Part No</th>
                                                <th>Description</th>
                                                <th>Unit Price(LKR)</th>
                                                <th>Quantity</th>
                                                <th>Discount %</th>
                                                <th>Price(LKR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id='parentElement0'>
                                                <td>1</td>
                                                <td><input type="text" name='part_no[]'   class="form-control"/></td>
                                                <td><input type="text" name='description[]'   class="form-control"/></td>
                                                <td><input type="number" name='unit_price[]' class="form-control unit_price" step="0.00" min="0"/></td>
                                                <td><input type="number" name='quantity[]'  class="form-control quantity" step="0" min="0"/></td>
                                                <td><input type="number" name='discount[]'  class="form-control discount" step="0" min="0"/></td>
                                                <td><input type="number" name='price[]'  class="form-control price" readonly/></td>
                                            </tr>
                                             <tr id='parentElement1'></tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td colspan="1">SUBTOTAL</td>
                                                <td><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td colspan="1">TAX %</td>
                                                <td><input type="number" class="form-control" id="tax" name="tax" placeholder="0"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td colspan="1">Tax Amount</td>
                                                <td><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td colspan="1">S/R Charges</td>
                                                <td><input type="number" class="form-control" id="srcharges" name="srcharges" placeholder="0"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td colspan="1">GRAND TOTAL</td>
                                                <td><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                   <button  type="button" id="add_row" class="btn btn-sm btn-outline btn-primary">Add Row</button>
                                   <button  type="button" id='delete_row' class="btn btn-sm btn-default">Delete Row</button>
                                   <button  type="submit" class="btn btn-sm btn-primary pull-right">Save</button>
                                </div>

                            </div>
                            <?php echo form_close();?> 
                        </div>
                    </div>
                </div>	
            </div>
		</div>
		<?php $this->load->view('footer_copyright'); ?>
	</div>
</div>