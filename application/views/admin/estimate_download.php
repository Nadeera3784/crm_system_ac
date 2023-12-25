<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
        <?php if($estimate->company == "ice_technologies"):?>
            <img src="<?php echo base_url();?>assets/images/ice.png">
        <?php else:?>
          <img src="<?php echo base_url();?>assets/images/abc.png">
        <?php endif;?>
  </div>
  <div class="pull-right mr-10">
   <?php if($estimate->company == "ice_technologies"):?>

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

<div class="clearfix">
  <div class="pull-left pt-20">
        <div class="box">
            <div style="width:70%; height: 5px;"></div>
             <p  class="fs-12"><strong><?php echo $estimate->company_name;?></strong><br>
                <?php echo $estimate->address ;?><br>
                <?php echo $estimate->contact_general;?><br>
                <?php echo $estimate->contact_person;?><br>
                <?php echo $estimate->contact_mob;?><br>
                <?php echo $estimate->email;?>
              </p>
        </div>
  </div>
  <div class="pull-right pt-20">
     <div class="box" style="margin-right:75px;">
        <div style="width:70%; height: 5px;"></div>
        <p><strong>Estimate No : </strong> <?php echo $estimate->estimate_no;?></p>
        </p>
     </div>
  </div>
</div>

<div>
   <p>Dear Sir,</p>
</div>

<div style="width:100%; height: 5px;" class="text-center">
 <p style="text-decoration: underline;  color:#190adc; text-decoration-color: #190adc;">Estimate for Repair</p>
</div>

<div>
<p>Further to your request with regard to the above subject, we are pleased to forward our estimate for your kind perusal.</p>
</div>

<table width="100%" class="table">
    <thead>
      <tr>
        <th class="text-uppercase">Description</th>
        <th class="text-uppercase">Quantity</th>
        <th class="text-uppercase">Unit Price(LKR)</th>
        <th class="text-uppercase">Discount </th>
        <th class="text-uppercase">Price </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($estimate_data as $ed):?>
      <tr>
        <td><?php echo $ed->description;?></td>
        <td><?php echo $ed->quantity;?></td>
        <td><?php echo number_format($ed->unit_price);?></td>
        <td><?php echo $ed->discount ;?></td>
        <td><?php echo number_format($ed->price);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td>TAX(%)</td>
            <td><?php echo $estimate->tax;?></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td>Service Charge</td>
            <td><?php echo $estimate->srcharges;?></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td>Total</td>
            <td><?php echo $estimate->total_amount;?></td>
        </tr>
    </tfoot>
  </table>

<div style="width:100%; height: 5px;">
 <p style="text-decoration: underline; color:#190adc; text-decoration-color: #190adc;">TERMS & CONDITIONS:</p>
</div> 

<ol>
  <li>Payment-Cash or Cheque in advance.</li>
  <li>Cheques to be drawn in favor of 
  <?php if($estimate->company == "ice_technologies"):?>
   ICE Technologies (Pvt) Ltd.
  <?php else:?>
  ABC trades & invesment (PVT) Ltd
  <?php endif;?>
  </li>
  <li>Estimate is valid for a period of 07 days.</li>
  <li>During repair, if any other component is found defective, we shall send you a revised estimate. </li> 
  <li>Warranty –N/A</li> 
  <li>Estimate Charge LKR <?php echo $estimate->estimate_charges;?></li> 
</ol>

<p>
Should  there  be  any  further  clarification  regarding  the  above  please  do  not  hesitate  to  contact  the undersigned on 0714307660 <br><br>
Thanking You.
<br><br>
Yours faithfully,
</p>
<h3>
<?php if($estimate->company == "ice_technologies"):?>
   ICE Technologies (Pvt) Ltd.
<?php else:?>
  ABC trades & invesment (PVT) Ltd
<?php endif;?>
</h3>
</body>
</html>
