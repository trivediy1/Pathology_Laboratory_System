
<form method="POST" action="#">
    <?php
    if (!empty($_POST)) {
        echo 'hello';
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $city = $_POST['city'];
            $mail = $_POST['mail'];
            $dob = $_POST['dob'];
            $gen = $_POST['gender'];

            echo "Data are :       <br><br>$name,<br> $city,<br> $mail,<br> $dob, <br>$gen ";
             echo "dsjkfhkjf<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>dshgyurtuyfshf";
        }
        
    }
    ?>

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $fm_title; ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <select class="form-control select2" name="city" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="mail" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Multiple</label>
                        <select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
                                style="width: 100%;">
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Disabled Result</label>
                        <select class="form-control select2"  style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option disabled="disabled">California (disabled)</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date of birth:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <p><input type="date" id="datepicker" name="dob" class="form-control"  ></p>
                            <!--<p><input type="text" id="datepicker" name="dob" class="form-control"></p>-->
                            <!--<input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>-->
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="radio" name="gender" class="minimal" value="male" checked>
                            Male
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="gender" class="minimal" value="female">Female
                        </label>                
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
        </div>
    </div>
</form>
