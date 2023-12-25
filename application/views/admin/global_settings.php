<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Settings</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/global_settings"><span>Settings</span></a></li>
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
                            <h6 class="panel-title txt-dark">Settings</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
						<?php $attr = array("class" => "form-horizontal");?>
								<?php echo form_open('dashboard/global_settings', $attr);?>
								       <div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="hotel_name">Hotel Name:</label>
										    <div class="col-sm-10">
												<input type="text" class="form-control" id="hotel_name:" name="hotel_name" value="<?php echo $this->config_manager->config['conf_hotel_name']; ?>" placeholder="Enter Hotel Name">
											  	<?php echo form_error('hotel_name'); ?>
										    </div>
										</div>
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="hotel_email">Hotel Email:</label>
										    <div class="col-sm-10">
												<input type="email" class="form-control" id="hotel_email" name="hotel_email" value="<?php echo $this->config_manager->config['conf_hotel_email']; ?>" placeholder="Enter Hotel Email">
												<span class="help-block mt-10 mb-0"><small>Note: SMTP not supported(Gmail/yahoo..).</small></span>
											  	<?php echo form_error('hotel_email'); ?>
										    </div>
										</div>
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="hotel_phone">Hotel Phone Number:</label>
										    <div class="col-sm-10">
												<input type="text" class="form-control" id="hotel_phone" name="hotel_phone" value="<?php echo $this->config_manager->config['conf_hotel_phone']; ?>" placeholder="Enter Phone Number">
											  	<?php echo form_error('hotel_phone'); ?>
										    </div>
										</div>
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="notification_email">Email Notification:</label>
										    <div class="col-sm-10">
												<input type="email" class="form-control" id="notification_email" name="notification_email" value="<?php echo $this->config_manager->config['conf_notification_email']; ?>" placeholder="Enter email">
											  	<?php echo form_error('notification_email'); ?>
										    </div>
										</div>
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="booking_search_engine">Booking Engine:</label>
										<div class="col-sm-10"> 
											<select class="form-control" id="booking_search_engine" name="booking_search_engine">

											</select>
											<?php echo form_error('booking_search_engine'); ?>
										</div>
										</div>

										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="min_night_booking">Minimum Booking:</label>
										    <div class="col-sm-10">
											  <select class="form-control" id="min_night_booking" name="min_night_booking">
												  <?php
													$select_min_booking = "";
													for($k=1; $k<11; $k++){
														if($this->config_manager->config['conf_min_night_booking'] == $k){
														$select_min_booking.='<option value="' . $k . '" selected="selected">' . $k . '</option>' . "\n";
														}else{
														$select_min_booking.='<option value="' . $k . '">' . $k . '</option>' . "\n";
														}
													}
													echo $select_min_booking;
												  ?>
												</select>
												<?php echo form_error('min_night_booking'); ?>
										    </div>
										</div>
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="date_format">Date Format:</label>
										    <div class="col-sm-10">
								                <select name="date_format" id="date_format" class="form-control">
													<?php 
													   $dt_format_array=array("mm/dd/yy","dd/mm/yy","mm-dd-yy","dd-mm-yy","mm.dd.yy","dd.mm.yy","yy-mm-dd");
													   $select_dt_format="";
													   for($p=0; $p<7; $p++){
													   if($dt_format_array[$p] == $this->config_manager->config['conf_dateformat']){
														 $select_dt_format.='<option value="'.$dt_format_array[$p].'" selected="selected">'.strtoupper($dt_format_array[$p]).'</option>';
													   }else{
														 $select_dt_format.='<option value="'.$dt_format_array[$p].'" >'.strtoupper($dt_format_array[$p]).'</option>';
													    } 
													   }

													   echo $select_dt_format;
													?>
																</select>
																<?php echo form_error('date_format'); ?>
										    </div>
										</div>
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="room_lock">Room Lock Time:</label>
										    <div class="col-sm-10">
											    <select name="room_lock" id="room_lock" class="form-control">
													<?php
													$room_lock = array(
														'200' => '2 Minute',
														'500' => '5 Minute',
														'1000' => '10 Minute',
														'2000' => '20 Minute',
														'3000' => '30 Minute'
													);									
										            $select_room_lock = "";
													foreach($room_lock as $key => $value) {
														if($key == $this->config_manager->config['conf_booking_exptime']){
														   $select_room_lock.='		<option value="' . $key . '" selected="selected">' . $value . '</option>' . "\n";
														}else{
														   $select_room_lock.='		<option value="' . $key . '">' . $value . '</option>' . "\n";
														}
													}
													echo $select_room_lock;
													?>
												</select>
												<?php echo form_error('room_lock'); ?>
											    <span class="help-block mt-10 mb-0"><small>Note: Duration for customer selected Room(s) will be lock when checkout redirect to payment gateway.</small></span>
										    </div>
										</div>
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="generate_global_years">Maximum Booking Year:</label>
										    <div class="col-sm-10">
                                                 <select name="generate_global_years" id="generate_global_years" class="form-control">
												   <?php
												    $generate_global_years = '';
													   $yrs_value = array('1'=>'365','2'=>'730','3'=>'1095');
															foreach($yrs_value as $key=>$val){
																if($val == $this->config_manager->config['conf_maximum_global_years']){
																	$generate_global_years.= '<option value="'.$val.'" selected="selected">'.$key.' Year(s)</option>' ;
																}else{
																	$generate_global_years.= '<option value="'.$val.'">'.$key.' Year(s)</option>' ;
																}
																
															}	
													  echo  $generate_global_years;
												   ?>               
													</select>
													<?php echo form_error('generate_global_years'); ?>
										    </div>
										</div>
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="tax_amount">Tax(%):</label>
										    <div class="col-sm-10">
															<input type="text" class="form-control" id="tax_amount" name="tax_amount" value="<?php echo $this->config_manager->config['conf_tax_amount']; ?>" placeholder="%">
															<?php echo form_error('tax_amount'); ?>
										    </div>
										</div>	
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="email_hr">Invoice Currency :</label>
										    <div class="col-sm-10">
												<select name="inv_currency" class="form-control">

												</select>
										    </div>
										</div>	
										<div class="form-group">
											<label class="control-label mb-10 col-sm-2" for="email_hr">Price Including Tax?:</label>
										    <div class="col-sm-10">
                          <div class="checkbox checkbox-primary">
														<?php  if($this->config_manager->config['conf_price_with_tax'] == 1): ?>
														   <input type="checkbox" name="price_inclu_tax" id="price_inclu_tax" checked="checked" />
														<?php else: ?>
														<input type="checkbox" name="price_inclu_tax" id="price_inclu_tax" />
													    <?php endif;?>
														<label for="checkbox_hr">
														</label>
												</div>
										    </div>
										</div>																		
										<div class="form-group mb-0"> 
											<div class="col-sm-offset-2 col-sm-10">
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