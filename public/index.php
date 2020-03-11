<?php 
  session_start();
  if(!isset($_SESSION["login"])){
    header("Location: login.php");

  }
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

  <title>Halaman Utama</title>

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
               
                <button type="submit" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </button>
                
              </div>
            </li>

          </ul>

         
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

           <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">DASHBOARD</h1>           
          </div>


         
          <?php 
          if(isset($_POST['search'])){
            $key = $_POST['key'];
            $isi = $_POST['isi'];

             $sql = "SELECT * FROM suplier s INNER JOIN nota_pembelian np on s.idsuplier = np.suplier_idsuplier INNER JOIN barang b on np.barang_idBarang = b.idBarang WHERE $key like '%$isi%' group by b.idBarang ORDER by np.tanggal ";
          }
          else if(isset($_POST['peringatan'])){
            if($_POST['peringatan'] == 'secure'){
              $sql = "SELECT * FROM suplier s INNER JOIN nota_pembelian np on s.idsuplier = np.suplier_idsuplier INNER JOIN barang b on np.barang_idBarang = b.idBarang WHERE stock_barang > 25 group by b.idBarang ORDER by np.tanggal ";
            }
            else if($_POST['peringatan'] == 'warning'){
              $sql = "SELECT * FROM suplier s INNER JOIN nota_pembelian np on s.idsuplier = np.suplier_idsuplier INNER JOIN barang b on np.barang_idBarang = b.idBarang WHERE stock_barang <= 25 and stock_barang > 0  group by b.idBarang ORDER by np.tanggal ";
            }
            else if($_POST['peringatan'] == 'danger'){
              $sql = "SELECT * FROM suplier s INNER JOIN nota_pembelian np on s.idsuplier = np.suplier_idsuplier INNER JOIN barang b on np.barang_idBarang = b.idBarang WHERE stock_barang = 0 group by b.idBarang ORDER by np.tanggal ";
            }
          }
          else{
            $sql = "SELECT * FROM suplier s INNER JOIN nota_pembelian np on s.idsuplier = np.suplier_idsuplier INNER JOIN barang b on np.barang_idBarang = b.idBarang group by b.idBarang ORDER by np.tanggal";
            
          }
          
           $result = $conn->query($sql); 
            
           ?>
          <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Pencarian</h6>
                                   
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row"> 
                   
                    <div class="form-group col-sm-3">
                       <form action="index.php" method="POST">
                       <select class="form-control" id="suplier" name="key">
                          <option value="nama_barang">Nama Barang</option>                 
                          <option value="stock_barang">Stock Barang</option>
                        </select>
                    </div>                  
                    <div class="form-group col-sm-7">                       
                        <input type="text" class="form-control form-control-user" name="isi" aria-describedby="emailHelp" placeholder="search">
                    </div>
                    <div class="form-group col-sm-2">                       
                        <input type="submit" name="search" href="index.html" class="btn btn-primary btn-user btn-block" value="Search"></input>
                    </div>
                  </div>
                  <div class="row"></div>
                  <div class="row">
                     &nbsp&nbsp&nbsp
                     <button type="submit" class="btn btn-success col-sm-3" name="peringatan" value="secure">Secure <i class='fas fa-thumbs-up'></i></button>&nbsp&nbsp&nbsp
                     <button type="submit" class="btn btn-warning col-sm-3" name="peringatan" value="warning">Warning <i class="fas fa-exclamation-triangle"></i></button>&nbsp&nbsp&nbsp
                     <button type="submit" class="btn btn-danger col-sm-3" name="peringatan" value="danger">Danger <i class="fas fa-exclamation"></i></button>&nbsp&nbsp&nbsp
                  </div>
                  </form>
                </div>
              </div>
            </div>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian Barang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>                      
                      <th>Nama Barang</th>                                
                      <th>Stock Barang</th> 
                      <th>Peringatan</th>
                    </tr>
                  </thead>
                  <tbody> 
                 <?php 
                    if ($result->num_rows > 0) {                        
                        while($row = $result->fetch_assoc()) {                        
                            echo '<tr>                                   
                                    <td>'.$row["nama_barang"].'</td>
                                    <td>'.$row["stock_barang"].'</td>';
                                    if($row["stock_barang"] <= 25 && $row["stock_barang"] > 0){
                                      echo '<td><button class="btn btn-warning btn-circle">
                                            <i class="fas fa-exclamation-triangle"></i></td>';
                                    }
                                    else if($row["stock_barang"] <= 0){
                                      echo '<td><button class="btn btn-danger btn-circle">
                                            <i class="fas fa-exclamation-triangle"></i></td>';
                                    }
                                    else{
                                      echo '<td><button class="btn btn-success btn-circle">
                                            <i class="fas fa-thumbs-up"></i></td>';
                                    }
                             echo'</tr>';
                        }
                    } else {
                        echo "0 results";
                    }

                  ?>                                                                         
                  </tbody>
                </table>

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
    function deleteData(id){
      $.ajax({
        type:"POST",
        url:"barang/process.php",
        data:{isinya: "hapus", id:id},
          success:function(data){
            alert(data);
            window.location.href ="barang.php"
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
