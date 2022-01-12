<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>
<div class="page-header">
    <!--page-header-->
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                <h3 class="page-title">Contact Us</h3>
                <h1 class="page-description">Have A Question? Drop Us A Line.</h1>
            </div>
        </div>
    </div>
</div>
<!--/.page-header-->
<div class="page-breadcrumb">
    <!--page-breadcrumb-->
    <!-- page-breadcrumb -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index">Home</a></li>
                    <li class="active">Contact Us</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--/.page-breadcrumb-->

<div class="space-medium">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="well-block contact-info">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                            <div class="address-block">
                                <div class="contact-icon">
                                    <i class="fa  fa-map-marker"></i></div>
                                <h3 class="contact-title">Address</h3>
                                <address>
                                    Beside Lalani Ent.,Station Road, Kamrej, Surat
                                </address>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                            <div class="call-block">
                                <div class="contact-icon">
                                    <i class="fa  fa-phone"></i></div>
                                <h3 class="contact-title">Call Us</h3>
                                <div class="contact-content"> <span class="call-no"><p></p></span>
                                    <span class="call-no"><strong>Yagnik Trivedi - </strong><p>+91 9408282696</p></span>
                                    <span class="call-no"><strong>Gautam Purohit - </strong><p>+91 9974554401</p></span></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                            <div class="mail-block">
                                <div class="contact-icon">
                                    <i class="fa  fa-envelope"></i></div>

                                <h3 class="contact-title">Email Us</h3>
                                <div class="contact-content">
                                    <strong>info@pathologylab.com</strong>
                                    <p>send us email</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/.full-cta-->
<script>
    function initMap() {
        var myLatLng = {
            lat: 23.0225,
            lng: 72.5714
        };

        var map = new google.maps.Map(document.getElementById('googleMap'), {
            zoom: 8,
            center: myLatLng,
            scrollwheel: false,

        });
        var image = 'images/map-pin.png';
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: image,
            title: 'Hello World!'

        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?&amp;callback=initMap" async defer></script>
<?php include 'includes/overall/footer.php'; ?>
