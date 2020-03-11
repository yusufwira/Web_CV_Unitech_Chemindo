<?php
  session_start(); 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "kp_awang";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pembelian Barang</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">        
        <div class="sidebar-brand-text mx-3"><h3>UNITECH </h3></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-box"></i>
          <span>Dashboard</span></a>
      

      <!-- Divider -->
      <hr class="sidebar-divider">

      </li>
       <li class="nav-item active">
        <a class="nav-link" href="pembelian.php">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Pembelian</span></a>

      <hr class="sidebar-divider">
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="penggunaan.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Penggunaan</span></a>
      </li>

      <hr class="sidebar-divider">
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data</h6>
            <a class="collapse-item" href="suplier.php">Data Suplier</a>
            <a class="collapse-item" href="barang.php">Data Barang</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
           <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['login'] ?></span>                
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

         
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

           <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Pembelian Barang</h1>
            <a href="barang/tambah.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Nota Barang</a>
          </div>


         
          <?php 
            $sql = "SELECT * FROM suplier";
            $result = $conn->query($sql);

            $sql2 = "SELECT * FROM barang";
            $result2 = $conn->query($sql2);
           ?>
          <!-- DataTales Example -->
           <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-plus"></i>Barang</h6>
            </div>
            <div class="card-body row"> 
            <div class="col-sm-3"></div>
                <div class="form-group col-sm-9 ">
                  <div class="col-sm-8"> 
                    <div class="form-group">
                      <h5>Select List Suplier:</h5>
                       <select class="form-control" id="suplier">
                      <?php  
                          if ($result->num_rows > 0) {                        
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=".$row['idsuplier'].">".$row['nama_suplier']."</option>";
                            }
                          }  ?>                                                              
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-8"> 
                    <div class="form-group">
                      <h5>Select List Barang:</h5>
                       <select class="form-control" id="barang">
                      <?php  
                          if ($result2->num_rows > 0) {                        
                            while($row2 = $result2->fetch_assoc()) {
                                echo "<option value=".$row2['idBarang'].">".$row2['nama_barang']."</option>";
                            }
                          }  ?>                                                              
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <h5>Jumlah Barang</h5>
                    <input type="text" class="form-control form-control-user" id="jumlah" id="exampleInputEmail" >    
                  </div>
                  <div class="col-sm-8">
                    <h5>Tanggal Pembelian</h5>
                    <input type="date" class="form-control form-control-user" id="tanggal"  >    
                  </div>
                  <br>
                  <div class="col-sm-8">
                    <button onclick="tambahData()" class="btn btn-primary btn-user btn-block">
                      Tambah Nota Barang
                    </button>    
                  </div>
                </div>                          
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; unitech 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function tambahData(){  
      var suplier = $('#suplier').val();
      var barang = $('#barang').val();
      var jumlah = $('#jumlah').val();
     var tanggal = $('#tanggal').val();    
      $.ajax({
        type:"POST",
        url:"process.php",
        data:{isinya: "tambah_pembelian",suplier: suplier, barang: barang, jumlah: jumlah, tanggal:tanggal},
          success:function(data){
            alert(data);   
            window.location.href ="pembelian.php"         
          },
        });
    }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
