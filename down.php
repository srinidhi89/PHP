

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



<head>
		<title>Download File From MySQL</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<body>

<form method="get" action="down.php" enctype="multipart/form-data">

<h1><p align="center"><b>Retrieve data from PDF Files</b></p></h1>

<p><span class="error">* Required Field.</span></p>


<label><b>PDF Id</b></label></br> 
<input type="number" name="id" min=1>
<span class="error">* <?php echo $nameErr;?></span>
  <br><br>

<button name="clickit" type="submit"><b>Download</b></button>
    
</form>

</body>


<?php


if(isset($_GET['id']) && isset($_REQUEST['clickit'])) 
{

    $id = intval($_GET['id']);

	//echo "$id";
 

    if($id <= 0) 
    {
        die('The ID is invalid!');
    }

	else 
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

	
	$pdfdat = $_GET['PDF_Data'];

	$sql = "SELECT Name,PDF_Data FROM Pdf_details where Pdf_Id = $id";

	$result = $conn->query($sql);


	 if($result->num_rows == 1) 
{

	$row = $result->fetch_assoc();


	header('Content-Type: application/pdf');
    	header('Accept-Ranges: bytes');
    	header('Content-Transfer-Encoding: binary');
    	header("Content-Disposition: attachment; filename="  . $id .'.pdf');

		echo $row['PDF_Data'];    
    
} 


else 
{
    echo "0 results";
} 
	

$conn->close();
 
	}

}

?>

</html>
