<?php
$title = "Pathologist";
$page_title = "Pathologist";
$page_sub_title = "";
require '../Core/init.php';
protect_page();
has_permission(1);
require "Include/overall/header.php";
?>

<form action="#" method="POST">
    <h2 class="page-header bg-lig"></h2>
    <div class="row" id="content">
        <?php echo view_pathologist(); ?>
    </div>
</form>
<script>
</script>
<?php
include "Include/overall/footer.php";
?>