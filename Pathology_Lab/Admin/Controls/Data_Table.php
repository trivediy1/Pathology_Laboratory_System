<?php ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo "$dt_title"; ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example" class="table table-bordered table-striped ">
            <thead>
                <tr>
<?php
foreach ($dt_headers as $value) {
    echo "<th>$value</th>";
}
?>
                </tr>
            </thead>
            <tbody>
<?php
foreach ($dt_data as $row) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
?>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

<script>
    jQuery(document).ready(function ()
    {
        jQuery('#tabledata').DataTable();
    });
</script>