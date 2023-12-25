<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shit</title>
    <style type="text/css">

        body {
            color: #555555;
            background: #ffffff;
            font-size: 14px;
            font-family: "Source Sans Pro", sans-serif;
            /* width: 100%; */
        }
        .clearfix:after { 
            content: "."; 
            visibility: hidden; 
            display: block; 
            height: 0; 
            clear: both;
        }

        .parent {
            background: red;
            overflow: hidden;
        }
        .pull-left {
          float: left;
        }
        .pull-right {
          float: right;
        }
        .quotation-ref{
            color: #190adc;
            font-size: 14px;
        }
        .pt-20{
            padding-top:20px;
        }
        .mr-10{
            margin-right: 10px;
        }
        .mr-20{
            margin-right: 20px;
        }
        .mr-30{
            margin-right: 30px;
        }
        .text-uppercase{
            text-transform: uppercase;
        }
        .color-blue{
            color: #190adc;
        }
        .bbottom{
            border-bottom: 1px solid #190adc;
        }
        .box{
          width: 300px
        }
        .fs-12{
            font-size: 12px;
        }
        .text-center{
            text-align: center;
        }


        .table th, .table th, .table .th, .table td {
            padding: 3px 0px 3px 5px;
        }

        .table th {
            border-bottom: 1px solid #190adc;
            color:#190adc;
        }

        .table td {
            border-bottom: 1px solid #dad3d3;

        }



    </style>
</head>
<body>

<div class="clearfix">
  <div class="pull-left">
        <?php if($job->company == "ice_technologies"):?>
            <img src="<?php echo base_url();?>assets/images/ice.png">
        <?php else:?>
          <img src="<?php echo base_url();?>assets/images/abc.png">
        <?php endif;?>
  </div>
  <div class="pull-right mr-10">
   <?php if($job->company == "ice_technologies"):?>

   <h4 class="text-uppercase">ICE Technologies (Pvt) Limited</h4>
    <p class="fs-12">#941/5,6thLane, Parliament Drive, <br>EthulKotte, Kotte<br>
        +94115231257,+94115630386
        <br>
        sales1@icetechnologies.lk
        <br>
        www.icetechnologies.lk
    </p>

    <?php else:?>

    <h4 class="text-uppercase">ABC Trade & invesments (PVT) Ltd</h4>
    <p class="fs-12">#3, Bandaranayakapura Road, Rajagiriya.<br>
        +94 11 5 877 700
        <br>
        techsupport@abcsrilanka.biz
        <br>
        www.abcsrilanka.biz
    </p>

    <?php endif;?>

  </div>
</div>

<hr>
 <h3>Customer Details</h3>
<hr>
<div class="clearfix">
  <div class="pull-left">
      <table>
          <tbody>
           <tr>
            <td>Name</td>
            <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo status_transformer($job->company);?></span></td>
           </tr>
           <tr>
            <td>Address</td>
            <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->address;?></span></td>
           </tr>
            <tr>
             <td>Phone No</td>
             <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->contact_general;?></span></td>
           </tr>
           <tr>
             <td>E-Mail</td>
             <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->email;?></span></td>
           </tr>
          </tbody>
      </table>
  </div>
  <div class="pull-right" style="padding-right:50px">
     <table>
          <tbody>
           <tr>
            <td>Contact Name</td>
            <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->contact_person;?></span></td>
           </tr>
           <tr>
            <td>Phone No</td>
            <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->contact_fixed;?></span></td>
           </tr>
            <tr>
             <td>Mobile No</td>
             <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->contact_mob;?></span></td>
           </tr>
          </tbody>
      </table>
  </div>
</div>

<hr>
 <h3>Job Details</h3>
<hr>

<div class="clearfix">
  <div class="pull-left">
      <table>
          <tbody>
           <tr>
            <td>Date</td>
            <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->start_date;?></span></td>
           </tr>
           <tr>
            <td>Job No</td>
            <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->job_id;?></span></td>
           </tr>
            <tr>
             <td>Job Type</td>
             <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo ucfirst(status_transformer($job->job_type));?></span></td>
           </tr>
           <tr>
             <td>Service Type</td>
             <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo ucfirst(status_transformer($job->service_type));?></span></td>
           </tr>
          </tbody>
      </table>
  </div>
  <div class="pull-right" style="padding-right:50px">
     <table>
          <tbody>
           <tr>
            <td>Brand</td>
            <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->brand;?></span></td>
           </tr>
           <tr>
            <td>Serial No</td>
            <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->serial_no;?></span></td>
           </tr>
            <tr>
             <td>Product Type</td>
             <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->product_type;?></span></td>
           </tr>
           <tr>
             <td>Model No</td>
             <td><span class="fs-12">&nbsp&nbsp&nbsp<?php echo $job->model_no;?></span></td>
           </tr>
          </tbody>
      </table>
  </div>
</div>

<hr>
 <h3>Fault Description</h3>
 <p><?php echo status_transformer($job->fault_description);?></p>
<hr>

 <h3>Accessories</h3>
 <p><?php echo status_transformer($job->accessories);?></p>
<hr>

 <h3>Estimate Charges(LKR)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $job->estimate_charges;?></h3>
<hr>

<div class="clearfix">
  <div class="pull-left">
        <h3>Remarks</h3>
       <p>An tu me de L. Num quid tale Democritus? An vero, inquit, quisquam potest probare, quod perceptfum, quod. Quid sequatur, quid repugnet, vident. </p>
  </div>
  
  <div class="pull-right">
        <?php if($job->company == "ice_technologies"):?>
           <h3>ICE Technologies (Pvt) Limited</h3>
        <?php else:?>
          <h3>ABC Trade & invesments (PVT) Ltd</h3>
        <?php endif;?>
  </div>
</div>
<hr>
<div class="clearfix">
  <div class="pull-right">
      <p>Customer Confirmation : .........................................</p>
      <p>Received By  : ...........................  Date : <?php echo date("d-m-Y h:i:s A");?></p>
  </div>
</div>
<hr>

      <h3>Delivery Acknowledgement</h3>
      <p>Received mentioned item is in good condition. .......................................... Date : ..............</p>

<hr>
</body>
</html>
