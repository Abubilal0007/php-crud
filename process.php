
<?php 


$id = '0';
$update = false;
$name ='';
$location ='';

session_start();




/*  $mysqli  = new  mysqli('') is use to connect to the database
    using appropriate host, username, password, database*/
 $mysqli = new  mysqli('localhost', 'tega', 'tega247', 'crud') or die (mysql_error($mysqli));





if  (isset($_POST['save'])){

	$name = $_POST['name'];
	$location = $_POST['location'];

	/*  $mysqli->query is use to insert a record into database*/
  $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or 
          die($mysqli->error);



          $_SESSION['message'] = "Record has been saved!";
	      $_SESSION['msg_type'] = "success";


	header("location: inded.php");

}







if (isset($_GET['delete'])) {


$id = $_GET['delete'];
$mysqli->query("DELETE  FROM data WHERE id=$id") or die($mysqli->error());



$_SESSION['message'] = "Record has been deleted!";
$_SESSION['msg_type'] = "danger";

header("location: inded.php");

}




if (isset($_GET['edit'])){

	$id = $_GET['edit'];
	$update = true;

    $result = $mysqli->query("SELECT * FROM `data` WHERE  id=$id") or die($mysqli->error());




	if ($result->num_rows ==1){

		$row = $result->fetch_array();
		$name = $row['name'];
		$location =$row['location'];
		



	}


}

if (isset($_POST['update'])){

$id = $_POST['id'];
$name = $_POST['name'];
$location = $_POST['location'];

$mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or
 die($mysqli->error);


$_SESSION['message'] = "Record has been updated!";

$_SESSION['msg_type'] = "warning";

header('location: inded.php');






}









?>













<!--form output
<script>
  var typed4 = new Typed('#typed4', {
    strings: ['Some strings without', 'Some HTML', 'Chars'],
    typeSpeed: 0,
    backSpeed: 0,
    attr: 'placeholder',
    bindInputFocusEvents: true,
    loop: true
  });
</script>




//form output
  var typed4 = new Typed('#typed4', {
    strings: ['Some strings without', 'Some HTML', 'Chars'],
    typeSpeed: 0,
    backSpeed: 0,
    attr: 'placeholder',
    bindInputFocusEvents: true,
    loop: true
  });
-->
