<div class="page-wrapper">
    <div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Attendance Chart</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url();?>admin/index">Dashboard</a></li>
                    <li><a href="<?=base_url();?>admin/change_password"><span>Change Password</span></a></li>
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
                            <h6 class="panel-title txt-dark">Attendance Chart</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                          <?php
                          $date = strtotime(date("Y-m-d"));
                          $day = date('d', $date);
                          $month = date('m', $date);
                          $year = date('Y', $date);
                          $daysInMonth = cal_days_in_month(0, $month, $year);
                          $imonth = date('F', $date);
                          ?>
                            <div class="table-responsivex">
                                <table class="table table-bordered" id="attendance_chart_table">
                                    <thead>
                                        <tr>
                                            <th>Technician</th>
                                            <?php for($i = 1; $i <= $daysInMonth; $i++): ?>
                                            <?php $i = str_pad($i, 2, 0, STR_PAD_LEFT); ?>
                                            <?php
                                            $tdate = $year.'-'.$month.'-'.$i;
                                            //Convert the date string into a unix timestamp.
                                            $unixTimestamp = strtotime($tdate);
                                            //Get the day of the week
                                            $dayOfWeek = date("D", $unixTimestamp);
                                            ?>
                                            <th class="<?php echo ($day == $i)? "currentdate" : "";?>"><strong><?php echo '<div>'.$i.' </div><span>'.$dayOfWeek.'</span>';?></strong></th>
                                            <?php endfor; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($technicians as $r):?>
                                       <tr>
                                          <td style="font-size: smaller"><?php echo ucfirst($r->full_name);?></td>
                                          <?php for($i = 1; $i <= $daysInMonth; $i++):?>
                                          <?php
                                           $check_date = $year.'-'.$month.'-'.$i;
                                           $unixTimestamp2 = strtotime($check_date);
                                           $dayOfWeek2 = date("D", $unixTimestamp2);
                                           ?>

                                            <td class="<?php echo ($dayOfWeek2 == "Sun")? "activeday" : "";?>">
                                              <i class="attendance ti-<?php $this->common->get_block($r->id, $check_date );?>"></i>
                                            </td>
                                           <?php endfor; ?>
                                       </tr>
                                       <?php endforeach;?>
                                    </tbody>
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