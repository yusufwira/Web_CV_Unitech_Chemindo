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
	$alamat = $_POST['alamat'];
	$notelp = $_POST['notelp'];
	$sql = "INSERT INTO suplier (nama_suplier, alamat_suplier, notelp_suplier)
	VALUES ('$nama', '$alamat', '$notelp')";

	if ($conn->query($sql) === TRUE) {
	    echo json_encode("New record created successfully");
	} else {
	    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}

	$conn->close();	
}
else if($isi =="edit"){
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$notelp = $_POST['notelp'];
	$id = $_POST['id'];
	$sql = "UPDATE suplier SET nama_suplier='$nama' , alamat_suplier='$alamat', notelp_suplier='$notelp' WHERE idsuplier=$id";

	if ($conn->query($sql) === TRUE) {
	    echo json_encode("New update successfully");
	} else {
	    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}

	$conn->close();	
}

else if($isi =="hapus"){
	$id = $_POST['id'];
	$sql = "DELETE FROM suplier where idsuplier =".$id;

	if ($conn->query($sql) === TRUE) {
	    echo json_encode("Delete Data successfully");
	} else {
	    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}

	$conn->close();	
}


//echo json_encode($isi.$nama.$satuan.$id);
?>