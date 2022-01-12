<!-- Left side column. contains the logo and sidebar -->

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->

        <!-- /.search form -->

        <!-- Sidebar Menu -->
        
        
        <?php
            if(!empty($_SESSION['User_Id']) && $_SESSION['Type_Id']=='1')
            {
            ?>
            <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><?php //echo $_SESSION['User_Id']; ?></li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="index"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li><a href="Doctor_Registration"><i class="fa fa-heartbeat"></i> <span>Registration of Pathologist</span></a></li>
            <li><a href="all_medical_reports_assistance"><i class="fa fa-tint"></i> <span>View Medical Test</span></a></li>
            <li><a href="view_Labs"><i class="fa fa-hospital-o"></i> <span>View Labs</span></a></li>
            <li><a href="view_pathologist"><i class="fa fa-group"></i> <span>View Pathologists</span></a></li>
            <li><a href="report_labs"><i class="fa fa-group"></i> <span>View Report</span></a></li>
            <li><a href="bill_report"><i class="fa fa-hospital-o"></i> <span>View Bills</span></a></li>
            
        </ul>
        <?php } else if(!empty($_SESSION['User_Id']) && $_SESSION['Type_Id']=='2')
        { ?>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><?php //echo $_SESSION['User_Id']; ?></li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="doctor_report_checking"><i class="fa fa-home"></i> <span>Verify Reports</span></a></li>
        </ul>
        <?php } else if(!empty($_SESSION['User_Id']) && $_SESSION['Type_Id']=='4'){
            ?>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><?php //echo $_SESSION['Type_Id']; ?></li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="update_status_of_patient"><i class="fa fa-heartbeat"></i> <span>Get Samples</span></a></li>
            <li><a href="make_report"><i class="fa fa-home"></i> <span>Make Report</span></a></li>
            <li><a href="Medical_Test"><i class="fa fa-hospital-o"></i> <span>Manage Medical Tests</span></a></li>
            <li><a href="all_medical_reports_assistance"><i class="fa fa-hospital-o"></i> <span>Medical Reports</span></a></li>
            <li><a href="bill_report"><i class="fa fa-hospital-o"></i> <span>View Bills</span></a></li>
        </ul>
        <?php } ?>
        
       
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>