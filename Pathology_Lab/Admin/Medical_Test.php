<?php
$title = "Medical Test";
$page_title = "Add Medical Tests";
$page_sub_title = "";
require '../Core/init.php';
protect_page();
has_permission(4);
require "Include/overall/header.php";

$dt_title = "Test Available";
?>
<form action="#" method="POST">
    <div class="box">
        <div class="box-header">
            <h2 class="box-title"><?php echo "$dt_title"; ?></h2>
            <button type="button" class="btn btn-primary pull-right" id="add" name="add" style="margin-right: 5px;">
                <i class="fa fa-plus-circle"></i> Add   
            </button>
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="tbl_ds">
            <?php
            echo get_diseases();
            ?> 
        </div>
        <!-- /.box-body -->
    </div>
    <!--Add Desies-->
    <div class="container">
        <!-- Modal
        -->
        <div class="modal fade" id="add_modal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-dialog">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>&nbsp;&nbsp;
                            <h3 class="box-title"><?php echo " Add Medical Test "; ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Test Name</label>
                                        <input type="text" class="form-control" value="" name="testname" id="add_testname" placeholder="Enter test name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" min='0' onkeypress="return event.charCode >= 48" class="form-control" value="" name="price" id="add_price" placeholder="Enter price" required>
                                    </div>

                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Disease Decsription</label>
                                        <textarea class="form-control" style="height:110px;" name="add_decs" id="add_desc"></textarea>

                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <!-- /.col -->
                            </div>
                            <div class="box-footer">
                                <div class="row ">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-size:20px;">Male Age</label>
                                            <button type="button" class="btn btn-primary" id="add_mage" name="add_fage" style="margin-right: 5px;">
                                                <i class="fa fa-plus-circle"></i> Add Age</button>
                                        </div>
                                        <div id='add_mage_div'>
                                            
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-size:20px;">Female Age</label>
                                            <button type="button" class="btn btn-primary" id="add_fage" name="add_fage" style="margin-right: 5px;">
                                                <i class="fa fa-plus-circle"></i> Add Age</button>
                                        </div>
                                        <div id='add_fage_div'>
                                            
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>

                            <!-- /.box-body -->
                            <div class="form-group">

                            </div>

                            <div class="box-footer">
                                <div class="box-footer">
                                    <button type="button" class="btn btn-primary pull-left" id="add_submit" name="add_disease" style="margin-right: 5px;">
                                        <i class="fa fa-plus-circle"></i> Add   
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!--End Add Desies-->

        <!--Edit Desies-->
        <div class="container">

            <div class="modal fade" id="edit_modal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-dialog">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="box-title"><?php echo " Edit Medical Test "; ?></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Test Name</label>
                                            <input type="text" class="form-control" value="" name="edit_testname" id="edit_testname" placeholder="Enter test name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control" value="" name="edit_price" id="edit_price" placeholder="Enter price" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Disease Decsription</label>
                                            <textarea class="form-control" style="height:110px;" name="edit_decs" id="edit_desc"></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <!-- /.col -->
                                </div>

                                <div class="box-footer">
                                    <div class="row ">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size:20px;">Male Age</label>
                                                <button type="button" class="btn btn-primary" id="edit_mage" name="add_fage" style="margin-right: 5px;">
                                                    <i class="fa fa-plus-circle"></i> Add Age</button>
                                            </div>
                                            <div id='edit_mage_div'>
                                                
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size:20px;">Female Age</label>
                                                <button type="button" class="btn btn-primary" id="edit_fage" name="add_fage" style="margin-right: 5px;">
                                                    <i class="fa fa-plus-circle"></i> Add Age</button>
                                            </div>
                                            <div id='edit_fage_div'>
                                                
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                </div>
                                <!-- /.box-body -->
                                <div class="form-group">

                                </div>

                                <div class="box-footer">
                                    <div class="box-footer">
                                        <button type="button" class="btn btn-primary pull-left" id="edit_save" name="save" style="margin-right: 5px;">
                                            <i class="fa fa-save"></i> Save   
                                        </button>
                                        <input type="hidden" id="hid" name="hid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--End Edit Desies-->

            <!--Delete Desies -->
            <form method="POST" action="#">
                <div class="container">
                    <!-- Modal
                    -->
                    <div class="modal fade" id="delete_modal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete Record</h4>
                                </div>
                                <div class="modal-body">
                                    <p style="font-size:150%;">Are you sure want to delete this record ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" name="confirm" id="delete_confirm" value="Confirm" style="margin-right: 5px;">
                                        <i class="fa fa-check-circle"></i> Confirm
                                    </button>
        <!--                                <input type="submit" class="btn btn-default" name="confirm" id="confirm" value="Confirm"></button>-->
                                    <button type="button" class="btn btn-default" name="cancel" id="delete_cancel" value="Cancel">Cancel
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- End Delete Desies-->
            </form>
            <link href="build/css/sweetalert.css" rel="stylesheet" type="text/css"/>
            <script src="build/js/sweetalert.min.js" type="text/javascript"></script>
            <script>

                var i = 0, j = 0;
                jQuery(document).ready(function ()
                {
                    jQuery('#tabledata').DataTable();
                    
                    /*jQuery('#add_modal').on('hidden.bs.modal', '.modal', function () {
                        $(this).removeData('bs.modal');
                    });*/

                    function dttable()
                    {
                        //$('#add_modal').modal('hide');
                        //$('#add_modal').removeData('bs.modal');
                        jQuery.ajax({
                            url: "adminapi.php",
                            method: "post",
                            data: {tbody: 1},
                            success: function (tbdata) {
                                var obj = JSON.parse(tbdata);
                                //alert(obj['tbhtml']);
                                jQuery("#tbl_ds").html(obj['tbhtml']);
                                jQuery('#tabledata').DataTable();
                            },
                            error: function () {
                                alert("error");
                            }
                        });
                        //jQuery('#tabledata').DataTable();
                    }

                    jQuery("#add").click(function () {
                        jQuery("#add_modal").modal('show');

                    });

                    jQuery("#add_submit").click(function () {
                        var testname = jQuery("#add_testname").val();
                        var price = jQuery("#add_price").val();
                        var decs = jQuery("#add_desc").val();


                        //var mdemo="";
                        //var fdemo="";
                        var merror = 0;
                        var ferror = 0;
                        var j = '{"mdata":[],"fdata":[]}';
                        var obj = JSON.parse(j);

                        jQuery(".maleage").each(function () {
                            var id = jQuery(this).attr("mage_id");
                            var mtest = jQuery("#mtest_" + id + "").val();
                            var munit = jQuery("#munit_" + id + "").val();
                            var mage_from = jQuery("#mage_from_" + id + "").val();
                            var mage_to = jQuery("#mage_to_" + id + "").val();
                            var mrange_from = jQuery("#mrange_from_" + id + "").val();
                            var mrange_to = jQuery("#mrange_to_" + id + "").val();

                            if (mtest == "" && munit == "" && mage_from == "" && mage_to == "" && mrange_from == "" && mrange_to == "")
                            {
                                merror = 1;
                            }
                            obj['mdata'].push({"test": mtest, "unit": munit, "age_from": mage_from, "age_to": mage_to, "range_from": mrange_from, "range_to": mrange_to});
                            //mdemo=JSON.stringify(obj['mdata']);
                        });

                        jQuery(".femaleage").each(function () {
                            var id = jQuery(this).attr("fage_id");
                            var ftest = jQuery("#ftest_" + id + "").val();
                            var funit = jQuery("#funit_" + id + "").val();
                            var fage_from = jQuery("#fage_from_" + id + "").val();
                            var fage_to = jQuery("#fage_to_" + id + "").val();
                            var frange_from = jQuery("#frange_from_" + id + "").val();
                            var frange_to = jQuery("#frange_to_" + id + "").val();



                            if (ftest == "" && funit == "" && fage_from == "" && fage_to == "" && frange_from == "" && frange_to == "")
                            {
                                ferror = 1;
                            }
                            obj['fdata'].push({"test": ftest, "unit": funit, "age_from": fage_from, "age_to": fage_to, "range_from": frange_from, "range_to": frange_to});
                            //fdemo=JSON.stringify(obj['fdata']);
                        });

                        //alert('male data :'+mdemo);
                        //alert('femalw data :'+fdemo);
                        //swal("Here's the title!",testname);
                        if (testname === "" || price === "" || decs === "" || merror != '0' || ferror != '0')
                        {
                            swal("Oops!", "All fields are required", "error");
                        } else
                        {
                            //alert("OK");
                            //if(jQuery.isEmptyObject(obj['mdata'])){mdemo="";}
                            //if(jQuery.isEmptyObject(obj['fdata'])){fdemo="";}
                            jQuery.ajax({
                                url: "adminapi.php",
                                method: "post",
                                data: {add: 1, testname: testname, price: price, decs: decs, mdemo: obj['mdata'], fdemo: obj['fdata']},
                                success: function (pdata) {
                                    var obj = JSON.parse(pdata);

                                    if (obj['rtn'])
                                    {
                                        dttable();
                                        jQuery("#add_modal").modal('hide');
                                        i = 0;
                                        j = 0;
                                        swal("Good job!", "You clicked the button!", "success");
                                    } else
                                    {
                                        swal("Oops!", "Something goes wrong", "error");
                                    }
                                }
                            });
                        }

                        //alert(testname);
                        //swal("Here's the title!","hello");  
                    });

                    jQuery(document).on('click', 'button.btn[dataedit]', function () {
                        i = 0;
                        j = 0;
                        var id = jQuery(this).attr('data-id');
                        //jQuery("#edit_modal").modal('show');
                        jQuery.ajax({
                            url: "adminapi.php",
                            method: "post",
                            data: {eid: id},
                            success: function (pdata) {
                                //var obj = [];
                                var obj = JSON.parse(pdata);

                                var mstr = [];
                                var fstr = [];
                                var rtn = [];

                                //medotary data
                                jQuery.each(obj[0], function (index, val) {
                                    rtn[index] = val;
                                });

                                jQuery("#edit_testname").val(rtn['ds_name']);
                                jQuery("#edit_price").val(rtn['price']);
                                jQuery("#edit_desc").val(rtn['description']);
                                jQuery("#hid").val(rtn['ds_id']);

                                jQuery('#edit_mage_div').html("");
                                jQuery('#edit_fage_div').html("");
                                var mdata = obj[1];
                                for (var p = 0; p < mdata.length; p++)
                                {
                                    jQuery.each(mdata[p], function (index, value) {
                                        mstr[index] = value;
                                        //alert(index +"  "+value);
                                    });
                                    jQuery('#edit_mage_div').append("<div editmage_id='" + i + "' class='form-group editmaleage'>\n\
                                                \n\<div class='row'><div class='col-sm-5'><input type='text' class='form-control' name='mtest[]' id='editmtest_" + i + "' placeholder='Test Name' value='" + mstr["test"] + "'></div>\n\
                                                <div class='col-sm-5'><input type='text' class='form-control' name='munit[]' id='editmunit_" + i + "' placeholder='Unit' value='" + mstr["unit"] + "'></div><div class='col-sm-2'><a href='#' class='remove_mage'><i class='fa fa-times-circle fa-lg'></i></a></div></div>\n\
                                    <div class='row'><div class='col-sm-5'><input type='number' min='0' class='form-control' name='mage_from[" + i + "]' id='editmage_from_" + i + "' placeholder='Age from' value='" + mstr["age_from"] + "'></div>\n\
                                                <div class='col-sm-5'><input type='number' min='0' class='form-control' name='mage_to[" + i + "]' id='editmage_to_" + i + "' placeholder='Age to' value='" + mstr["age_to"] + "'></div></div>\n\
                                                <input type='number' min='0' class='form-control' name='mrange_from[" + i + "]' id='editmrange_from_" + i + "' placeholder='Range to' value='" + mstr["range_from"] + "'>\n\
                                                <input type='number' min='0' class='form-control' name='mrange_to[" + i + "]' id='editmrange_to_" + i + "' placeholder='Range to' value='" + mstr["range_to"] + "'></div>");

                                    i++;
                                }

                                var fdata = obj[2];
                                for (var p = 0; p < fdata.length; p++)
                                {
                                    jQuery.each(fdata[p], function (index, value) {
                                        fstr[index] = value;
                                    });
                                    jQuery('#edit_fage_div').append("<div editfage_id='" + j + "' class='form-group editfemaleage'>\n\
                                                \n\<div class='row'><div class='col-sm-5'><input type='text' class='form-control' name='ftest[]' id='editftest_" + j + "' placeholder='Test Name' value='" + fstr["test"] + "'></div>\n\
                                                <div class='col-sm-5'><input type='text' class='form-control' name='funit[]' id='editfunit_" + j + "'+ placeholder='Unit' value='" + fstr["unit"] + "'></div><div class='col-sm-2'><a href='#' class='remove_fage'><i class='fa fa-times-circle fa-lg'></i></a></div></div>\n\
                                    <div class='row'><div class='col-sm-5'><input type='number' min='0' class='form-control' name='fage_from[]' id='editfage_from_" + j + "' placeholder='Age from' value='" + fstr["age_from"] + "'></div>\n\
                                                <div class='col-sm-5'><input type='number' min='0' class='form-control' name='fage_to[]' id='editfage_to_" + j + "' placeholder='Age to' value='" + fstr["age_to"] + "'></div></div>\n\
                                                <input type='number' min='0' class='form-control' name='frange_from[]' id='editfrange_from_" + j + "' placeholder='Range to' value='" + fstr["range_from"] + "'>\n\
                                                <input type='number' min='0' class='form-control' name='frange_to[]' id='editfrange_to_" + j + "' placeholder='Range to' value='" + fstr["range_to"] + "'></div>");

                                    j++;

                                }
                                jQuery("#edit_modal").modal('show');
                            }
                        });
                    });

                    jQuery("#edit_save").click(function(){
                        //alert("hello");
                        var testname = jQuery("#edit_testname").val();
                        var price = jQuery("#edit_price").val();
                        var decs = jQuery("#edit_desc").val();                                                                                                                                                               
                        var id=jQuery("#hid").val();
                        
                        //alert(id);


                        var merror = 0;
                        var ferror = 0;
                        var j = '{"mdata":[],"fdata":[]}';
                        var obj = JSON.parse(j);

                        jQuery(".editmaleage").each(function () {
                            var id = jQuery(this).attr("editmage_id");
                            var mtest = jQuery("#editmtest_" + id + "").val();
                            var munit = jQuery("#editmunit_" + id + "").val();
                            var mage_from = jQuery("#editmage_from_" + id + "").val();
                            var mage_to = jQuery("#editmage_to_" + id + "").val();
                            var mrange_from = jQuery("#editmrange_from_" + id + "").val();
                            var mrange_to = jQuery("#editmrange_to_" + id + "").val();

                            if (mtest == "" && munit == "" && mage_from == "" && mage_to == "" && mrange_from == "" && mrange_to == "")
                            {
                                merror = 1;
                            }
                            obj['mdata'].push({"test": mtest, "unit": munit, "age_from": mage_from, "age_to": mage_to, "range_from": mrange_from, "range_to": mrange_to});
                            //mdemo=JSON.stringify(obj['mdata']);
                        });

                        jQuery(".editfemaleage").each(function () {
                            var id = jQuery(this).attr("editfage_id");
                            var ftest = jQuery("#editftest_" + id + "").val();
                            var funit = jQuery("#editfunit_" + id + "").val();
                            var fage_from = jQuery("#editfage_from_" + id + "").val();
                            var fage_to = jQuery("#editfage_to_" + id + "").val();
                            var frange_from = jQuery("#editfrange_from_" + id + "").val();
                            var frange_to = jQuery("#editfrange_to_" + id + "").val();



                            if (ftest == "" && funit == "" && fage_from == "" && fage_to == "" && frange_from == "" && frange_to == "")
                            {
                                ferror = 1;
                            }
                            obj['fdata'].push({"test": ftest, "unit": funit, "age_from": fage_from, "age_to": fage_to, "range_from": frange_from, "range_to": frange_to});
                            //fdemo=JSON.stringify(obj['fdata']);
                        });

                        //alert(mdemo);
                        //alert(fdemo);


                        //swal("Here's the title!",testname);
                        if (testname === "" || price === "" || decs === "" || merror != '0' || ferror != '0')
                        {
                            swal("Oops!", "All fields are required", "error");
                        } else
                        {
                            jQuery.ajax({
                                url: "adminapi.php",
                                method: "post",
                                data: {edit: 1, testname: testname, price: price, decs:decs , mdemo:obj['mdata'], fdemo:obj['fdata'] , editid:id},
                                success: function (pdata) {
                                    var obj = JSON.parse(pdata);
                                    
                                    
                                    if (obj['rtn'])
                                    {
                                        dttable();
                                        i = 0;
                                        j = 0;
                                        swal("Good job!", "Record Update Successfully!", "success");

                                    } else
                                    {
                                        swal("Oops!", "Something goes wrong", "error");
                                    }
                                }
                            });
                        }
                     });

                     jQuery(document).on('click','button.btn[datadelete]',function(){
                            var id = jQuery(this).attr('data-id');
                            jQuery("#delete_modal").modal('show');

                            jQuery("#delete_confirm").click(function(){
                            jQuery.ajax({
                                url:"adminapi.php",
                                method:"post",
                                data:{dlid:id},
                                success:function(pdata){
                                    var obj=JSON.parse(pdata);
                                    //alert(obj['ok']);
                                    if(obj['ok'])
                                    {
                                        //alert('ok');
                                        dttable();
                                        jQuery("#delete_modal").modal('hide');
                                        swal("Delete Record!", "Record delete successfully!", "success");
                                    }
                                }
                            });

                            });
                            jQuery("#delete_cancel").click(function(){
                            jQuery("#delete_modal").modal('hide'); 
                            });

                     });
                    //ADD MALE AGE
                    jQuery("#add_mage").click(function(){
                        jQuery('#add_mage_div').append("<div mage_id='" + i + "' class='form-group maleage'>\n\
                            \n\<div class='row'><div class='col-sm-5'><input type='text' class='form-control' name='mtest[]' id='mtest_" + i + "' placeholder='Test Name'></div>\n\
                            <div class='col-sm-5'><input type='text' class='form-control' name='munit[]' id='munit_" + i + "' placeholder='Unit'></div><div class='col-sm-2'><a href='#' class='remove_mage'><i class='fa fa-times-circle fa-lg'></i></a></div></div>\n\
                <div class='row'><div class='col-sm-5'><input type='number' min='0' class='form-control' name='mage_from[" + i + "]' id='mage_from_" + i + "' placeholder='Age from'></div>\n\
                            <div class='col-sm-5'><input type='number' min='0' class='form-control' name='mage_to[" + i + "]' id='mage_to_" + i + "' placeholder='Age to'></div></div>\n\
                            <input type='number' min='0' class='form-control' name='mrange_from[" + i + "]' id='mrange_from_" + i + "' placeholder='Range to'>\n\
                            <input type='number' min='0' class='form-control' name='mrange_to[" + i + "]' id='mrange_to_" + i + "' placeholder='Range to'></div>");
                                                //alert('hello');
                                                i++;
                    });

                    //DELETE MALE AGE
                    jQuery("#add_mage_div").on("click", ".remove_mage", function () { //user click on remove text
                        $(this).closest('.maleage').remove();
                        // i--;
                    });


                    //ADD FEMALE AGE
                    jQuery("#add_fage").click(function(){
                        jQuery('#add_fage_div').append("<div fage_id='" + j + "' class='form-group femaleage'>\n\
                            \n\<div class='row'><div class='col-sm-5'><input type='text' class='form-control' name='ftest[]' id='ftest_" + j + "' placeholder='Test Name'></div>\n\
                            <div class='col-sm-5'><input type='text' class='form-control' name='funit[]' id='funit_" + j + "'+ placeholder='Unit'></div><div class='col-sm-2'><a href='#' class='remove_fage'><i class='fa fa-times-circle fa-lg'></i></a></div></div>\n\
                <div class='row'><div class='col-sm-5'><input type='number' min='0' class='form-control' name='fage_from[]' id='fage_from_" + j + "' placeholder='Age from'></div>\n\
                            <div class='col-sm-5'><input type='number' min='0' class='form-control' name='fage_to[]' id='fage_to_" + j + "' placeholder='Age to'></div></div>\n\
                            <input type='number' min='0' class='form-control' name='frange_from[]' id='frange_from_" + j + "' placeholder='Range to'>\n\
                            <input type='number' min='0' class='form-control' name='frange_to[]' id='frange_to_" + j + "' placeholder='Range to'></div>");
                                                //alert('hello');
                                                j++;
                    });

                    //REMOVE ADD FEMALE AGE
                    jQuery("#add_fage_div").on("click", ".remove_fage", function () { //user click on remove text
                        $(this).closest('.femaleage').remove();
                        // j--;
                    });


                    //EDIT MALE AGE
                    jQuery("#edit_mage").click(function(){
                        jQuery('#edit_mage_div').append("<div editmage_id='" + i + "' class='form-group editmaleage'>\n\
                            \n\<div class='row'><div class='col-sm-5'><input type='text' class='form-control' name='mtest[]' id='editmtest_" + i + "' placeholder='Test Name'></div>\n\
                            <div class='col-sm-5'><input type='text' class='form-control' name='munit[]' id='editmunit_" + i + "' placeholder='Unit'></div><div class='col-sm-2'><a href='#' class='remove_mage'><i class='fa fa-times-circle fa-lg'></i></a></div></div>\n\
                <div class='row'><div class='col-sm-5'><input type='number' min='0' class='form-control' name='mage_from[" + i + "]' id='editmage_from_" + i + "' placeholder='Age from'></div>\n\
                            <div class='col-sm-5'><input type='number' min='0' class='form-control' name='mage_to[" + i + "]' id='editmage_to_" + i + "' placeholder='Age to'></div></div>\n\
                            <input type='number' min='0' class='form-control' name='mrange_from[" + i + "]' id='editmrange_from_" + i + "' placeholder='Range to'>\n\
                            <input type='number' min='0' class='form-control' name='mrange_to[" + i + "]' id='editmrange_to_" + i + "' placeholder='Range to'></div>");
                                                //alert('hello');
                                                i++;
                    });

                    //DELETE EDIT MALE AGE
                    jQuery("#edit_mage_div").on("click", ".remove_mage", function () { //user click on remove text
                        $(this).closest('.editmaleage').remove();
                        // i--;
                    });


                    //ADD FEMALE AGE
                    jQuery("#edit_fage").click(function(){
                        jQuery('#edit_fage_div').append("<div editfage_id='" + j + "' class='form-group editfemaleage'>\n\
                            \n\<div class='row'><div class='col-sm-5'><input type='text' class='form-control' name='ftest[]' id='editftest_" + j + "' placeholder='Test Name'></div>\n\
                            <div class='col-sm-5'><input type='text' class='form-control' name='funit[]' id='editfunit_" + j + "'+ placeholder='Unit'></div><div class='col-sm-2'><a href='#' class='remove_fage'><i class='fa fa-times-circle fa-lg'></i></a></div></div>\n\
                <div class='row'><div class='col-sm-5'><input type='number' min='0' class='form-control' name='fage_from[]' id='editfage_from_" + j + "' placeholder='Age from'></div>\n\
                            <div class='col-sm-5'><input type='number' min='0' class='form-control' name='fage_to[]' id='editfage_to_" + j + "' placeholder='Age to'></div></div>\n\
                            <input type='number' min='0' class='form-control' name='frange_from[]' id='editfrange_from_" + j + "' placeholder='Range to'>\n\
                            <input type='number' min='0' class='form-control' name='frange_to[]' id='editfrange_to_" + j + "' placeholder='Range to'></div>");
                                                //alert('hello');
                                                j++;
                    });

                    //REMOVE EDIT FEMALE AGE
                    jQuery("#edit_fage_div").on("click", ".remove_fage", function () { //user click on remove text
                        $(this).closest('.editfemaleage').remove();
                        // j--;
                    });


                });                           
            </script>
            <?php
            include "Include/overall/footer.php";
            ?>