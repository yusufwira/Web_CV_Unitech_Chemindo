<?php 

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

$mode = $_POST['isinya'];

if($mode == "tambah_pembelian"){
	$suplier = $_POST['suplier'];
	$barang = $_POST['barang'];
	$jumlah = $_POST['jumlah'];
	$tanggal = $_POST['tanggal'];

	$sql = "INSERT INTO nota_pembelian (suplier_idsuplier, barang_idBarang, jumlah_barang, tanggal)
	VALUES ('$suplier', $barang, '$jumlah', '$tanggal')";

	if ($conn->query($sql) === TRUE) {
	   $sql2 = "SELECT * FROM barang WHERE idbarang =".$barang;
	   $result = $conn->query($sql2);
       $row2 = $result->fetch_assoc();
       if($row2['stock_barang'] == null){
	       	$sql3 = "UPDATE barang set stock_barang =".$jumlah." WHERE idBarang=".$barang;
	       	if ($conn->query($sql3) === TRUE) {
			    echo json_encode("Data nota pembelian berhasil disimpan");
			} else {
			    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
			}
       }
       else{
       		$total = $row2['stock_barang'] + $jumlah;
       		$sql3 = "UPDATE barang set stock_barang =".$total." WHERE idBarang=".$barang;
	       	if ($conn->query($sql3) === TRUE) {
			    echo json_encode("Data nota pembelian berhasil disimpan");
			} else {
			    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
			}       		
       }
      // echo json_encode($row2['stock_barang']);
	} else {
	    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}

	$conn->close();
}

else if($mode == "tambah_penggunaan"){	
	$barang = $_POST['barang'];
	$jumlah = $_POST['jumlah'];
	$tanggal = $_POST['tanggal'];

	$sql = "INSERT INTO penggunaan (jumlah_digunakan, tanggal_penggunaan, barang_idBarang)
	VALUES ('$jumlah', '$tanggal', '$barang')";

	if ($conn->query($sql) === TRUE) {
	   $sql2 = "SELECT * FROM barang WHERE idbarang =".$barang;
	   $result = $conn->query($sql2);
       $row2 = $result->fetch_assoc();
       if($row2['stock_barang'] == null){
	       echo json_encode("Maaf Barang tidak mempunyai Stock Barang");
       }
       else{
       		$total = $row2['stock_barang'] - $jumlah;
       		$sql3 = "UPDATE barang set stock_barang =".$total." WHERE idBarang=".$barang;
	       	if ($conn->query($sql3) === TRUE) {
			    echo json_encode("Stock Barang Berhasil Digunakan");
			} else {
			    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
			}       		
       }
      // echo json_encode($row2['stock_barang']);
	} else {
	    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}

	$conn->close();
	//echo json_encode($barang." ".$jumlah." ".$tanggal);
}
//

 ?>