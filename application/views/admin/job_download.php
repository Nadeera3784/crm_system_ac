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

<div style="width:100%; height: 5px; margin-bottom:50px;" class="text-center">
 <p style="text-decoration: underline;  color:#190adc; text-decoration-color: #190adc;"><?php echo ucfirst($report_term);?> Job Report</p>
</div>


<table width="100%" class="table text-center">
    <thead>
      <tr>
        <th class="text-uppercase">Job No</th>
        <th class="text-uppercase">Client Name</th>
      </tr>
    </thead>
    <tbody>
      <?php $total = 0 ;?>
      <?php foreach($reports as $report):?>
      <tr>
        <td><?php $total ++;  echo $report->job_id;?></td>
        <td><?php echo $report->company_name;?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot>
        <tr>
            <td><?php echo $total;?></td>
            <td>Total</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>
