<!DOCTYPE html>
<?php
include 'core/init.php';
protect_page();
has_permission(3);
include 'includes/overall/header.php';
?>
<link href="css/bootstrap1.min.css" rel="stylesheet" type="text/css"/>
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
<link href="css/_all-skins.min.css" rel="stylesheet" type="text/css"/>



<section class="content">
    <div class="box" >
        <div class="box-header">
            <h3 class="box-title">Confirm Medical Report</h3>
        </div>
        <div class="row">
            <div class="col-md-3 date form-group">
               <input class="form-control form_datetime col-md-8" data-format="yyyy-MM-dd" type="text" id="ini" name="ini" placeholder="From Date" >
            </div>
            <div class="col-md-3"><input class="form-control form_datetime" type="text" id="fin" name="fin" placeholder="To Date"></div>
            <div class="col-md-6"><button type="button" class="btn btn-default" name="dview" id="dview">View</button>
            <button type="button" class="btn btn-default" style="float:right; margin-right:10%;" name="allview" id="allview">View All</button></div>

        </div>
        <!-- /.box-header -->
        <div class="box-body" id="table_body">
            <?php echo get_all_madical_report($user_data['Laboratory_Id']); ?>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->


<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script>
    
    jQuery(document).ready(function () {
        
        
        jQuery(".form_datetime").datetimepicker({
            format: 'yyyy-mm-dd',
            autoclose: 1,
            todayHighlight: 1,
            minView: 2
        });
        
        
    
        jQuery(function () {
            jQuery('#example1').DataTable();
        });
        
        jQuery("#dview").click(function(){
           var ini=jQuery("#ini").val();
           var fin=jQuery("#fin").val();
           //alert("hello");
           if(ini==="" || fin==="")
           {
               swal('Oops!','Please fillup the both dates', 'error');
           }
           else
           {
               jQuery.ajax({
                   url:'userapi.php',
                   method:'post',
                   data:{'afrom_date':ini,'ato_date':fin},
                   success:function(data){
                       jQuery("#table_body").html(data);
                       jQuery('#example1').DataTable();
                   }
               });
           }
        });
        
        jQuery("#allview").click(function(){
           jQuery.ajax({
                   url:'userapi.php',
                   method:'post',
                   data:{'agetall':1},
                   success:function(data){
                       jQuery("#table_body").html(data);
                       jQuery('#example1').DataTable();
                   }
               });
        });

    });
</script>
<?php include 'includes/overall/footer.php'; ?>
