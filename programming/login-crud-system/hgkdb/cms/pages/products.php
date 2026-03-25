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
                    <span class="sr-only">Toggle navigation</span>
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
                            <li id="dashboardMenu" >
                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> 儀表板</a>
                            </li>
                            <li id="productsMenu" class="active">
                                <a href="products.php"><i class="fa fa-users fa-fw"></i> 產品資料</a>
                            </li>
                            <li id="usersMenu"  style="display:none;">
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
                        <h1 class="page-header"> 產品資料 </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>產品列表</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                                            <i class="fa fa-plus"></i> 增加產品
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="productsTable">
                                        <thead>
                                            <tr>
                                                <th>產品編號</th>
                                                <th>產品種類</th>
                                                <th>產品名稱</th>
                                                <th>產品文字介紹</th>
                                                <th>產品規格</th>
                                                <th>產品圖片</th>
                                                <th>產品價格</th>
                                                <th>產品存貨</th>
                                                <th>指令</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productsTableBody">
                                            <!-- 產品資料將透過 JavaScript 動態載入 -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 新增產品 Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">增加產品</h4>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm">
                            <!-- <div class="form-group">
                                <label>產品編號 *</label>
                                <input type="int" class="form-control" name="_pID" required>
                            </div> -->
                            <div class="form-group">
                                <label>產品種類</label>
                                <input type="text" class="form-control" name="pCate">
                            </div>
                            <div class="form-group">
                                <label>產品名稱</label>
                                <input type="text" class="form-control" name="pName">
                            </div>
                            <div class="form-group">
                                <label>產品文字介紹</label>
                                <input type="text" class="form-control" name="pDescription">
                            </div>
                            <div class="form-group">
                                <label>產品規格</label>
                                <input type="text" class="form-control" name="pSpec">
                            </div>
                            <div class="form-group">
                                <label>產品圖片</label>
                                <input type="text" class="form-control" name="pImage" placeholder="增加產品後，在指令按<更改圖片>，進行圖片更新">
                            </div>
                            <div class="form-group">
                                <label>產品價格</label>
                                <input type="number" step="0.01" class="form-control" name="pPrice"  onkeydown="if(event.key==='-'){event.preventDefault();}">
                            </div>
                            <div class="form-group">
                                <label>產品存貨</label>
                                <input type="number" class="form-control" name="pStock" min='0' onkeydown="if(event.key==='-'){event.preventDefault();}">
                            </div>                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="addProduct()">增加</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 編輯產品 Modal -->
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">編輯產品</h4>
                    </div>
                    <div class="modal-body">
                        <form id="editProductForm">
                            <input type="hidden" name="productid" id="editProductId">
                            <div class="form-group">
                                <label>產品編號 *</label>
                                <input type="int" class="form-control" name="_pID" id="edit_pID" required>
                            </div>
                            <div class="form-group">
                                <label>產品種類</label>
                                <input type="text" class="form-control" name="pCate" id="editpCate">
                            </div>
                            <div class="form-group">
                                <label>產品名稱</label>
                                <input type="text" class="form-control" name="pName" id="editpName">
                            </div>
                            <div class="form-group">
                                <label>產品文字介紹</label>
                                <input type="text" class="form-control" name="pDescription" id="editpDescription">
                            </div>
                            <div class="form-group">
                                <label>產品規格</label>
                                <input type="text" class="form-control" name="pSpec" id="editpSpec">
                            </div>
                            <div class="form-group">
                                <label>產品圖片</label>
                                <input type="text" class="form-control" name="pImage" id="editpImage">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadImageModal">上傳圖片</button>
                            </div>
                            <div class="form-group">
                                <label>產品價格</label>
                                <input type="number" class="form-control" step="0.01" name="pPrice" id="editpPrice" min='0' onkeydown="if(event.key==='-'){event.preventDefault();}">
                            </div>
                            <div class="form-group">
                                <label>產品存貨</label>
                                <input type="number" class="form-control" name="pStock" id="editpStock" min='0' onkeydown="if(event.key==='-'){event.preventDefault();}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="updateProduct()">更新</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 上傳圖片 Modal -->
        <div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">上傳產品資料</h4>
                    </div>
                    <div class="modal-body">
                        <form id="uploadImageForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="imageFile">選取圖片:</label>
                                <input type="file" class="form-control" id="imageFile" name="image" accept="image/*" required>
                                <small class="help-block">支持圖片格式: JPG, PNG, GIF, WebP</small>
                            </div>
                            <div class="form-group">
                                <div id="imagePreview" style="display: none;">
                                    <label>預覽:</label>
                                    <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="submitImageUpload()">上傳照片</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <!-- <script src="../js/dataTables/jquery.dataTables.min.js"></script> old jquery
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script> --> 
        <link href="https://cdn.datatables.net/v/dt/dt-2.3.5/datatables.min.css" rel="stylesheet" integrity="sha384-Lv8lYSJkh1Hc5kB9lk2YbbGdchMRCuAcwUOYWZ3Q/YIfKNVW+6W+V57wxKNv1D8l" crossorigin="anonymous">
 
        <script src="https://cdn.datatables.net/v/dt/dt-2.3.5/datatables.min.js" integrity="sha384-qH0inyYSCOpaLgM/WSarLVnq0ULwworkGFzUI+E6bpx0DUCIsJePT0TRDnLnkcU1" crossorigin="anonymous"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <script src="../js/JwtHelper.js"></script>

        <script type="module" src="/hgkdb/cms/pages/js/products.js"></script>
     

    </body>
</html>
