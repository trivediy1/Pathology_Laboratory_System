<?php include 'core/init.php';
include 'includes/overall/header.php';  ?>
<div class="page-header">
    <!--page-header-->
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                <h3 class="page-title">Service Single / Sidebar</h3>
                <h1 class="page-description">We Offer Advanced Pathology Testing Services</h1>
            </div>
        </div>
    </div>
</div>
<!--/.page-header-->
<div class="page-breadcrumb">
    <!-- page-breadcrumb -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Service Single / Sidebar</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--/.page-breadcrumb-->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="feature-blurb">
                    <!--feature-blurb-->
                    <h3>What is a pathologist?</h3>
                    <p>Malesuada nulla eu elit euismorttitor interdum felis semisque idligula elementum augue consectetur suscipit vitaeupibus euismorttitor interdum felis.</p>
                </div>
                <!--/.feature-blurb-->
                <div class="feature-blurb">
                    <!--feature-blurb-->
                    <h3>What does a pathologist do?</h3>
                    <p>Pellentesque vitae pretium enimon iaculis donterdum etmalesuada famesac ante ipsum primis in faucibullam libeorci congue eget lorem acgravida commodo metus. </p>
                </div>
                <!--/.feature-blurb-->
                <div class="feature-blurb">
                    <!--feature-blurb-->
                    <h3>Is pathology a lab test?</h3>
                    <p>Pellentesque vitae pretium enimnon iaculis donterdet malesuada fames acante ipsum primis in fauciullam libero orcicongue eget lorem acgravida commodo metus.</p>
                </div>
                <!--/.feature-blurb-->
                <div class="feature-blurb">
                    <!--feature-blurb-->
                    <h3>What is a biopsy?</h3>
                    <p>Malesuada nulla eu elit euismorttitor interdum felis semisque idligula elementum augue consectetur suscipit vitaeupibus euismorttitor interdum felis.</p>
                </div>
                <!--/.feature-blurb-->
                <div class="feature-blurb">
                    <!--feature-blurb-->
                    <h3>How can I send you my slides?</h3>
                    <p>Nam rutrum dignissim ornareusce euismod loremat dui laoreet sollicitudin consequate ligula suscipi lass aptent taciti sociosqu adlitora serones enoinse.</p>
                </div>
                <!--/.feature-blurb-->
                <div class="feature-blurb">
                    <!--feature-blurb-->
                    <h3>What happens after I get my test results?</h3>
                    <p>Vivamus malesuada nulla euelit euismod porttitor interdum felis suisque idligula elementum augue consectetur suscipit vitaeunc dapibus neque sed nibh malesuada.</p>
                </div>
                <!--/.feature-blurb-->
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <!--sidebar-->
                    <div class="appointment-block">
                        <!--appointment-block-->
                        <div class="bg-default widget-appointments">
                            <!--widget-appointments-->
                            <div class=" ">
                                <h2 class="mb20">Book Home Visit</h2>
                            </div>
                            <form class="form-horizontal" method="post" action="booking-form.php">
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label" for="Name"> </label>
                                    <div class="col-md-12">
                                        <input id="Name" name="Name" type="text" placeholder="Your Name" class="form-control input-md" required>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label" for="Email"> </label>
                                    <div class="col-md-12">
                                        <input id="Email" name="Email" type="email" placeholder="Email Address" class="form-control input-md" required>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label" for="Phone"> </label>
                                    <div class="col-md-12">
                                        <input id="Phone" name="Phone" type="text" placeholder="Phone No" class="form-control input-md" required>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="control-label" for="City"> </label>
                                    <div class="col-md-12">
                                        <select id="City" name="City" class="form-control" required>
                                            <option value="New York">New York</option>
                                            <option value="Chicago">Chicago</option>
                                            <option value="Los Angeles">Los Angeles</option>
                                            <option value="Columbus">Columbus</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label" for="datepicker"> </label>
                                    <div class="col-md-12" style="height:54px;">
                                        <div class="input-group date form_date" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" type="text" value="" readonly>
                                            <span class="input-group-addon" style="border-top-right-radius:4px; border-bottom-right-radius:4px;"><i class="fa fa-calendar"></i></span>
                                            <input type="hidden" id="dtp_input2" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="address"> </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button id="singlebutton" name="singlebutton" class="btn btn-default btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/.widget-appointments-->
                    </div>
                    <!--/.appointment-block-->
                </div>
                <!--/.sidebar-->
            </div>
        </div>
    </div>
</div>
<div class="full-cta">
    <!--full-cta-->
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <h2 class="cta-title">Need help or Any question?</h2>
                <p class="text-white">For any help call us on <strong>+(800) 123 - 4567</strong> or request an appoitment online.</p>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <a href="faq.php" class="btn btn-secondary pull-right">Frequently Ask Question</a>
            </div>
        </div>
    </div>
</div>
<!--/.full-cta-->
<?php include 'includes/overall/footer.php'; ?>