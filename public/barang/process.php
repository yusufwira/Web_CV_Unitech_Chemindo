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


$isi = $_POST['isinya'];
if($isi =="tambah"){
	$nama = $_POST['nama'];
	$satuan = $_POST['satuan'];
	$stock = $_POST['stock'];
	$sql = "INSERT INTO barang (nama_barang, stock_barang, satuan)
	VALUES ('$nama', $stock, '$satuan')";

	if ($conn->query($sql) === TRUE) {
	    echo json_encode("New record created successfully");
	} else {
	    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}

	$conn->close();	
}
else if($isi =="edit"){
	$nama = $_POST['nama'];
	$satuan = $_POST['satuan'];
	$stock = $_POST['stock'];
	$id = $_POST['id'];
	$sql = "UPDATE barang SET nama_barang='$nama' , satuan='$satuan', stock_barang=$stock WHERE idBarang=$id";

	if ($conn->query($sql) === TRUE) {
	    echo json_encode("New update successfully");
	} else {
	    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}

	$conn->close();	
}

else if($isi =="hapus"){
	$id = $_POST['id'];
	//echo json_encode($id);
	// $satuan = $_POST['satuan'];
	// $id = $_POST['id'];
	$sql = "DELETE FROM barang where idbarang =".$id;

	if ($conn->query($sql) === TRUE) {
	    echo json_encode("Delete Data successfully");
	} else {
	    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}

	$conn->close();	
}


//echo json_encode($isi.$nama.$satuan.$id);

 ?>