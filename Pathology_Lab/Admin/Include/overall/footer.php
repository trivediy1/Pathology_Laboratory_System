
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include "Include/footer.php"?>
</div>
<?php
include 'Include/scripts.php';
?>
<!-- ./wrapper -->



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
<script>
    
  

    $('.form_date').datetimepicker({
            //language: 'fr',
            weekStart: 1,
            todayBtn: 0,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
    });
    
</script>
<?php
ob_flush();
?>