<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <div class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Hello <b id="member_type"><b>!</span>
    </div>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">Pathology Labs</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            
                            <p id="profile_img" style="margin-bottom:0;"></p>
                                <small id="profile_type">Owner since Dec. 2017</small>
                            
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#"></a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#"></a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#"></a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="change_password" class="btn btn-default btn-flat">Change Password</a>
                            </div>
                            <div class="pull-right">
                                <a id='singout' class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    
</header>
<script>
    jQuery(document).ready(function(){
        welcome();
        function welcome()
        {
            
            jQuery.ajax({
                url:'adminapi.php',
                method:'post',
                data:{'profile':1},
                success:function(data){
                    var obj=JSON.parse(data);
                    jQuery("#profile_img").html(obj['name']);
                    jQuery("#profile_type").html(obj['person']);
                    jQuery("#member_type").html(obj['person']);
                }
            });
            
        }
        jQuery("#singout").click(function(){
            jQuery.ajax({
                url:'adminapi.php',
                method:'post',
                data:{'singout':1},
                success:function(rtn){
                    if(rtn)
                    {
                        window.location.replace("http://localhost/Pathology_Lab/Users/index");
                    }
                    
                }
            });
        })
    })
</script>