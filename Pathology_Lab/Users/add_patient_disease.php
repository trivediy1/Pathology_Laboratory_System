<?php
include 'core/init.php';
protect_page();
has_permission(3);
include 'includes/overall/header.php';
?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:25%;">
                <div class="sidebar">
                    <!--sidebar-->
                    <div class="appointment-block">
                        <!--appointment-block-->
                        <div class="bg-default widget-appointments">
                            <!--widget-appointments-->
                            <div class=" ">
                                <h2 class="mb20">Select Disease</h2>
                            </div>
                            <form class="form-horizontal" id="ptndiseas" method="post">
                                <div class="form-group" style="padding-bottom:40px;">

                                    <div class="row">
                                        <div class="col-md-8">
                                            <select id="Diseases" name="Diseases" class="form-control"></select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-primary form-control pull-right" id="add_ds" name="add_ds" style="margin-right: 5px;">
                                                <i class="fa fa-plus-circle"></i> Add   
                                            </button>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="button" id="singlebutton" name="SButton" class="btn btn-default btn-block">Submit</button>
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
<script>
    jQuery(document).ready(function () {
        var i = 0;
        jQuery(getds);
        function getds()
        {
            jQuery.ajax({
                url: 'userapi.php',
                method: 'post',
                data: {'diseas': 1},
                success: function (rtn) {
                    jQuery("#Diseases").html(rtn);
                }
            });
        }

        jQuery(document).on('click','#add_ds',function () {
            var ds_id = jQuery("#Diseases").val();
            //alert(ds_id);
            var ferror=1;
            jQuery(".adddisease").each(function () {
                var id = jQuery("input",this).attr("data-id");
                //var id=jQuery("#psd_"+i+"").val();
                //alert(id);
                if (id==ds_id)
                {
                   ferror=0;
                   swal('Oops!', 'This Diseas Alery Addded', 'error');
                   //alert('wrong');
                   return false;
                   
                }
            });
            if(ferror)
            {
                //alert(ds_id);
                var ds_name = jQuery('option:selected', "#Diseases").attr('ds-name');
                //alert(ds_name);
                //alert(ds_id);
                jQuery("#ptndiseas").append("<div d_id='" + i + "' class='form-group adddisease'>\n\
                                \n\<div class='row'><div class='col-sm-10'><input type='text' class='form-control' name='pds[]' id='pds_" + i + "' data-id=" + ds_id + " value=" + ds_name + "></div>\n\
                                <div class='col-sm-2'><a href='#' class='remove_pds'><i  style='padding-top:5px;' class='fa fa-times-circle fa-2x'></i></a></div></div>");
                i++;
                
            }
            
        });
        jQuery("#ptndiseas").on("click", ".remove_pds", function () { //user click on remove text
            $(this).closest('.adddisease').remove();
            // i--;
        });
         jQuery("#singlebutton").click(function(){
            var j = '{"ddata":[]}';
            var obj = JSON.parse(j);
            var perror=1;
            jQuery(".adddisease").each(function () {
                
                var id = jQuery("input",this).attr("data-id");
                perror=0;
                //alert(id);
                if(id=="")
                {
                    perror=1;
                    return false;
                }
                //var dname = jQuery("input",this).val();
                obj['ddata'].push({"id":id});
            });
            
            if(perror)
            {
                swal('Oops!', 'Please Select Disease', 'error');
            }
            else
            {
                //swal("Good job!", "You clicked the button!", "success");
                    jQuery.ajax({
                        url:'userapi.php',
                        method:'post',
                        data:{'patientdata':1,"pdemo":obj['ddata']},
                        success:function(rtn){
                            if(rtn){
                                swal({
                                title: 'Good job!',
                                text: 'Medical Test Applied Successfully!',
                                icon: 'success',
                                }).then(function(){window.location='index';});
                            }
                               
                        }

                    });
            }
            
            
        });
       
        
        
    });
</script>
<?php
include 'includes/overall/footer.php';
?>