<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="產品管理系統">
        <meta name="author" content="">

        <title>產品管理系統</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">產品管理系統</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">導覽列</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <span id="currentUsername"><?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') ? 'Admin' : 'User'; ?></span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" onclick="logout()"><i class="fa fa-sign-out fa-fw"></i>登出</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li id="dashboardMenu" >
                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> 儀表板</a>
                            </li>
                            <li>
                                <a href="products.php"><i class="fa fa-users fa-fw"></i> 產品資料</a>
                            </li>
                            <li id="usersMenu" class="active" style="display:none;">
                                <a href="users.php"><i class="fa fa-users fa-fw"></i> 用戶資料</a>
                            </li>
                            <li id="sendMenu" style="display:none;">
                                <a href="send.php"><i class="fa fa-envelope fa-fw"></i> 傳送手機消息</a>
                            </li>                             
                        </ul>
                    </div>
                </div>
            </nav>
      </div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                     <h1 class="page-header">推播訊息</h1>
                </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>發送通知到 Android App</h4>
                    </div>
                        <div class="panel-body">
                            <div id="status"><?= $status ?? "" ?></div>
                        <form id="sendForm">
                            <div class="form-group">
                              <label for="message">訊息內容</label>
                              <input type="text" class="form-control" id="message" name="message" placeholder="輸入要推播的訊息">
                            </div>
                                 <button type="submit" class="btn btn-primary"  onclick="return confirm('確定要送出嗎？')">
                                 <i class="fa fa-paper-plane"></i> 發送
                                 </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
            <!-- jQuery -->
            <script src="../js/jquery.min.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="../js/bootstrap.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="../js/metisMenu.min.js"></script>

            <!-- DataTables JavaScript -->
            <!-- <script src="../js/dataTables/jquery.dataTables.min.js"></script>
            <script src="../js/dataTables/dataTables.bootstrap.min.js"></script> -->

            <link href="https://cdn.datatables.net/v/dt/dt-2.3.5/datatables.min.css" rel="stylesheet" integrity="sha384-Lv8lYSJkh1Hc5kB9lk2YbbGdchMRCuAcwUOYWZ3Q/YIfKNVW+6W+V57wxKNv1D8l" crossorigin="anonymous">

            <script src="https://cdn.datatables.net/v/dt/dt-2.3.5/datatables.min.js" integrity="sha384-qH0inyYSCOpaLgM/WSarLVnq0ULwworkGFzUI+E6bpx0DUCIsJePT0TRDnLnkcU1" crossorigin="anonymous"></script>


            <!-- Custom Theme JavaScript -->
            <script src="../js/startmin.js"></script>

            <script src="../js/JwtHelper.js"></script>

            <script src="js/send.js"></script> 
   
    </body>
</html>
