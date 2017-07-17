<?php 
require_once("config.php");
require_once("function.php");
require_once("auth.php");
if(isset($_GET['idd']) && isset($_GET['delete_receipt']))
{
	$select_receipt=mysql_query("select * from ledger where transaction_id='".$_GET['idd']."' && transaction_type='receipt' && credit>='0' " );
	$result_receipt=mysql_fetch_array($select_receipt);
    $new_rows=[];
    while($row = mysql_fetch_array($select_receipt)) 
    {

        
       foreach(explode(',', $row['invoice_id']) as $value){

            $qry1 = "update `invoice` set `payment_status`='no' where `id`='".$value."'";
            $rs_update=@mysql_query($qry1);
            
            $qry2 = "SELECT grand_total FROM invoice WHERE id = '".$value."' AND payment_status='no' AND waveoff_status!='1' ORDER BY id";
            
            $find_GT = mysql_query($qry2);  
            $result_receipt1=mysql_fetch_array($find_GT);
            $invoice_list1=$result_receipt1['grand_total']; 
            
            $qry3 = "UPDATE receipt_detail SET due_amnt = '".$invoice_list1."' WHERE invoice_id = '".$value."'";
            $update_total = @mysql_query($qry3);
            
       }
   } 
   
  $query = mysql_query("delete from ledger where transaction_id='".$_GET['idd']."' && transaction_type='receipt'");     
    if($query)
       echo '<script>
   alert("Receipt Deleted Successfully.");
   location="receipt_menu.php?mode=del";
   </script>';
}
$result_max=mysql_query("select max(`transaction_id`) from `ledger` where `transaction_type`='receipt'");
$row=mysql_fetch_array($result_max);
$max_receipt_id=$row[0]+1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <title><?php title(); ?></title>
 <meta content="width=device-width, initial-scale=1.0" name="viewport" />
 <meta content="" name="description" />
 <meta content="" name="author" />
 <?php logo(); ?>
 <?php css(); ?>
 <?php ajax(); ?>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style>
 select option:hover:after {
    content: attr(title);
    background: #666;
    color: #fff;
    border: none;
    right:10px;
}
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
	<!-- BEGIN HEADER -->
	<?php navi_bar(); ?>
 <div class="page-container row-fluid">
  <!-- END SIDEBAR -->
  <?php  navi_menu(); ?>      
  <!-- BEGIN PAGE -->  
  <div class="page-content" id="zoom_div">
   <div class="container-fluid">
       <?php menu(); ?>
       <?php
       if(isset($_POST['receipt_edit']))
       {
        if(isset($_GET['receipt_view']))
        {
            ?>  
            <div class="portlet box blue" >
                <div class="portlet-title">
                    <h4><i class="icon-search"></i> Receipt Search</h4>
                </div>
                <div class="portlet-body form">
                    <?php
                }
                else if(isset($_GET['receipt_delete']))
                {
                    ?>
                    <div class="portlet box red" >
                        <div class="portlet-title">
                            <h4><i class="icon-trash"></i> Receipt Delete</h4>
                        </div>
                        <div class="portlet-body form">
                            <?php
                        }
                        else
                        {
                            ?>
    <div class="portlet box yellow" >
        <div class="portlet-title">
            <h4><i class="icon-edit"></i> Receipt Update</h4>
        </div>
        <div class="portlet-body form">
            <?php
        }
        ?>
        <form method="post" action="docburner.php">
            <button  type="submit" style="float:right;" class="btn red diplaynone tooltips" title="Download in Excel"  data-placement="bottom"><i class="icon-download-alt"></i> Download in Excel</button>
            <input type="hidden" value="<?php echo $_POST['date_from']; ?>" name="date_from">
            <input type="hidden" value="<?php echo $_POST['date_to']; ?>" name="date_to">
            <input type="hidden" value="<?php echo $_POST['receipt_id']; ?>" name="receipt_id">
            <input type="hidden" value="receipt" name="excel_for">
        </form>
        <div style="width:100%; overflow-x:scroll; overflow-y:hidden;padding-top:5px;">
           <table width="100%" class="table table-bordered table-hover table-condensed flip-content" id="sample_1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Date</th>
                    <th>Receipt ID</th>
                    <th>Name</th>
                    <th>Narration</th>
                    <th>Amount</th>
                    <?php
                    if(isset($_GET['receipt_view']))
                    {
                        ?>
                        <th>View Details</th>
                        <?php
                    }
                    else if(isset($_GET['receipt_delete']))
                    {
                        ?>
                        <th>Delete</th>
                        <?php
                    }
                    else 
                    {
                        ?>
                        <th>Edit</th>
                        <?php
                    }

                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $q1="";	$q2="";	$q3=" ";	
                if(!empty($_POST['receipt_id']))
                {
                   $receipt_id=$_POST['receipt_id'];
                   $q1="transaction_id='".$receipt_id."'";
               }
               if(!empty($_POST['date_from'])&&!empty($_POST['date_to']))
               {
                   $date_from=datefordb($_POST['date_from']);
                   $date_to=datefordb($_POST['date_to']);
                   if($q1=="")
                       $q2=" `date` between '".$date_from."' and  '".$date_to."' ";
                   else
                       $q2=" AND `date` between '".$date_from."' and  '".$date_to."' ";
               }
               if($q1=="" && $q2=="" ){
                   $qry ="select * from ledger";
                   $q3=" where `transaction_type`='receipt'  AND `credit`!='0' ";}
                   else    {
                       $qry="select * from ledger where ";
                       $q3=" AND `transaction_type`='receipt'  AND `credit`!='0' "; }
                       $sql=$qry.$q1.$q2.$q3;
                       $result= @mysql_query($sql);
                       if($result)
                       {
                        while($row=mysql_fetch_array($result))
                            {	$i++;
                               $idd=$row['transaction_id'];
                               $ledger_master_id=$row['ledger_master_id'];
                               $result_ledger=mysql_query("select `ledger_type_id`,`name` from `ledger_master` where `id`='".$ledger_master_id."'");
                               $row_ledger=mysql_fetch_array($result_ledger);
                               $name=$row_ledger['name'];
                               $ledger_type_id=$row_ledger['ledger_type_id'];
                               ?>
                               <tr id="<?php echo $i; ?>">
                                <td><?php echo $i;?></td>
                                <td><?php echo dateforview($row['date']); ?></td>
                                <th><?php echo $row['transaction_id']; ?></th>
                                <td><?php echo $name;?></td>
                                <td><?php echo $row['narration'];?></td>
                                <td><?php echo $row['credit'];?></td>
                                <?php
                                if(isset($_GET['receipt_view']))
                                {
                                    ?>
                                    <td>
                                        <a class="btn mini blue"  role="button"  href="view.php?receipt=true&id=<?php echo $idd;?>" target="_blank" style="text-decoration:none;">
                                         <i class="icon-search"></i></a>
                                     </td>
                                     <?php
                                 }
                                 else if(isset($_GET['receipt_delete']))
                                 {
                                    ?>

                                    <td><a class="btn mini red" title="Permanently Delete"  role="button"  data-toggle="modal" href="#myModal1<?php echo $i ?>" style="text-decoration:none;">
                                        <i class="icon-trash"></i></a> 

                                        <div style="display: none;" id="myModal1<?php echo $i ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 id="myModalLabel1" style="text-align: left ! important;"><span style="color:#EE5F5B"><i class="icon-trash"></i> <b><?php echo $name; ?></b></span></h4>
                                            </div>
        <!--  <div class="modal-body">
    </div>-->
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>	
        <a type="button"   href='receipt_menu.php?delete_receipt=true&idd=<?php echo $idd;?>' id="refresh" class="btn red"><i class="icon-trash"></i> Delete</a>
    </div>
    </div>        

    </td>
    <?php
    }
    else 
    {
    ?>
    <td><a class="btn mini red"  role="button"  href="update_receipt.php?id=<?php echo $idd;?>" target="_blank" style="text-decoration:none;"><i class="icon-edit"></i></a>
    </td>
    <?php
    }

    ?>
    </tr>
    <?php
    }
    }
    ?>
    </tbody>
    </table>   
    </div>
    </div>
    </div>
<?php
}
else if(isset($_GET['mode']))
{
 if($_GET['mode']=='edit')
 {
    ?>
    <div class="portlet box yellow">
        <div class="portlet-title">
            <h4><i class="icon-edit"></i>Receipt Edit</h4>
        </div>
        <div class="portlet-body form">
            <form action="receipt_menu.php?receipt_edit=true" name="form_name" autocomplete="off" method="post" class="form-horizontal">

               <div class="control-group">
                <label class="control-label">Receipt ID</label>
                <div class="controls">
                    <input type="text" name="receipt_id"  class="span6 m-wrap" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Date From</label>
                <div class="controls">
                    <input type="text" name="date_from"  class="span6 m-wrap date-picker"  onClick="mydatepick();"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Date To</label>
                <div class="controls">
                    <input type="text" name="date_to"  class="span6 m-wrap date-picker" onClick="mydatepick();"/>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit"   class="btn green" name="receipt_edit"/><i class="icon-ok"></i> Submit</button>
                <button type="reset"   class="btn yellow" /><i class="icon-retweet"></i> Reset</button>
            </div> 


        </form>
    </div>
</div>
<?php
}
else if($_GET['mode']=='del')
{
    ?>
    <div class="portlet box red" >
        <div class="portlet-title">
            <h4><i class="icon-trash"></i>Receipt Delete</h4>
        </div>
        <div class="portlet-body form">
           <form action="receipt_menu.php?receipt_delete=true" name="form_name" autocomplete="off" method="post" class="form-horizontal">

            <div class="control-group">
                <label class="control-label">Receipt ID</label>
                <div class="controls">
                    <input type="text" name="receipt_id"  class="span6 m-wrap" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Date From</label>
                <div class="controls">
                    <input type="text" name="date_from"  class="span6 m-wrap date-picker" onClick="mydatepick();"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Date To</label>
                <div class="controls">
                    <input type="text" name="date_to"  class="span6 m-wrap date-picker" onClick="mydatepick();"/>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit"   class="btn green" name="receipt_edit"/><i class="icon-ok"></i> Submit</button>
                <button type="reset"   class="btn yellow" /><i class="icon-retweet"></i> Reset</button>
            </div> 

        </form>
    </div>
</div>
<?php
}
else if($_GET['mode']=='view')
{
    ?>
    <div class="portlet box blue" >
        <div class="portlet-title">
            <h4><i class="icon-search"></i>Receipt View</h4>
        </div>
        <div class="portlet-body form">
           <form action="receipt_menu.php?receipt_view=true" name="form_name" autocomplete="off" method="post" class="form-horizontal">

            <div class="control-group">
                <label class="control-label">Receipt ID</label>
                <div class="controls">
                    <input type="text" name="receipt_id"  class="span6 m-wrap" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Date From</label>
                <div class="controls">
                    <input type="text" name="date_from"  class="span6 m-wrap date-picker"  onClick="mydatepick();"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Date To</label>
                <div class="controls">
                    <input type="text" name="date_to"  class="span6 m-wrap date-picker" onClick="mydatepick();"/>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit"   class="btn green" name="receipt_edit"/><i class="icon-ok"></i> Submit</button>
                <button type="reset"   class="btn yellow" /><i class="icon-retweet"></i> Reset</button>
            </div> 

        </form>
    </div>
</div>
<?php
}
}
else
{
 ?>
 <form  name="form_name" action="Handler.php" class="form-horizontal"  method="post">
    <div class="portlet box blue">
        <div class="portlet-title">
            <h4><i class="icon-th"></i>Receipt</h4>
        </div>
        <div class="portlet-body form">
         <div class="span12">
            <div class="span4">
               <div class="control-group">
                <label class="control-label" style="margin-right: 15px;">Receipt No.</label>
                <div class="controls" style="margin-left: 0px;">
                    <span class="text"><strong><?php echo $max_receipt_id; ?></strong></span>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="control-group">
                <label class="control-label" style="margin-right: 7px;">Ledger Type</label>
                <div class="controls" style="margin-left: 0px;">
                    <select name="ledger_type_id" id="ledger_type" class="span6 m-wrap" onChange="fetch_ledger();"> 
                        <option value="">---select ledger type---</option>
                        <?php 
                        $result= mysql_query("select distinct `id`,`name` from ledger_type");
                        while($row=mysql_fetch_array($result))
                        {
                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="span4">
           <div class="control-group">
            <label class="control-label" style="margin-right: 7px;">Date</label>
            <div class="controls" style="margin-left: 0px;">
             <input type="text" name="date"  class="span6 m-wrap date-picker" onClick="mydatepick();" />
         </div>
     </div>  
 </div>
</div>


 <div class="table-responsive">
   <table class="table" id="main_tb">
    <tbody id="main_tbody"></tbody>
  </table>
</div>

<div class="control-group">
   <div class="controls span12">
      <div class="controls span6"></div>
      <div class="controls span6">
       <label class="control-label" style="margin-left: 130px;">Total Amount</label>
       <input type="text"  style="float: right;" id="allamount" class="allamount" value="" />
    </div>
    </div>
    
</div>



<div class="control-group">
    <label class="control-label">Receipt Type</label>
    <div class="controls">
        <select name="receipt_type" class="span6 m-wrap"  onchange="HideShowRows()">	
            <option value="cash">Cash</option>
            <option value="bank">Bank</option>
        </select>
    </div>
</div>   

<div class="control-group"  id="1" style="display:none;" >
    <label class="control-label">Bank Name:</label>
    <div class="controls">
        <select name="bank_id" class="span6 m-wrap" id="bank_id" onChange="fetch_branch();">	
           <option value="">---select bank name---</option>
           <?php 
           $result= mysql_query("select distinct `id`,`name` from `bank_reg`");
           while($row=mysql_fetch_array($result))
           {
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        ?>
    </select>
</div>
</div> 


<div class="control-group"  id="2" style="display:none;" >
    <label class="control-label">Branch Name:</label>
    <div class="controls" id="branch_place">

    </div>
</div> 


<div class="control-group"  id="3" style="display:none;" >
    <label class="control-label">Cheque number</label>
    <div class="controls">
        <input type="text" name="cheque_no"  class="span6 m-wrap" />
    </div>
</div> 


<div class="control-group"  id="4" style="display:none;" >
    <label class="control-label">Cheque Date</label>
    <div class="controls">
        <input type="text" name="cheque_date"  class="span6 m-wrap date-picker"  onClick="mydatepick();"/>
    </div>
</div> 

<div class="control-group" id="5" style="display:none;">
    <label class="control-label">Drawn Branch</label>
    <div class="controls">
        <input type="text" name="drawn_branch"  class="span6 m-wrap" />
    </div>
</div> 

<div class="control-group">
    <label class="control-label">TDS</label>
    <div class="controls">
        <input type="text" name="tds_amnt" id="tds_amnt" autocomplete="off" onKeyUp="allLetter(this.value,this.id);"  class="span6 m-wrap" />
    </div>
</div>    

<div class="control-group">
    <label class="control-label">Discount</label>
    <div class="controls">
        <input type="text" name="discount" id="discount"  onKeyUp="allLetter(this.value,this.id);"  class="span6 m-wrap" />
    </div>
</div>    


<div class="control-group">
    <label class="control-label">Narration</label>
    <div class="controls">
        <input type="text" name="narration" class="span6 m-wrap" />
    </div>
</div>  

<div class="form-actions">
    <button type="submit"   class="btn green" name="receipt_submit"/><i class="icon-ok"></i> Submit</button>
    <button type="reset"   class="btn yellow" /><i class="icon-retweet"></i> Reset</button>
</div>
</div>
</div> 
<input type="hidden" value="<?php echo $max_receipt_id; ?>" name="receipt_id" />
</form>


<table id="sample_tb" style="display:none;">
  <tr class="tr1 preimp">
              <td><div class="controls" id="ledger_name_place"></div></td>
              <td><div class="controls ins_list_place" id="ins_list_place"></div></td>
              <td><input type="text" name="amount[]" placeholder="Amount" id="amnt_place" autocomplete="off"  class="m-wrap amnt_place" onKeyUp="allLetter(this.value,this.id);"/></td>
              <td>
                <a class="btn btn-xs btn-default addrow"  href="#" role='button'><i class="fa fa-plus"></i>+</a>
                <a class="btn btn-xs btn-default deleterow" href="#" role='button'><i class="fa fa-times"></i>-</a>
              </td>
  </tr>
</table>


<?php
}
?>
</div>
</div>
</div>
<!-- BEGIN FOOTER -->

<div class="footer">
    <?php footer();?>
</div>
<?php js(); ?> 

<script type="text/javascript">
$(document).ready(function(){
    $("#ledger_type").change(function(){

     var ledgertype  = $("#ledger_type option:selected").val(); 

     if(ledgertype !== '1')
        {  $('#invoice_list').hide(); }
});


$('.ledger_name').ajaxComplete(function() {
var ins_no = $(this).val();
    var book = $(this);
     $.ajax({ 
            type:"get",
            url:"ajax_page.php",
            data:"ins_no="+ins_no,
            success:function(result)
            { 
             book.closest('tr').find('td:nth-child(2)').html(result);

            }
        });

});


$('.ledger_name').die().live('change',function(e)
{
  var ins_no = $(this).val();
    var book = $(this);
     $.ajax({ 
            type:"get",
            url:"ajax_page.php",
            data:"ins_no="+ins_no,
            success:function(result)
            { 
             book.closest('tr').find('td:nth-child(2)').html(result);

            }
        });
}); 


});
</script>
 <script type="text/javascript">
     $(document).ready(function() {
        
       $(document).on('click','.addrow',function() {
          add_row();
      });

       $(document).on('click','.deleterow',function() {
            $(this).closest('tr').remove();
         });  
    });
  
    function add_row(){
      var tr1=$("#sample_tb tbody tr.tr1").clone();
      $("#main_tb tbody#main_tbody").append(tr1);
        var w=1; var r=1;
      $("#main_tb tbody#main_tbody tr.preimp").each(function(){
      $(this).attr("row_no",w);
     if(r==1){ w++; r=1; }
         });
       }

    function rename_rows(){
      $(document).ready(function() {
      var q=0;
      $("#main_tb tbody#main_tbody tr.preimp").each(function(){
        $(this).find('td:nth-child(3) input').attr('id','rate'+q).rules('add','required');
      q++; });
      });
    }

 
  $(document).on('change','.invoice_list',function() {
         var v = 0;
       $(this).find('option:selected').each(function(){
          v = v + parseFloat($(this).attr('due_amt'));
        });
       $(this).closest('tr').find('td:nth-child(3) input').val(v);
        allamount();
    });

  $(document).on('change','.amnt_place',function() {
      allamount();
  });


  function allamount() { 
     var amount = 0;
     $('#main_tb tbody tr .amnt_place').each(function()
      { amount =amount+ parseFloat($(this).val()); });
      $('#allamount').val(amount);
    }
  
  $(document).on('click',"a[role='button']", function(e) {
     e.preventDefault();
   });
</script>

<?php autocomplete(); ?>
</body>
</html>