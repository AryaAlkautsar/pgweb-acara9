<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $kecamatan = $_POST['kecamatan'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $luas = $_POST['luas'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];

    // Sesuaikan dengan setting MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "latihan"; //[cite: 5]

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query Update
    $sql = "UPDATE penduduk SET 
            kecamatan='$kecamatan', 
            longitude=$longitude, 
            latitude=$latitude, 
            luas=$luas, 
            jumlah_penduduk=$jumlah_penduduk 
            WHERE id=$id"; //[cite: 5]

    if ($conn->query($sql) === TRUE) {
        echo "Record edited successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Redirect kembali ke halaman utama index.php
    header("Location: ../index.php");
    exit();
}
?>