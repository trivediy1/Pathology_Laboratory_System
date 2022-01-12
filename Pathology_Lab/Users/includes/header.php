<div class="header">
    <!--header-->
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo">
                    <a href="index.php"><img src="images/logo.png" alt="" class="img-responsive"></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div id="navigation">
                    <!--navigation-->
                    <?php
                    if (logged_in() == true) {
                        ?>
                        <ul>
                            <li><a href="index" title="Home page">Home</a></li>
                            <li><a href="add_Patient" title="Add Patient">Add Patient</a></li>
                            <li><a>Reports</a>
                                <ul>
                                    <li><a href="all_medical_report" title="Lab Test List">All Medical</a></li>
                                    <li><a href="confirm_madical_report" title="Lab Test List">Confirm Medical</a></li>
                                    <li><a href="payment_report" title="Lab Test Single">Payment</a></li>
                                </ul>
                            </li>
                            <li><a href="PayUMoney_form" title="Add Patient">Make Pament</a></li>
                            <li><a>Account</a>
                                <ul>
                                    <li><a id="vprofile" class='btn' style="text-align:left;" title='View Profile'>View Profile</a></li>
                                    <li><a href="userchangepassword" title="Blog Single">Change Password</a></li>
                                    <li><a id='logout' class='btn' style="text-align:left;" title='LogIn'>Log Out</a></li>
                                </ul>
                            </li> 
                        </ul>

                        
                        <?php
                    } else {
                        ?>
                        <ul>
                            <li><a href="index" title="Home page">Home</a></li>
                            <li><a href="about-us" title="About Us">About us</a></li>
                            <!--<li><a href="test-list.php" title="Lab Test List">Lab Test</a>
                                <ul>
                                    <li><a href="test-list.php" title="Lab Test List">Lab Test List</a></li>
                                    <li><a href="test-single.php" title="Lab Test Single">Test Single / Sidebar</a></li>
                                </ul>
                            </li>-->
                            <li><a href="gallery-filter-3" title="Zoom Gallery">Gallery</a>
                            <!--<li><a href="location.php">Features</a>
                                <ul>
                                    <li> <a href="pricing.php" title="Pricing">Pricing</a> </li>
                                    <li><a href="testimonial.php" title="Testimonials">Testimonials</a></li>
                                    <li><a href="gallery-filter-3.php">Gallery</a>
                                        <ul><li><a href="gallery-zoom.php" title="Zoom Gallery">Zoom Gallery</a></li></ul>
                                    </li> 
                                </ul>
                            </li>-->
                            <li><a href="contact-us" title="Contact us">Contact us</a></li>

                            <li><a href='login' title='LogIn'>LogIn</a></li>
                        </ul>
                    <?php } ?>
                </div>
                <!--/.navigation-->
            </div>
        </div>
    </div>


</div>
<!-- Profile Modal -->
<div id="myModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 id="myModalLabel" class="text-center">Profile</h1>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4"><br><hr></div>
                        <div class="col-xs-4"><img src="../Images/doctor.jpg" class="img-thumbnail img-responsive img-circle"></div>
                        <div class="col-md-4"><br><hr></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">

                            <b><h3 class="text-center" style='padding-bottom:50px;'><?php echo $user_data['Laboratory_Name']." Laboratory"; ?></h3><b>

                            <div class='row' ><div class='col-md-6' >Address</div><div class='col-md-6'><?php echo $user_data['Address'];?></div></div><br/>
                            <div class='row' ><div class='col-md-6' >Contact No</div><div class='col-md-6'><?php echo $user_data['Contact_No'];?></div></div><br/>
                            <div class='row' ><div class='col-md-6' >Email Id</div><div class='col-md-6'><?php echo $user_data['Email_Id'];?></div></div><br/>
                            
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-info">
                <button class="btn btn-lg btn-default center-block" data-dismiss="modal" aria-hidden="true"> OK </button>
            </div>
        </div>
    </div>
</div>

<!--End of Profile -->
<script>
    jQuery(document).ready(function () {
        jQuery("#logout").click(function () {
            jQuery.ajax({
                url: 'userapi.php',
                method: 'post',
                data: {'logout': 1},
                success: function (rtn) {
                    if (rtn)
                    {
                        //alert('hello');
                        window.location.replace("http://localhost/Pathology_Lab/Users/index");
                    }
                }

            });
        });
        jQuery("#vprofile").click(function (e) {
            e.preventDefault();

            jQuery("#myModal").modal('show');
            //location.reload();
        })
    });
</script>
