<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Client</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/client_list">Client</a></li>
                    <li><a href="<?=base_url();?>admin/add_client"><span>Add Client</span></a></li>
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
                            <h6 class="panel-title txt-dark">Add Client</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                        <?php $attr = array("class" => "form-horizontal", "id" => "add_client_form", "novalidate" => "novalidate");?>
							<?php echo form_open('admin/add_client', $attr);?>
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="company_name">Company Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="company_name" name="company_name" value="<?php echo $this->form_validation->set_value('company_name');?>">
                                        <?php echo form_error('company_name'); ?>
                                    </div>
                                </div>    

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="address">Address:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="address" name="address" value="<?php echo $this->form_validation->set_value('address');?>">
                                        <?php echo form_error('address'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="contact_general">Tel. No (General) :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="contact_general" name="contact_general" value="<?php echo $this->form_validation->set_value('contact_general');?>">
                                        <?php echo form_error('contact_general'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="contact_person">Contact Person :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="contact_person" name="contact_person" value="<?php echo $this->form_validation->set_value('contact_person');?>">
                                        <?php echo form_error('contact_person'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="designation">Designation:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="designation" name="designation" value="<?php echo $this->form_validation->set_value('designation');?>">
                                        <?php echo form_error('designation'); ?>
                                    </div>
                                </div> 
 
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="contact_mob">Contact No. (Mob):</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="contact_mob" name="contact_mob" value="<?php echo $this->form_validation->set_value('contact_mob');?>">
                                        <?php echo form_error('contact_mob'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="contact_fixed">Contact No.(Fixed):</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="contact_fixed" name="contact_fixed" value="<?php echo $this->form_validation->set_value('contact_fixed');?>">
                                        <?php echo form_error('contact_fixed'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="ext">Ext:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ext" name="ext" value="<?php echo $this->form_validation->set_value('ext');?>">
                                        <?php echo form_error('ext'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="vat_no">Vat no:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="vat_no" name="vat_no" value="<?php echo $this->form_validation->set_value('vat_no');?>">
                                        <?php echo form_error('vat_no'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="svat_no">SVAT No:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="svat_no" name="svat_no" value="<?php echo $this->form_validation->set_value('svat_no');?>">
                                        <?php echo form_error('svat_no'); ?>
                                    </div>
                                </div> 

                                
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="web">Web:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="web" name="web" value="<?php echo $this->form_validation->set_value('web');?>">
                                        <?php echo form_error('web'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="email">Email:</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control required" id="email" name="email" value="<?php echo $this->form_validation->set_value('email');?>">
                                        <?php echo form_error('email'); ?>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-4" for="location">Location:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" id="location" name="location" value="<?php echo $this->form_validation->set_value('location');?>">
                                        <?php echo form_error('location'); ?>
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