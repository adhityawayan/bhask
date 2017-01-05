<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PT. Bhaskara Madya Jaya- <?php echo $__env->yieldContent('title'); ?> </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE') ?>/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE') ?>/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE') ?>/plugins/ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE') ?>/plugins/datatables/dataTables.bootstrap.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE') ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE') ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE') ?>/dist/css/skins/skin-red-light.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE') ?>/plugins/datepicker/datepicker3.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-red-light sidebar-mini">
    <div class="wrapper">

        <header class="main-header">

            <!-- Logo -->
            <a href="<?php echo base_url('dashboard') ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>B</b>MJ</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Bhaskara</b>MadyaJaya</span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo e(base_url('uploads/avatar/default.jpg')); ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo e(sesi('nama_lengkap')); ?></p>
                        <a href="<?= base_url('login/destroy') ?>" ><i class="fa fa-sign-out "></i> Logout</a>
                    </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?php echo e(active_link_controller('dashboard')); ?>">
                        <a href="<?php echo e(base_url('dashboard')); ?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?php echo e(active_link_controller('pengguna')); ?>">
                        <a href="<?php echo e(base_url('pengguna')); ?>">
                            <i class="fa fa-users"></i> <span>Pengguna</span>
                        </a>
                    </li>
                    <li class="<?php echo e(active_link_controller('kantor')); ?>">
                        <a href="<?php echo e(base_url('kantor')); ?>">
                            <i class="fa fa-bank"></i> <span>Kantor/ATM BRI</span>
                        </a>
                    </li>
                    <li class="<?php echo e(active_link_controller('zona')); ?>">
                        <a href="<?php echo e(base_url('zona')); ?>">
                            <i class="fa fa-globe"></i> <span>Zona</span>
                        </a>
                    </li>
                    <!-- <li class="<?php echo e(active_link_controller('bahan')); ?>">
                        <a href="<?php echo e(base_url('bahan')); ?>">
                            <i class="fa fa-legal"></i> <span>Sub Kontraktor</span>
                        </a>
                    </li>
                    <li class="<?php echo e(active_link_controller('harga_bahan')); ?>">
                        <a href="<?php echo e(base_url('harga_bahan')); ?>">
                            <i class="fa fa-money"></i> <span>Harga Jual</span>
                        </a>
                    </li>
                    <li class="<?php echo e(active_link_controller('pekerjaan')); ?>">
                        <a href="<?php echo e(base_url('pekerjaan')); ?>">
                            <i class="fa fa-briefcase"></i> <span>Pekerjaan</span>
                        </a>
                    </li>
                    <li class="<?php echo e(active_link_controller('spk')); ?>">
                        <a href="<?php echo e(base_url('spk')); ?>">
                            <i class="fa fa-wpforms"></i> <span>SPK</span>
                        </a>
                    </li>
                    <li class="<?php echo e(active_link_controller('laporan')); ?>">
                        <a href="<?php echo e(base_url('laporan')); ?>">
                            <i class="fa fa-wpforms"></i> <span>Laporan</span>
                        </a>
                    </li> -->
                    <li class="treeview">
                        <a href="#">
                        <i class="fa fa-folder"></i> <span>Projects</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e(active_link_controller('bahan')); ?>">
                                <a href="<?php echo e(base_url('bahan')); ?>">
                                    <i class="fa fa-legal"></i> <span>Sub Kontraktor</span>
                                </a>
                            </li>
                            <li class="<?php echo e(active_link_controller('harga_bahan')); ?>">
                                <a href="<?php echo e(base_url('harga_bahan')); ?>">
                                    <i class="fa fa-money"></i> <span>Harga Jual</span>
                                </a>
                            </li>
                            <li class="<?php echo e(active_link_controller('pekerjaan')); ?>">
                                <a href="<?php echo e(base_url('pekerjaan')); ?>">
                                    <i class="fa fa-briefcase"></i> <span>Pekerjaan</span>
                                </a>
                            </li>
                            <li class="<?php echo e(active_link_controller('spk')); ?>">
                                <a href="<?php echo e(base_url('spk')); ?>">
                                    <i class="fa fa-wpforms"></i> <span>SPK</span>
                                </a>
                            </li>
                            <li class="<?php echo e(active_link_controller('laporan')); ?>">
                                <a href="<?php echo e(base_url('laporan')); ?>">
                                    <i class="fa fa-file-o"></i> <span>Laporan</span>
                                </a>
                            </li>
                            <li class="<?php echo e(active_link_controller('laporan')); ?>">
                                <a href="<?php echo e(base_url('laporan/laporanbri')); ?>">
                                    <i class="fa fa-file-o"></i> <span>Laporan BRI</span>
                                </a>
                            </li>
                            <li class="<?php echo e(active_link_controller('laporan')); ?>">
                                <a href="<?php echo e(base_url('laporan/laporantukang')); ?>">
                                    <i class="fa fa-file-o"></i> <span>Laporan Tukang</span>
                                </a>
                            </li>
                            <li class="<?php echo e(active_link_controller('laporan')); ?>">
                                <a href="<?php echo e(base_url('laporan/laporankanwil')); ?>">
                                    <i class="fa fa-file-o"></i> <span>Laporan Kanwil</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                        <i class="fa fa-folder"></i> <span>Repair</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu ">
                            <li>
                                <a href="<?php echo e(base_url('repair/subkon')); ?>">
                                    <i class="fa fa-legal"></i> <span>Sub Kontraktor</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(base_url('repair/harga')); ?>">
                                    <i class="fa fa-money"></i> <span>Harga</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(base_url('repair/pekerjaan')); ?>">
                                    <i class="fa fa-briefcase"></i> <span>Pekerjaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(base_url('repair/spk')); ?>">
                                    <i class="fa fa-wpforms"></i> <span>SPK</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(base_url('repair/laporan')); ?>">
                                    <i class="fa fa-file-o"></i> <span>Laporan</span>
                                </a>
                            </li>
                             <li>
                                <a href="<?php echo e(base_url('repair/laporan/laporantukang')); ?>">
                                    <i class="fa fa-file-o"></i> <span>Laporan Tukang</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1
            </div>
            <strong>Copyright &copy; 2016.</strong> All rights reserved.
        </footer>   

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/AdminLTE') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/AdminLTE') ?>/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/AdminLTE') ?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE') ?>/dist/js/app.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/AdminLTE') ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url('assets/AdminLTE') ?>/plugins/ckeditor/ckeditor.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/AdminLTE') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $(".table-pagging").DataTable({
            "lengthChange": false,
        });
        $(".table-image").DataTable({
            "lengthChange": false,
            "searching": false,
        });
        $('.datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd',
        });
    });
</script>


<script type="text/javascript">
    $( document ).ready(function() {
          if ($('#jenis_kantor').val() == 1) {
            $('#parent').prop('disabled', true);
          }

        $('#jenis_kantor').change(function() {
          $('#parent').prop('disabled', true);
          if ($(this).val() != 1) {
            $('#parent').prop('disabled', false);
          }
        });
    });
</script>    
</body>
</html>
