<?php
//require_once("../connections/dbcontroller.php");

$mysqli = new mysqli("localhost", "root", "", "slpools");

// check connection
if ($mysqli->connect_errno) {
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

//if (isset($_POST['submit'])) {
	
	$titulo = $_POST['titulo'];
	$localizacao = $_POST['localizacao'];
	$dimensoes = $_POST['dimensoes'];
	$descricao= $_POST['descricao'];
	
	

// Variable for indexing uploaded image.
$j = 0;
// Declaring Path for uploaded images.
$target_path = "../../img/galeria";


//$sql = mysql_query("INSERT INTO galeria (titulo, localizacao, dimensoes, descricao) VALUES ('$titulo', '$localizacao', '$dimensoes', '$descricao')");

//echo "INSERT INTO galeria (titulo, localizacao, dimensoes, descricao) VALUES ('$titulo', '$localizacao', '$dimensoes', '$descricao')";

$query = "INSERT INTO galeria (titulo, localizacao, dimensoes, descricao) VALUES ('$titulo', '$localizacao', '$dimensoes', '$descricao')";
$mysqli->query($query);
printf ("New Record has id %d.\n", $mysqli->insert_id);


//mysqli_query($mysqli, "SELECT * from galeria ORDERBY id_galeria");
$mysqli->real_query("SELECT * from galeria where id_galeria = ".$mysqli->insert_id." ");
$query2 = $mysqli->store_result();
$row = $query2->fetch_assoc();
    //$id = (int) $row['id'];
	echo $row["id_galeria"];
//$query2 = $mysqli->query("UPDATE `test` SET `label` = md5(rand()) WHERE `id` = $id");


// Loop to get individual element from the array
for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

    // Extensions which are allowed.
    $validextensions = array("jpeg", "jpg", "png");      

    // Explode file name from dot(.)
    $ext = explode('.', basename($_FILES['file']['name'][$i]));   

    // Store extensions in the variable.
    $file_extension = end($ext); 
    // Set the target path with a new name of image.
    $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];

    // Increment the number of uploaded images according to the files in array.
    $j = $j + 1;      

    if (($_FILES["file"]["size"][$i] < 300000) && in_array($file_extension, $validextensions)) {

        // If file moved to uploads folder.
        if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {

            echo '<div id="noerror">Image '.$j.'-->Image Uploaded!</div>';

            // File was moved, so execute code here
            //Connection to DB

            

            
			//$db_handle = new DBController();
			//$sql = "SELECT * from galeria ORDERBY id_galeria";
			
			//$result = $mysql_query($sql);
			//$registo = mysql_fetch_array($result);
			$query2 = "INSERT INTO fotos (id_galeria, caminho) VALUES (".$row["id_galeria"].", '".$_FILES['file']['name'][$i]."')";
			echo "INSERT INTO fotos (id_galeria, caminho) VALUES (".$row["id_galeria"].", '".$_FILES['file']['name'][$i]."')";
			$mysqli->query($query2);
            //Close DB connection
            //mysqli_close($con);

        //  If File Was Not Moved.
        } else {

            echo '<div id="error">Image '.$j.'--> <b>Please Try Again!</b></div>';
        }

    //If File Size And File Type Was Incorrect.
    } else {   

        echo '<div id="error">Image '.$j.'--> <b>Check file Size or Type</b></div>';

    }  
}
//}
?>