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
                            <i class="fa fa-user fa-fw"></i> <span id="currentUsername">...載入中</span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" onclick="JwtHelper.logout()"><i class="fa fa-sign-out fa-fw"></i>登出</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">>
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

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">用戶資料</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>用戶列表</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                                            <i class="fa fa-plus"></i> 増加用戶
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="usersTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 8%">用戶編號</th>
                                                <th style="width: 8%">姓名</th>
                                                <th style="width: 8%">職位</th>
                                                <th>用戶名稱</th>
                                                <th style="width: 12%">指令</th>
                                            </tr>
                                        </thead>
                                        <tbody id="usersTableBody">
                                            <!-- 用戶資料將透過 JavaScript 動態載入 -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 新增用戶 Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">增加用戶</h4>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm">
                            <!-- <div class="form-group">
                                <label>用戶編號 *</label>
                                <input type="Int" class="form-control" name="_uID" required>
                            </div> -->
                            <div class="form-group">
                                <label>姓名 *</label>
                                <input type="text" class="form-control" name="uName" required>
                            </div>
                            <!-- <div class="form-group">
                                <label>職位 *</label>
                                <input type="password" class="form-control" name="password" required>
                            </div> -->
                            <div class="form-group">
                                <label>職位 *</label>
                                <select type="radio" class="form-control" name="uRole" required>
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>用戶名稱 *</label>
                                <input type="text" class="form-control" name="uUsername" required>
                            </div>
                            <div class="form-group">
                                <label>密碼 *</label>
                                <input type="password" class="form-control" name="uPassword" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="addUser()">增加</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 編輯用戶 Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">修改用戶</h4>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            <input type="hidden" name="id" id="edit_uID">
                            <!-- <div class="form-group">
                                <label>用戶編號 *</label>
                                <input type="Int" class="form-control" name="_uID" id="edit_uID" required>
                            </div> -->
                            <div class="form-group">
                                <label>名稱</label>
                                <input type="text" class="form-control" name="uName" id="edituName" required>
                            </div>
                            <div class="form-group">
                                <label>職位</label>
                                <select class="form-control" name="uRole" id="edituRole" required>
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>用戶名稱</label>
                                <input type="text" class="form-control" name="uUsername" id="edituUsername" required>
                            </div>
                            <div class="form-group">
                                <label>密碼</label>
                                <input type="password" class="form-control" name="uPassword" id="edituPassword" placeholder="留下空白＝不修改密碼">
                            </div>
                            <!-- <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role" id="editRole">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div> -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="updateUser()">更新</button>
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

        <link href="https://cdn.datatables.net/v/dt/dt-2.3.5/datatables.min.css" rel="stylesheet" integrity="sha384-Lv8lYSJkh1Hc5kB9lk2YbbGdchMRCuAcwUOYWZ3Q/YIfKNVW+6W+V57wxKNv1D8l" crossorigin="anonymous">
 
        <script src="https://cdn.datatables.net/v/dt/dt-2.3.5/datatables.min.js" integrity="sha384-qH0inyYSCOpaLgM/WSarLVnq0ULwworkGFzUI+E6bpx0DUCIsJePT0TRDnLnkcU1" crossorigin="anonymous"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <script src="../js/JwtHelper.js"></script>

        <script src="js/users.js"></script>        

    </body>
</html>
