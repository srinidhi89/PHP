

<!DOCTYPE html>
<html>

<style>

button 
{
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 8%;

}

button:hover 
{
    opacity: 0.8;
}


.error {color: #FF0000;}

</style>


<body>

<form method="post" action = "uploadfinal.php" enctype="multipart/form-data">

<h1><p align="center"><b>Upload a File</b></p></h1>

<p><span class="error">* Required Field.</span></p>


<label><b>Name</b></label></br> 
<input type="text" name="name">
<span class="error">* <?php echo $nameErr;?></span>
  <br><br>

<label><b>Location</b></label></br>
<input type="text" name="loc">
<span class="error">* <?php echo $locErr;?></span>
  <br><br>


<input type="file" name="uploaded_file"></input><br><br>

<button name="click" type="submit"><b>Upload</b></button>
    
</form>


<p>
        <a href="downloadfinal.php" target="_blank"><b>Retrieve PDF/Docx Files<b></a>
</p>

</body>


<?php

if( isset($_FILES['uploaded_file']) && isset($_REQUEST['click']))

{

if($_FILES['uploaded_file']['error'] == 0) 

{

$username = "test";
$password = "test123";
$servername = "hytsp00005";
$dbname = "uploadfiles";

$conn = new mysqli($servername, $username, $password,$dbname);


if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
   
$name = $_POST['name'];
$Location = $_POST['loc'];
$pdf_dat = $conn->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));


$fname = $_FILES['uploaded_file']['name'];
echo "$fname"; 

$ext1 = end((explode(".", $fname)));
echo "$ext1"; 

$sql = "INSERT INTO Pdf_details (Name,Location,PDF_Data,Extn) VALUES ('$name','$Location','$pdf_dat','$ext1')";


	if (mysqli_query($conn, $sql))
	{
    		echo "New record created successfully"; 
	} 

	else 
	{
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

}


mysqli_close($conn);

}


?>

</html>
