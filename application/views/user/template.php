<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url()?>favicon.ico">

    <title>Dashboard | SISPA</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/sb_admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url()?>assets/sb_admin/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url()?>assets/sb_admin/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/sb_admin/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">


    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url()?>assets/sb_admin/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url()?>assets/sb_admin/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/sb_admin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>assets/sb_admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrapValidator.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/moment.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap-datetimepicker.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>assets/sb_admin/js/plugins/metisMenu/metisMenu.min.js"></script>
        <!-- Morris Charts JavaScript 
        <script src="<?php echo base_url()?>/assets/sb_admin/js/plugins/morris/raphael.min.js"></script>
        <script src="<?php echo base_url()?>/assets/sb_admin/js/plugins/morris/morris.min.js"></script>
        <script src="<?php echo base_url()?>/assets/sb_admin/js/plugins/morris/morris-data.js"></script>
    -->
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/sb_admin/js/sb-admin-2.js"></script>
    </head>

    <body>

        <div id="wrapper">
            <?php 
            $session = $this->session->userdata('user_data');
            $success_msg = $this->session->userdata('success_msg');
            $err_msg = $this->session->userdata('err_msg');
            if ($success_msg){
            ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Yaps!</strong> <?php echo $success_msg?>
            </div>
            <?php 
            $this->session->unset_userdata('success_msg');
            } //success msg
            if ($err_msg){
            ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Opps!</strong> <?php echo $err_msg?>
            </div>
            <?php 
            $this->session->unset_userdata('err_msg');
            }
            ?>
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="navbar-brand" >User Area SISPA</span>
                </div>
                <!-- /.navbar-header -->

                
                <ul class="nav navbar-top-links navbar-right">
                    <?php if($session['user_level']==1){ ?>
                    <li><a href="<?php echo base_url()?>user">Dashboard</a></li>
                    <li ><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addVoucher">Add Jurnal</button></li>
                    <?php
                    } else if($session['user_level']==0){ ?>
                    <li><a href="<?php echo base_url()?>superuser">Dashboard</a></li>
                    <li><a href="<?php echo base_url()?>coa">CoA</a></li>
                    <li><a href="<?php echo base_url()?>akun">Akun</a></li>
                    <?php
                    }?> 
                    
                    <li><a href="<?php echo base_url()?>jurnal">Jurnal</a></li>
                    <li><a href="<?php echo base_url()?>catatan">Catatan</a></li>
                    <li><a href="<?php echo base_url()?>buku_besar">Buku Besar</a></li>
                    <li><a href="<?php echo base_url()?>labarugi">Labarugi</a></li>
                    <li><a href="<?php echo base_url()?>neraca">Neraca</a></li>
                    <li><?php echo $session['username']?></li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo site_url('ganti_password')?>"><i class="fa fa-gear fa-fw"></i> Ganti Password</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>

                <!-- /.navbar-static-side -->
            </nav>
            <!-- CONTENT -->
            <!--modal add voucher-->
            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="addVoucher" tabindex="-1" role="dialog" aria-labelledby="addVoucherLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="addVoucherLabel">Add Voucher</h4>
                        </div>
                        <div class="modal-body ">
                    <form method="POST" action="<?php echo base_url()?>user/send" id="voucher-form" class="voucher-form row">
                            <input type='text' name='count' id="count" style="display:none" />
                            <div class="col-md-12" style="margin-bottom:10px">
                                <label class="col-md-3">No Jurnal: </label><div class="col-md-3"><input value="<?php echo $no_jurnal?>" class="form-control" name="no_jurnal" readonly></div>
                            </div>
                            <div class="col-md-8">
                                <label class="col-md-4">No Voucher: </label>
                                <div class="col-md-4">
                                    <select name="code-voucher" class='form-control noVoucherDropdown' id='sel1'>
                                        <option>IN</option>
                                        <option>OT</option>
                                        <option>JU</option>
                                    </select>  
                                </div>
                                <div class="col-md-4">
                                  <input type="text" name="number-voucher" class="voucherNumber form-control " readonly />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class='col-sm-12 '>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker5'>
                                                <input type='text' name="date" class="date-input form-control" data-date-format="YYYY/MM/DD" placeholder="Tanggal Transaksi"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="item-header col-md-12" style="margin-top:30px;">
                                </div>
                                <div class="target"></div>
                                
                            </div>
                            <div class="row">
                                <button class="btn btn-primary add-item" style="margin:30px" onclick="addItem($('.item:last-child'))">Add</button>
                                <button class="btn btn-primary add-comment" style="float:right;margin:30px" onclick="addComment()">Add Comment</button>
                            </div>
                            <div class="target-comment"></div>
                            <div>
                              <label class="col-md-4">Total</label> <label class="col-md-4 debit-total">0</label> <label class="col-md-4 kredit-total">0</label>
                            </div>
                            <input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Submit" name="send"> 

                    </form>
                        </div><!--modal body-->

                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div> <!-- modal  end-->

<div id="page-wrapper" style="padding-bottom:100px">
    <?php echo $content?>
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<script type="text/javascript">
    $(function () {
        $('#datetimepicker5').datetimepicker({
            pickTime: false
        });
    });
    var count = 1;
    addItem($(".target"));
    function addItem(target){
        console.log("add");
        target.after("<div class='item col-md-12' style='margin-top:10px'><label style='margin-bottom:10px' class='col-md-3'>Deskripsi</label> <div class='col-md-9 '><input required style='margin-bottom:10px' class='form-control transaksi-input' type='text' name='transaksi-"+count+"'/></div><div class='col-md-3'><select class='form-control akun-input' name='akun-debit-"+count+"' id='sel1'><option selected disabled>Akun</option><?php foreach ($akun_debit as $akun_item) { ?><option value='<?php echo $akun_item->nama?>'><?php echo $akun_item->nama?></option><?php } //foreach akun?></select></div><div class='col-md-3'><div class='input-group'><span class='input-group-addon'>Rp</span><input type='text' data-bv-regexp='true' data-bv-regexp-regexp='^[0-9+]*$' data-bv-regexp-message='Hanya boleh diisi dengan angka' class='form-control dk-input deb-input' name='debit-"+count+"' placeholder='Debit'/></div></div><div class='col-md-3'><select class='form-control akun-input' name='akun-kredit-"+count+"' id='sel1'><option selected disabled>Akun</option><?php foreach ($akun_kredit as $akun_item) { ?><option value='<?php echo $akun_item->nama?>'><?php echo $akun_item->nama?></option><?php } //foreach akun?></select></div><div class='col-md-3'><div class='input-group'><span class='input-group-addon'>Rp</span><input type='text' data-bv-regexp='true' data-bv-regexp-regexp='^[0-9+]*$' data-bv-regexp-message='Hanya boleh diisi dengan angka' class='form-control dk-input kre-input' name='kredit-"+count+"' placeholder='Kredit' /></div></div></div>");
        $('#count').val(count);
        count++;

    }
    $('.voucherNumber').val("<?php echo str_pad($voucher_in, 3, "0", STR_PAD_LEFT)?>");
    $('.noVoucherDropdown').change(function() {
        var val = $(this).val();
        if (val == "OT"){
            $('.voucherNumber').val("<?php echo str_pad($voucher_ot, 3, "0", STR_PAD_LEFT)?>");
        } else if (val == "IN"){
            $('.voucherNumber').val("<?php echo str_pad($voucher_in, 3, "0", STR_PAD_LEFT)?>");
        } else {
            $('.voucherNumber').val("<?php echo str_pad($voucher_ju, 3, "0", STR_PAD_LEFT)?>");
        }
    });

    function addComment(){
        $('.target-comment').after("<div class='col-md-12' style='margin-bottom:10px'><textarea name='comment' class='form-control' type='text' name='transaksi'></textarea></div>");
        $('.add-comment').hide();
    }

        //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 0.5 second for example

    //on keyup, start the countdown
    $(document).on('keyup','.deb-input', function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(debDoneTyping, doneTypingInterval);
    });
    
    $(document).on('keyup','.kre-input', function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(kreDoneTyping, doneTypingInterval);
    });
    //on keydown, clear the countdown 
    $(document).on('keydown', '.deb-input', function(){
        clearTimeout(typingTimer);
    });
    $(document).on('keydown', '.kre-input', function(){
        clearTimeout(typingTimer);
    });
    //user is "finished typing," do something
    function debDoneTyping () {
        var debTotal=0;
        $('.item').each(function(){
            debTotal = debTotal+ parseInt($(this).find('.deb-input').val());
        });
        $('.debit-total').html(debTotal);
    }

    function kreDoneTyping () {
        var kreTotal=0;
        $('.item').each(function(){
            kreTotal = kreTotal+ parseInt($(this).find('.kre-input').val());
        });
        $('.kredit-total').html(kreTotal);
    }
    function validate(){
        var valid = true;
        console.log($('.date-input').val());
        //cek tanggal 
        if($('.date-input').val()==''){
            return false;
        }
        $('.item').each(function(){
            console.log($(this).find('.transaksi-input').val());
            if ($(this).find('.transaksi-input').val() == ''){
                return false;
            }
        });
        if($('.kredit-total').html() == 0 || $('.kredit-total').html() != $('.debit-total').html() || $('.debit-total').html()== 0){
            return false;
        }
        return true;
    }

    function submitForm(){
        if (validate()){
            $('#voucher-form').submit();        
        } else {
            alert("Form Voucher bermasalah, silahkan cek kembali");
        }
    }
</script>
<script>
    $(document).on( 'bootstrapValidator', '.voucher-form', function(){} );
    $(document).ready(function() {
        $('.voucher-form').bootstrapValidator();
    });
</script>

</body>

</html>
