<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Data</title>
</head>
<body>
<h2>Form Edit</h2>

<?php
// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgw8"; // Sesuaikan dengan database kamu

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM penduduk WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<form action='edit.php' onsubmit='return validateForm(event)' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'><br>";
        
        echo "<label for='kec'>Kecamatan: </label><br>";
        echo "<input type='text' id='kec' name='kecamatan' value='" . $row['kecamatan'] . "'><br>";
        
        echo "<label for='long'>Longitude: </label><br>";
        echo "<input type='text' id='long' name='longitude' value='" . $row['longitude'] . "'><br>";
        
        echo "<label for='lat'>Latitude: </label><br>";
        echo "<input type='text' id='lat' name='latitude' value='" . $row['latitude'] . "'><br>";
        
        echo "<label for='luas'>Luas: </label><br>";
        echo "<input type='text' id='luas' name='luas' value='" . $row['luas'] . "'><br>";
        
        echo "<label for='jml_pddk'>Jumlah Penduduk: </label><br>";
        echo "<input type='text' id='jml_pddk' name='jumlah_penduduk' value='" . $row['jumlah_penduduk'] . "'><br><br>";
        
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
    }
} else {
    echo "Data tidak ditemukan!";
}

$conn->close();
?>

<p id="informasi" style="color:red;"></p>

<script>
function validateForm(event) {
    let luas = document.getElementById("luas").value;
    let text = "";

    if (isNaN(luas) || luas < 1) {
        text = "Data luas harus angka dan tidak boleh bernilai negatif atau kurang dari 1";
        event.preventDefault(); // Menghentikan pengiriman form
        document.getElementById("informasi").innerHTML = text;
        return false;
    }
    return true;
}
</script>
</body>
</html>