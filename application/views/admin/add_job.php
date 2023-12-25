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
                    <li><a href="<?=base_url();?>admin/add_job"><span>Add Job</span></a></li>
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
                            <h6 class="panel-title txt-dark">Add Job</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                        <?php $attr = array("class" => "form-horizontal");?>
							<?php echo form_open('admin/add_job', $attr);?>
                                 <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="company">Company:</label>
                                    <div class="col-sm-8">
                                        <select name="company" id="company" class="form-control">
                                            <option value="ice_technologies">ICE Technologies</option>
                                            <option value="abc_trade_investments">ABC Trade & Investments</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="start_date">Start Date:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $this->form_validation->set_value('start_date');?>">
                                        <?php echo form_error('start_date'); ?>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="end_date">End Date:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $this->form_validation->set_value('end_date');?>">
                                        <?php echo form_error('end_date'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="job_category">Job Category:</label>
                                    <div class="col-sm-8">
                                        <select name="job_category" id="job_category" class="form-control required">
                                            <option value="inhouse">In-House</option>
                                            <option value="onsite">On-Site</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="client_id">Client:</label>
                                    <div class="col-sm-8">
                                      <select name="client_id" id="client_id" class="form-control required">
                                            <?php foreach($clients as $client):?>
                                            <option value="<?=$client->client_id;?>"><?=$client->company_name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="service_type">Service Type :</label>
                                    <div class="col-sm-8">
                                       <select name="service_type" id="service_type" class="form-control">
                                            <option value="warranty">Warranty</option>
                                            <option value="chargeable">Chargeable</option>
                                            <option value="maintenance">Maintenance</option>
                                            <option value="free-Of-charge">Free-Of-Charge</option>
                                            <option value="service_type_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="service_type_other_custom" name="service_type_other_custom" placeholder="Enter Service Type" style="display:none">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="job_type">Job Type:</label>
                                    <div class="col-sm-8">
                                       <select name="job_type" id="job_type" class="form-control">
                                            <option value="repair">Repair</option>
                                            <option value="service">Service</option>
                                            <option value="printer-installation">Printer Installation</option>
                                            <option value="software-installation">Software Installation</option>
                                            <option value="payment-collection">Payment Collection</option>
                                            <option value="pick-up-delivery">Pick up/ Delivery</option>
                                        </select>
                                    </div>
                                </div> 
 
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="product_type ">Product Type :</label>
                                    <div class="col-sm-8">
                                        <select name="product_type" id="product_type" class="form-control">
                                            <option value="repair">Printer</option>
                                            <option value="service">Scanner</option>
                                            <option value="projector">Projector</option>
                                            <option value="laptop">Laptop</option>
                                            <option value="plotter">Plotter</option>
                                            <option value="id-card-printer">ID Card Printer</option>
                                            <option value="electronics">Electronics</option>
                                            <option value="product_type_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="product_type_other_custom" name="product_type_other_custom" placeholder="Enter Product Type" style="display:none">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="brand">Brand:</label>
                                    <div class="col-sm-8">
                                        <select name="brand" id="brand" class="form-control">
                                            <option value="hp">HP</option>
                                            <option value="canon">Canon</option>
                                            <option value="epson">Epson</option>
                                            <option value="lexmark">Lexmark</option>
                                            <option value="samsung">Samsung</option>
                                            <option value="oki">OKI</option>
                                            <option value="czur">CZUR</option>
                                            <option value="hiti">Hiti</option>
                                            <option value="brand_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="brand_other_custom" name="brand_other_custom" placeholder="Enter Brand Name" style="display:none">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="model_no">Model No:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="model_no" name="model_no" value="<?php echo $this->form_validation->set_value('model_no');?>">
                                        <?php echo form_error('model_no'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="serial_no">Serial No:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="serial_no" name="serial_no" value="<?php echo $this->form_validation->set_value('serial_no');?>">
                                        <?php echo form_error('serial_no'); ?>
                                    </div>
                                </div> 

                                
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="fault_description">Fault Description:</label>
                                    <div class="col-sm-8">
                                        <select name="fault_description" id="fault_description" class="form-control">
                                            <option value="no_power">No Power</option>
                                            <option value="poor_print_quality">Poor print quality</option>
                                            <option value="noise">Noise</option>
                                            <option value="natural_damage">Natural Damage</option>
                                            <option value="not_detecting">Not Detecting</option>
                                            <option value="not_scanning">Not Scanning</option>
                                            <option value="paper_jam">Paper Jam</option>
                                            <option value="paper_not_feeding">Paper not feeding</option>
                                            <option value="service">Service</option>
                                            <option value="fault_description_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="fault_description_other_custom" name="fault_description_other_custom" placeholder="Enter Fault Description" style="display:none">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="accessories">Accessories Received:</label>
                                    <div class="col-sm-8">
                                        <select name="accessories" id="accessories" class="form-control">
                                            <option value="usb_cable">USB Cable</option>
                                            <option value="power_cord">Power Cord</option>
                                            <option value="consumables">Consumables</option>
                                            <option value="tractor">Tractor</option>
                                            <option value="knob">Knob</option>
                                            <option value="spindle">Spindle</option>
                                            <option value="tray">Tray</option>
                                            <option value="accessories_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="accessories_other_custom" name="accessories_other_custom" placeholder="Enter Accessories Name" style="display:none">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="assigned">Assigned To :</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <?php foreach($technicians as $technician):?>
                                               <div class="col-md-3">
                                                <div class="checkbox checkbox-primary">
                                                    <input name="assigned[]" id="checkbox<?=$technician->id;?>" type="checkbox" value="<?=$technician->id;?>">
                                                    <label for="checkbox<?=$technician->id;?>">
                                                        <?=ucwords($technician->full_name);?>
                                                    </label>
                                                </div>
                                             </div>
                                            <?php endforeach;?>
                                        </div>
                                        <?php echo form_error('assigned[]'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="status">Status:</label>
                                    <div class="col-sm-8">
                                        <select name="status" id="status" class="form-control">
                                            <option value="started">Started</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="on_hold">On Hold</option>
                                            <option value="cancel">Cancel</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="sales_person">Sales Person:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="sales_person" name="sales_person" value="<?php echo $this->form_validation->set_value('sales_person');?>">
                                        <?php echo form_error('sales_person'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="estimate_charges">Estimate Charges(LKR):</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="estimate_charges" name="estimate_charges" value="<?php echo $this->form_validation->set_value('estimate_charges');?>">
                                        <?php echo form_error('estimate_charges'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="remarks">Remarks:</label>
                                    <div class="col-sm-8">
                                      <textarea class="form-control" name="remarks" rows="5"></textarea>
                                        <?php echo form_error('remarks'); ?>
                                    </div>
                                </div>

                                <div class="form-group mb-0"> 
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-sm btn-primary"><span class="btn-text">Save</span></button>
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