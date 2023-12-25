<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Job</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/job_list"><span>Job</span></a></li>
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
							<?php echo form_open('admin/update_job', $attr);?>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="company">Company:</label>
                                    <div class="col-sm-8">
                                    <?php
                                        $companyList = array(
                                            0 => 'ice_technologies',
                                            1 => 'abc_trade_investments'
                                        );
                                    ?>
                                        <select name="company" id="company" class="form-control">
                                            <?php foreach($companyList as $key => $value):?>
                                            <?php
                                                if($value == $job->company){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option <?php echo $selected; ?> value="<?=$value;?>"><?=status_transformer($value);?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="start_date">Start Date:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $job->start_date;?>">
                                        <?php echo form_error('start_date'); ?>
                                    </div>
                                </div>    

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="end_date">End Date:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $job->end_date;?>">
                                        <?php echo form_error('end_date'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="job_category">Job Category:</label>
                                    <div class="col-sm-8">
                                    <?php
                                        $JobCategoryList = array(
                                            0 => 'inhouse',
                                            1 => 'onsite'
                                        );
                                    ?>
                                        <select name="job_category" id="job_category" class="form-control required">
                                            <?php foreach($JobCategoryList as $key => $value):?>
                                            <?php
                                                if($value == $job->job_category){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option <?php echo $selected; ?> value="<?=$value;?>"><?=status_transformer($value);?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="client_id">Client:</label>
                                    <div class="col-sm-8">
                                      <select name="client_id" id="client_id" class="form-control required">
                                            <?php foreach($clients as $client):?>
                                            <?php
                                                if($client->client_id == $job->client_id){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option <?php echo $selected; ?> value="<?=$client->client_id;?>"><?=$client->company_name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="service_type">Service Type :</label>
                                    <div class="col-sm-8">
                                    <?php
                                        $ServiceTypeList = array( 0 => "warranty", 1 => "chargeable", 2 => "maintenance", 3 => "free-of-charge");
                                    ?>
                                       <select name="service_type" id="service_type" class="form-control">
                                            <?php foreach($ServiceTypeList as $key => $value):?>
                                            <?php
                                                if($value == $job->service_type){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                              <option <?php echo $selected; ?>  value="<?=$value;?>"><?=ucwords(status_transformer($value));?></option>
                                            <?php endforeach;?>
                                            <option <?php echo (array_search($job->service_type,$ServiceTypeList,true) !== false) ? "" : "selected"; ?> value="service_type_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="service_type_other_custom" name="service_type_other_custom" value="<?=$job->service_type;?>" style="display:<?php echo (array_search($job->service_type,$ServiceTypeList,true) !== false) ? "none" : "block"; ?>">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="job_type">Job Type:</label>
                                    <div class="col-sm-8">
                                    <?php
                                        $JobTypeList = array(
                                            0 => 'repair',
                                            1 => 'service',
                                            2 => 'printer-installation',
                                            3 => 'software-installation',
                                            4 => 'payment-collection',
                                            5 => 'pick-up-delivery'
                                        );
                                    ?>
                                       <select name="job_type" id="job_type" class="form-control">
                                           <?php foreach($JobTypeList as $key => $value):?>
                                           <?php
                                                if($value == $job->job_type){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                            <option  <?php echo $selected; ?>  value="<?=$value;?>"><?=ucwords(status_transformer($value));?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div> 
 
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="product_type ">Product Type :</label>
                                    <div class="col-sm-8">
                                    <?php
                                        $ProductTypeList = array(
                                            0 => "printer",
                                            1 => "scanner",
                                            2 => "projector",
                                            3 => "laptop",
                                            4 => "plotter",
                                            5 => "id-card-printer",
                                            6 => "electronics"
                                        );
                                    ?>
                                        <select name="product_type" id="product_type" class="form-control">
                                            <?php foreach($ProductTypeList as $key => $value):?>
                                            <?php
                                                if($value == $job->product_type){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                               <option  <?php echo $selected; ?> value="<?=$value;?>"><?=ucwords(status_transformer($value));?></option>
                                            <?php endforeach;?>
                                            <option <?php echo (array_search($job->product_type,$ProductTypeList,true) !== false) ? "" : "selected"; ?> value="product_type_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="product_type_other_custom" name="product_type_other_custom" value="<?=$job->product_type;?>"  style="display:<?php echo (array_search($job->product_type,$ProductTypeList,true) !== false) ? "none" : "block"; ?>">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="brand">Brand:</label>
                                    <div class="col-sm-8">
                                    <?php
                                        $BrandList = array( 0 => "hp", 1 => "canon", 2 => "epson",  3 => "lexmark", 4 => "samsung", 5 => "oki", 6 =>  "czur", 7 => "hiti");
                                    ?>
                                        <select name="brand" id="brand" class="form-control">
                                            <?php foreach($BrandList as $key => $value):?>
                                            <?php
                                                if($value == $job->brand){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                               <option <?php echo $selected; ?> value="<?=$value;?>"><?=ucwords($value);?></option>
                                            <?php endforeach;?>
                                            <option <?php echo (array_search($job->brand,$BrandList,true) !== false) ? "" : "selected"; ?> value="brand_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="brand_other_custom" name="brand_other_custom" value="<?=$job->brand?>" style="display:<?php echo (array_search($job->brand,$BrandList,true) !== false) ? "none" : "block"; ?>">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="model_no">Model No:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="model_no" name="model_no" value="<?php echo $job->model_no;?>">
                                        <?php echo form_error('model_no'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="serial_no">Serial No:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="serial_no" name="serial_no" value="<?php echo $job->serial_no;?>">
                                        <?php echo form_error('serial_no'); ?>
                                    </div>
                                </div> 

                                
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="fault_description">Fault Description:</label>
                                    <?php
                                        $FaultDescriptionList = array(
                                             0 => "no_power", 
                                             1 => "poor_print_quality", 
                                             2 => "noise",  
                                             3 => "natural_damage", 
                                             4 => "not_detecting", 
                                             5 => "not_scanning", 
                                             6 => "paper_jam", 
                                             7 => "paper_not_feeding",
                                             8 => "service"
                                        );
                                    ?>
                                    <div class="col-sm-8">
                                        <select name="fault_description" id="fault_description" class="form-control">
                                            <?php foreach($FaultDescriptionList as $key => $value):?>
                                            <?php
                                                if($value == $job->fault_description){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                               <option <?php echo $selected; ?> value="<?=$value;?>"><?=ucwords(status_transformer($value));?></option>
                                            <?php endforeach;?>
                                            <option  <?php echo (array_search($job->fault_description,$FaultDescriptionList,true) !== false) ? "" : "selected"; ?> value="fault_description_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="fault_description_other_custom" name="fault_description_other_custom" value="<?=$job->fault_description;?>" style="display:<?php echo (array_search($job->fault_description,$FaultDescriptionList,true) !== false) ? "none" : "block"; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="accessories">Accessories Received:</label>
                                    <?php
                                        $AccessoriesList = array(
                                             0 => "usb_cable", 
                                             1 => "power_cord", 
                                             2 => "consumables",  
                                             3 => "tractor", 
                                             4 => "knob", 
                                             5 => "spindle", 
                                             6 => "tray"
                                        );
                                    ?>
                                    <div class="col-sm-8">
                                        <select name="accessories" id="accessories" class="form-control">
                                            <?php foreach($AccessoriesList as $key => $value):?>
                                            <?php
                                                if($value == $job->accessories){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                              <option <?php echo $selected; ?> value="<?=$value;?>"><?=ucwords(status_transformer($value));?></option>
                                            <?php endforeach;?>
                                            <option <?php echo (array_search($job->accessories,$AccessoriesList,true) !== false) ? "" : "selected"; ?> value="accessories_other">Other</option>
                                        </select>
                                        <input type="text" class="form-control mt-10" id="accessories_other_custom" name="accessories_other_custom" value="<?=$job->accessories;?>"   style="display:<?php echo (array_search($job->accessories,$AccessoriesList,true) !== false) ? "none" : "block"; ?>">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="assigned">Assigned To :</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <?php
                                             $user_id = array();
                                             foreach($assigned_technician as $ast){
                                                $user_id[] =  $ast->users_id;
                                             }
                                             ?>
                                            <?php foreach($technicians as $technician):?>
                                               <div class="col-md-3">
                                                <div class="checkbox checkbox-primary">
                                                    <input name="assigned[]" id="checkbox<?=$technician->id;?>" type="checkbox" value="<?=$technician->id;?>" <?php echo (array_search($technician->id,$user_id,true) !== false) ? "checked" : ""; ?>>
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
                                    <?php
                                        $statusList = array(
                                            0 => 'started',
                                            1 => 'in_progress',
                                            2 => 'on_hold',
                                            3 => 'cancel',
                                            4 => 'completed'
                                        );
                                    ?>
                                        <select name="status" id="status" class="form-control">
                                           <?php foreach($statusList as $key => $value):?>
                                           <?php
                                                if($value == $job->status){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = "";
                                                }
                                            ?>
                                               <option <?php echo $selected; ?> value="<?=$value;?>"><?=status_transformer($value);?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="sales_person">Sales Person:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="sales_person" name="sales_person" value="<?php echo $job->sales_person;?>">
                                        <input type="hidden"  name="update_id" value="<?php echo $this->hasher->encrypt($job->job_id);?>">
                                        <?php echo form_error('sales_person'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="estimate_charges">Estimate Charges(LKR):</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="estimate_charges" name="estimate_charges" value="<?php echo $job->estimate_charges;?>">
                                        <?php echo form_error('estimate_charges'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="remarks">Remarks:</label>
                                    <div class="col-sm-8">
                                      <textarea class="form-control" name="remarks" rows="5"><?=$job->remarks;?></textarea>
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