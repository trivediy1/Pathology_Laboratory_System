<div class="container">
    <!-- Modal
    -->
    
<div class="modal fade" id="view_profile_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gray-light">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>  
            </div>
            <div class="modal-body">
                <img id="picture" name="picture" class="img-responsive img-circle center-block img-bordered" height="150px" width="150px" src="" alt="User profile picture">

                <h3 class="profile-username text-center"><label for="name"></label></h3>

                <p class="text-muted text-center"><span class="fa fa-envelope-open"> Email :</span> <label for="email"></label></h3>    |  <span class="fa fa-phone"> Contact No :</span> <label for="contact"></label></h3></p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <span class="fa fa-calendar"><b> Date Of Birth</b></span> <a class="pull-right"><label for="dob"></label></h3></a>
                    </li>
                    <li class="list-group-item">
                        <span class="fa fa-address-card"><b> Address</b></span> <a class="pull-right"><label for="address"></label></h3></a>
                    </li>
                    <li class="list-group-item">
                        <span class="fa fa-location-arrow"> <b> City</b></span> <a class="pull-right"><label for="city"></label></h3></a>
                    </li>
                    <li class="list-group-item">
                        <span class="fa fa-money"> <b> Remaining Amount</b></span> <a class="pull-right"><label for="remain_amount"></label></h3></a>
                    </li>
                </ul>

            </div>
            <div class="modal-footer bg-gray-light">
                <button type="button" class="btn btn-default " data-dismiss="modal">Done</button>
                
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function ()
    {
        $("#done").click(function ()
        {
            $("#view_profile_modal").modal("hide");
        });
    });
</script>
