<?php
if (!session_id())
    @session_start();

if (!isset($_SESSION["userid"])) {
// login
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>leltárApp Bejelentekés</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="bootstrap/css//bootstrap.css" />
            <link rel="stylesheet" type="text/css" href="dist/css/loginStyle.css" />
        </head>
        <body>
            <div class="wrapper">
                <form class="form-signin" method="post" name="login" action="login.php">       
                    <h2 class="form-signin-heading">leltárApp</h2>
                    <input type="text" class="form-control" name="username" placeholder="Felhasználónév" required="" autofocus="" />
                    <input type="password" class="form-control" name="password" placeholder="Jelszó" required=""/>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Bejelentkezés</button>   
                </form>
            </div>
        </body>
    </html>

    <?php
} else {
// bejelentkezett

    header('Content-Type: text/html; charset=utf-8');

    require './inc/database.php';

    $mysqli = new mysqli(
            $database_settings["url"],
            $database_settings["username"],
            $database_settings["password"],
            $database_settings["database"]);

    if ($mysqli->connect_errno) {
        print"Hiba uzenet!";
        exit();
    }

    $mysqli->query("SET NAMES 'utf8'");
    ?>

    <!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>leltárApp v1.0 | Termék kivételezése</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <!-- Bootstrap 3.3.7 -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
                  page. However, you can choose any other skin. Make sure you
                  apply the skin class to the body tag so the changes take effect. -->
            <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Google Font -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        </head>
        <!--
        BODY TAG OPTIONS:
        =================
        Apply one or more of the following classes to get the
        desired effect
        |---------------------------------------------------------|
        | SKINS         | skin-blue                               |
        |               | skin-black                              |
        |               | skin-purple                             |
        |               | skin-yellow                             |
        |               | skin-red                                |
        |               | skin-green                              |
        |---------------------------------------------------------|
        |LAYOUT OPTIONS | fixed                                   |
        |               | layout-boxed                            |
        |               | layout-top-nav                          |
        |               | sidebar-collapse                        |
        |               | sidebar-mini                            |
        |---------------------------------------------------------|
        -->
        <body class="hold-transition skin-blue sidebar-mini">
            <div class="wrapper">

                <!-- Main Header -->
                <header class="main-header">

                    <!-- Logo -->
                    <a href="index.php" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini">l<b>App</b></span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg">leltár<b>App</b></span>
                    </a>

                    <!-- Header Navbar -->
                    <nav class="navbar navbar-static-top" role="navigation">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="logout.php"><i class="fa fa-times" aria-hidden="true"></i> Kilépés</a>
                            </li>
                        </ul>
                    </nav>
                </header>
                <!-- Left side column. contains the logo and sidebar -->
                <aside class="main-sidebar">

                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar">

                        <!-- Sidebar Menu -->
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="header">HEADER</li>
                            <!-- Optionally, you can add icons to the links -->
                            <li><a href="index.php"><i class="fa fa-table" aria-hidden="true"></i> <span>Teljes lista</span></a></li>
                            <li><a href="bevet.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> <span>Termék bevételezése</span></a></li>
                            <li class="active"><a href="kivet.php"><i class="fa fa-minus-circle" aria-hidden="true"></i> <span>Termék kivételezése</span></a></li>
                        </ul>
                        <!-- /.sidebar-menu -->
                    </section>
                    <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            Leltár
                            <small>Teljes lista</small>
                        </h1>
                    </section>

                    <!-- Main content -->
                    <section class="content container-fluid">

                        <!-- /.row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Termék kivételezése</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <form role="form" method="post" action="add.php">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <select class="form-control" name="termek" id="termek">
                                                    <?php
                                                    if ($result = $mysqli->query("SELECT DISTINCT termeknev FROM termek")) {

                                                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                            print "<option>" . $row["termeknev"] . "</option>";
                                                        }
                                                    $result->close();
                                                    }
                                                    $mysqli->close();
                                                    ?>
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword">Darabszám</label>
                                                    <input type="number" min="0" step="1"  class="form-control" id="exampleInputPassword1" name="darabszam" placeholder="Írd be a darabszámot">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputText2">Egységár</label>
                                                    <input type="number" min="0" step="any" class="form-control" id="exampleInputText2" name="egysegar" placeholder="Írd be az egységárat">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputDate">Dátum</label>
                                                    <input type="date" class="form-control" id="exampleInputDate" name="date">
                                                </div>
                                                
                                            </div>
                                            <!-- /.box-body -->

                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary">Elküld</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>



                        <!--------------------------
                        | Your Page Content Here |
                        -------------------------->

                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                <!-- Main Footer -->
                <footer class="main-footer">
                    <!-- To the right -->
                    <div class="pull-right hidden-xs">
                        <p>leltár<b>App</b></p>
                    </div>
                    <!-- Default to the left -->
                    <strong>Copyright &copy; 2016 <a href="#">Lovas Bálint</a>.</strong> Ez megér egy ötöst. <i class="fa fa-smile-o" aria-hidden="true"></i>
                </footer>
            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED JS SCRIPTS -->

            <!-- jQuery 3.1.1 -->
            <script src="jQuery/jquery-3.1.1.min.js"></script>
            <!-- Bootstrap 3.3.7 -->
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>

            <!-- Optionally, you can add Slimscroll and FastClick plugins.
                 Both of these plugins are recommended to enhance the
                 user experience. -->
        </body>
    </html>

    <?php
}
?>