<!DOCTYPE html>
<?php include("../class/class.php");?>
<?php 
if($_SESSION['ls_Number']=="") 
{ 
    $_SESSION['ls_Number']=CnumberIV();
    
    $table="losale";
    $column="ls_Staff, ls_Code, ls_Number";
    $valuei="'".$_SESSION['member']['lu_id']."', '".CodeS()."', '".$_SESSION['ls_Number']."' ";
    $in=oInsert($table,$column,$valuei);
    $_SESSION['ls_Id']=$in;
    //echo "<script>alert('ทำรายการสำเร็จ');</script>";
} 
?>

<html lang="en" class="no-js">

<head>
    <title>Gradient Able bootstrap admin template by codedthemes </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="../files/bower_components/select2/css/select2.min.css" />
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="../files/bower_components/multiselect/css/multi-select.css" />
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/jquery.mCustomScrollbar.css">

    <!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/css/component.css">
    <style>
.containes {
        width: 100%;
        height:  341px;
        overflow: scroll; /* showing scrollbars */
  }  

</style>
</head>

<body onload="onload()">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?php include("inc-nav.php");?>

            <!-- Sidebar inner chat end-->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php include("inc-menu.php");?>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page body start -->
                                    <div class="page-body">

                                        <div class="card">
                                            <div class="card-block">
                                                <h4 class="sub-title"><button class="btn btn-out-dashed btn-primary btn-square waves-effect md-trigger" data-modal="modal-3">ดูรหัสการขาย</button>
                                                </h4>
                                                <!--                                                <form>-->
                                                <div class="form-group row">
                                                    <div class="col-3">
                                                        <input type="hidden" name="myInput" id="lotoType" class="form-control" placeholder="รหัส" maxlength="1" required>
                                                        <input type="text" name="myInput" id="lt_NameShow" class="form-control form-txt-danger" placeholder="รหัส" style="font-weight : bold;" autocomplete="off">
                                                        <!--                                                            <span id="lt_NameShow"></span>-->
                                                    </div>
                                                    <div class="col-sm-3" id="div1">
                                                        <input type="text" name="summaryT2" id="lotoNumber" class="form-control SNumber" placeholder="เลข" maxlength="3" required autocomplete="off">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" id="lotoYes" placeholder="ราคา" required autocomplete="off">
                                                        <input type="hidden" class="form-control" id="lotoBoth" placeholder="โต๊ด" required>
                                                    </div>
                                                    <!--
                                                    <div class="col-2">
                                                        <input type="number" class="form-control" id="lotoBoth" placeholder="โต๊ด" required>
                                                    </div>
-->
                                                    <!--
                                                    <div class="col-3">
                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <div class="checkbox-fade fade-in-primary">
                                                                    <button class="btn btn-out-dashed btn-primary btn-square waves-effect md-trigger" data-modal="modal-4">คืนเลข</button>
                                                                   
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
-->


                                                </div>
                                                <!--                                                </form>-->
                                            </div>
                                        </div>
                                        <form action="../class/sql-insert.php" method="post">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>รายการที่ซื้อแล้ว 
                                                    </h5>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="fa fa-chevron-left"></i></li>
                                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                                            <li><i class="fa fa-times close-card"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive containes">

                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>ประเภท</th>
                                                                    <th>เลข</th>
                                                                    <th>ราคา</th>
                                                                    <th>ลบ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="diva">

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                                <div class="card-block table-border-style text-right">



                                                    <div class="form-group row">
                                                        <div class="col-sm-8">
                                                            <span>ยอดซื้อ</span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" id="Number1" class="form-control form-txt-danger">
                                                        </div>
                                                    </div>
                                                    <!--
                                                    <div class="form-group row">
                                                        <div class="col-sm-8">
                                                            <span>ลด 30 %</span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" id="Number2" class="form-control form-txt-danger">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-8">
                                                            <span>ยอดซื้อสุทธิ</span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" id="Number3" class="form-control form-txt-danger">
                                                        </div>
                                                    </div>
-->
                                                    <input type="hidden" name="Mode" value="end">


                                                    <button class="btn btn-out-dashed btn-primary btn-square">ยืนยันการซื้อ</button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                    <!-- Page body end -->
                                    <div class="md-modal md-effect-3" id="modal-3">
                                        <div class="md-content">
                                            <h3>รหัสการเเทง</h3>
                                            <div>

                                                <div class="page-body">
                                                    <!-- Filtering Foo-table card start -->
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>แสดงรหัสทั้งหมด</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <table id="demo-foo-filtering" class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Code</th>
                                                                        <th data-breakpoints="xs">ความหมาย</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                        $valuei="SELECT * FROM lotype ORDER BY lt_Id ASC";
                                                        foreach (c_scelectS($valuei) as $r) {
                                                        ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $r['lt_Id'];?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $r['lt_Name'];?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php }?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- Filtering Foo-table card end -->
                                                </div>

                                                <button type="button" class="btn btn-primary waves-effect md-close">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md-modal md-effect-3" id="modal-4">
                                        <div class="md-content">
                                            <h3>รหัสการเเทง</h3>
                                            <div>

                                                <div class="page-body">
                                                    <!-- Filtering Foo-table card start -->

                                                    <form>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label">ประเภท</label>
                                                            <div class="col-sm-8">
                                                                <select name="select" class="form-control" required>
                                                                    <option value="">เลือกประเภท</option>
                                                                    <?php 
                                                                $valuei="SELECT * FROM lotype ORDER BY lt_Id ASC";
                                                                foreach (c_scelectS($valuei) as $r) {
                                                                ?>
                                                                    <option value="<?php echo $r['lt_Id'];?>">
                                                                        <?php echo $r['lt_Name'];?>
                                                                    </option>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label">เลขที่ต้องการคืน</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>



                                                    </form>
                                                    <!-- Filtering Foo-table card end -->
                                                </div>

                                                <button type="button" class="btn btn-primary waves-effect md-close">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md-overlay"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        var Numr = 1;
        var input = document.getElementById("lt_NameShow");
        input.addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("lotoType").value = $("#lt_NameShow").val();
                $.ajax({
                    url: "../Class/class.php",
                    global: false,
                    type: "POST",
                    data: ({
                        id: $("#lt_NameShow").val(),
                        Mode: "chType"
                    }),
                    dataType: "JSON",
                    async: false,
                    success: function(jd) {
                        $.each(jd, function(key, val) {

                            if (val["lt_Id"] == 1) {
                                var div1 = '<input type="text" name="summaryT2" id="lotoNumber" class="form-control SNumber" placeholder="เลข" maxlength="3" required >';
                                document.getElementById("lotoBoth").disabled = false;
                                $('#div1').empty();
                                $('#div1').append(div1);
                                document.getElementById("lt_NameShow").value = val["lt_Name"];
                                document.getElementById("lotoNumber").focus();

                                var input2 = document.getElementById("lotoNumber");
                                input2.addEventListener("keyup", function(event) {
                                    event.preventDefault();
                                    if (event.keyCode === 13) {
                                        if($("#lotoNumber").val().length!=3){
                                            document.getElementById("lotoNumber").focus();
                                        }else{
                                            document.getElementById("lotoYes").focus();
                                        }
                                        
                                        
                                    }
                                });
                                var input3 = document.getElementById("lotoYes");
                                input3.addEventListener("keyup", function(event) {
                                    event.preventDefault();
                                    if (event.keyCode === 13) {
                                        addDiv2();
                                    }
                                });


                            }
                            if (val["lt_Id"] == 2 || val["lt_Id"] == 3) {
                                var div1 = '<input type="text" name="summaryT2" id="lotoNumber" class="form-control SNumber" placeholder="เลข" maxlength="3" required>';
                                document.getElementById("lotoBoth").disabled = true;
                                $('#div1').empty();
                                $('#div1').append(div1);
                                document.getElementById("lt_NameShow").value = val["lt_Name"];
                                document.getElementById("lotoNumber").focus();

                                var input2 = document.getElementById("lotoNumber");
                                input2.addEventListener("keyup", function(event) {
                                    event.preventDefault();
                                    if (event.keyCode === 13) {
                                        if($("#lotoNumber").val().length!=3){
                                            document.getElementById("lotoNumber").focus();
                                        }else{
                                            document.getElementById("lotoYes").focus();
                                        }
                                    }
                                });
                                var input3 = document.getElementById("lotoYes");
                                input3.addEventListener("keyup", function(event) {
                                    event.preventDefault();
                                    if (event.keyCode === 13) {
                                        addDiv2();
                                    }
                                });

                            }
                            if (val["lt_Id"] == 4 || val["lt_Id"] == 5) {
                                var div1 = '<input type="text" name="summaryT2" id="lotoNumber" class="form-control SNumber" placeholder="เลข" maxlength="2" required>';
                                document.getElementById("lotoBoth").disabled = true;

                                $('#div1').empty();
                                $('#div1').append(div1);
                                document.getElementById("lt_NameShow").value = val["lt_Name"];
                                document.getElementById("lotoNumber").focus();

                                var input2 = document.getElementById("lotoNumber");
                                input2.addEventListener("keyup", function(event) {
                                    event.preventDefault();
                                    if (event.keyCode === 13) {
                                        if($("#lotoNumber").val().length!=2){
                                            document.getElementById("lotoNumber").focus();
                                        }else{
                                            document.getElementById("lotoYes").focus();
                                        }
                                    }
                                });
                                var input3 = document.getElementById("lotoYes");
                                input3.addEventListener("keyup", function(event) {
                                    event.preventDefault();
                                    if (event.keyCode === 13) {
                                        addDiv2();
                                    }
                                });

                            }
                            if (val["lt_Id"] == 6 || val["lt_Id"] == 7) {
                                var div1 = '<input type="text" name="summaryT2" id="lotoNumber" class="form-control SNumber" placeholder="เลข" maxlength="1" required>';
                                document.getElementById("lotoBoth").disabled = true;

                                $('#div1').empty();
                                $('#div1').append(div1);
                                document.getElementById("lt_NameShow").value = val["lt_Name"];
                                document.getElementById("lotoNumber").focus();

                                var input2 = document.getElementById("lotoNumber");
                                input2.addEventListener("keyup", function(event) {
                                    event.preventDefault();
                                    if (event.keyCode === 13) {
                                        if($("#lotoNumber").val().length!=1){
                                            document.getElementById("lotoNumber").focus();
                                        }else{
                                            document.getElementById("lotoYes").focus();
                                        }
                                    }
                                });
                                var input3 = document.getElementById("lotoYes");
                                input3.addEventListener("keyup", function(event) {
                                    event.preventDefault();
                                    if (event.keyCode === 13) {
                                        addDiv2();
                                        
                                    }
                                });

                            }

                        });
                        	

                        
                    }
                });

            }
            exit();
            
        });
        function onload() {
            document.getElementById("lt_NameShow").focus();
        }

        function addDiv2() {
            $('#diva').empty();  
            var lotoType = $("#lotoType").val();
            var lotoNumber = $("#lotoNumber").val();
            var lotoYes = $("#lotoYes").val();
            var lotoBoth = $("#lotoBoth").val();


            $.ajax({
                url: "../Class/sql-insert.php",
                global: false,
                type: "POST",
                data: ({
                    Mode: "byLoto",
                    Type: lotoType, 
                    Number: lotoNumber , 
                    Price : lotoYes, 
                    lotoBoth : lotoBoth
                }),
                dataType: "JSON",
                async: false,
                success: function(jd) {
                    $.each(jd, function(key, val) {
                        var diva = '<tr id="N' + val["sd_id"] + '" >';
                        diva += '<td><button class="btn btn-' + val["sty"] + ' btn-mini"><i class="fa fa-star"></i></button></td>';
                        diva += '<td>' + val["lt_Name"]+ '</td>';
                        diva += '<td>' + val["sd_Number"] +'</td>';
                        diva += '<td>' + val["sd_Price"] +'<input type="hidden" name="sd_Price[]" value="' + val["sd_Price"] + '"></td>';
                        diva += '<td><a href="#" class="btn btn-pinterest" onclick="delss(' + val["sd_id"] + ')">ลบ</a></td>'
                        diva += '</tr>';
                        
                        $('#diva').append(diva);
                        
                    });
                   
                    sumBuy();
                }
               
            });
            
        }


        function sumBuy() {
            var Number1 = 0;
            var Number2 = 0;
            var Number3 = 0;
            $.each($('input[name="sd_Price[]"]'), function(i, v) {
                if (parseFloat(v.value) >= 0) Number1 += parseFloat(v.value)
            })
            Number2 = ((Number1 * 30) / 100);
            Number3 = Number1 - Number2;

            document.getElementById('Number1').value = Number1.toFixed(2);
                        document.getElementById("lotoType").value = "";
                        document.getElementById("lt_NameShow").value = "";
                        document.getElementById("lotoNumber").value = "";
                        document.getElementById("lotoYes").value = "";
                        document.getElementById("lotoBoth").value = "";
            onload();
                        //document.getElementById("lt_NameShow").focus();
            
            
        }

        function delss(vals) {
            $.ajax({
                url: "../Class/sql-insert.php",
                global: false,
                type: "POST",
                data: ({
                    Mode: "delLoto",
                    id: vals
                }),
                dataType: "JSON",
                async: false,
                success: function(jd) {
                    
                    $("#N" + vals).empty();
                    sumBuy();
                }
            });
            
        }
    </script>

    <script src="../files/bower_components/jquery/js/jquery.min.js"></script>
    <script src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="../files/bower_components/popper.js/js/popper.min.js"></script>
    <script src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script src="../files/bower_components/modernizr/js/modernizr.js"></script>
    <script src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- Select 2 js -->
    <script src="../files/bower_components/select2/js/select2.full.min.js"></script>
    <!-- Multiselect js -->
    <script src="../files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js">
    </script>
    <script src="../files/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script src="../files/assets/js/jquery.quicksearch.js"></script>
    <!-- Custom js -->
    <script src="../files/assets/pages/advance-elements/select2-custom.js"></script>
    <script src="../files/assets/js/pcoded.min.js"></script>
    <script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
    <script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../files/assets/js/script.js"></script>

    <script src="../files/bower_components/sweetalert/js/sweetalert.min.js"></script>
    <script src="../files/assets/js/modal.js"></script>
    <!-- sweet alert modal.js intialize js -->
    <!-- modalEffects js nifty modal window effects -->
    <script src="../files/assets/js/classie.js"></script>
    <script src="../files/assets/js/modalEffects.js"></script>

</body>

</html>