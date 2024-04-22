

<?php


 $mysqli = new  mysqli('localhost', 'tega', 'tega247', 'crud') or die (mysql_error($mysqli));
//how many record per pages
$rpp = 5;


isset($_GET['page']) ? $page =mysqli_escape_string($mysqli, $_GET['page']) : $page = 0;





//check for page 1
if($page >1){

  $start = ($page * $rpp ) -$rpp;
}


else{

  $start = 0;
}

//query db for total result
$result = $mysqli->query("SELECT id FROM `data` ") or die($mysqli->error);     
//get total record
$numRows = $result->num_rows;

//get total number of pages

$totalpages = $numRows/$rpp;
//query result
$result = $mysqli->query("SELECT * FROM `data` LIMIT $start, $rpp") or die($mysqli->error);     

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP CRUD</title>

		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="toastr.min.css">
  <script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>
<script src="toastr.min.js"></script>
<style type="text/css">

	.form-control{
		width: 150px;
    display: block;

}

.loader {
  position: fixed;
  top:0;
  left:0;
  right:0;
  bottom:0;
  background-color:#fff; /* change if the mask should have another color then white */
  z-index:999999;
}
.preloader{
    width:200px;
    height:200px;
    font-size: 24px;
    text-align: center;
    position:absolute;
    left:50%; 
    top:50%; 
    background-image:url(images/preloader.gif); 
    background-repeat:no-repeat;
    background-position:center;
    margin:-100px 0 0 -100px; 
}


	.loader.hid{
		
		animation-fill-mode: forwards;
		  
    -webkit-animation-name: delay; /* Safari 4.0 - 8.0 */
    -webkit-animation-duration: 0s; /* Safari 4.0 - 8.0 */
    -webkit-animation-delay: 2s; /* Safari 4.0 - 8.0 */
    animation-name: delay;
    animation-duration: 0s;
    animation-delay: 2s;

	}

@keyframes delay {

	100% {
		opacity:0;
		visibility:hidden;
	}
}
/*toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}*/


</style>
</head>
<body>


<div class="loader">
    <div class="preloader">
        Please Wait....
    </div>
  </div> 
  


		<script type="text/javascript">

			window.addEventListener("load", function(){


const loader = document.querySelector(".loader");

loader.className += " hid";//class "loader hidden"


			});
			


		</script>


<!--<button class="btn success" onclick="success_toast()" >success</button>-->


<script type="text/javascript">
	

function success_toast(){
	toastr.success("success message");
}

</script>




	


	<?php require_once 'process.php';    ?>




	<?php  


	if (isset($_SESSION['message'])):  ?>

		<div class="alert alert-<?=$_SESSION['msg_type']?>">

			<?php
			 echo $_SESSION['message'];
			 unset($_SESSION['message']);

			 ?>
           </div>


<?php endif ?>








<?php 

/* connect to database to base on (inded.php) page to create a loop to display them above the form in an html table,adding bootsrap.  */
//$mysqli = new mysqli('localhost', 'tega', 'tega247', 'crud') or die (mysqli_error($mysqli));

/* to run  query storing mysqli inside a result */
//$result = $mysqli->query("SELECT * FROM `data` ") or die($mysqli->error);     

   //pre_r($result); to print result with object. note: use one out of the two, pre_r($result); OR pre_r($result->fetch_assoc());//

    /*use to select data from the object. print more fecth_assoc(); more record will be displace so and so fort. provided that the record has aready exist on ur database sql table*/
    /*1pre_r($result->fetch_assoc());*/
    /*2pre_r($result->fetch_assoc());*/
    /*3pre_r($result->fetch_assoc());*/
    /*4pre_r($result->fetch_assoc());*/
    /*5pre_r($result->fetch_assoc());*/
    /*6pre_r($result->fetch_assoc());*/
    /*7pre_r($result->fetch_assoc());*/
    /*8pre_r($result->fetch_assoc());*/
    /*9pre_r($result->fetch_assoc());*/
    /*10pre_r($result->fetch_assoc());*/



    
?>


<?php
/* use to print out  array result in more readabe format   */
   function pre_r($array) {
	     echo '<pre>';
	    print_r($array);
	    echo '</pre>';

}

?>

<!-- create bootsrap  to displace the database form in table form above the databform  -->
<div class="container">
	<table class="table table-striped">
    <thead>
      <tr>
        <th>name</th>
        <th>Location</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>

<?php
 while  ($row = $result->fetch_assoc()):?>

 	<tr> 
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['location']; ?></td>
        <td>
        	<a href="inded?edit=<?php echo $row['id']; ?>"
        		class="btn btn-info">Edit</a>

        		<a href="process?delete=<?php echo $row['id']; ?>"
        			class="btn btn-danger">Delete</a>
        	
        </td>
       </tr>

   <?php endwhile; ?>



    
    </tbody>


  </table>


  <?php 


if($page>1){

   echo "<a href='?page=".($page-1)."' class='btn btn-danger'>previous</a>";


}



for($x =1 ; $x<$totalpages; $x++){

echo "<a href='?page=$x' class='btn btn-primay'> $x </a>";


}




if($x >$page){

   echo "<a href='?page=".($page+1)."' class='btn btn-danger'>Next</a>";




}

    ?>
</div>



  <!--<tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>


      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>-->





<div class="container " style="padding-left: 440px;margin-top:200px;">
<form action="process.php" method="POST" >

	<input type="hidden" name="id" value="<?php echo $id;   ?>">

		<div class="form-group">
		<label>name:</label>
		<input type="text" name="name" class="form-control" value="<?php echo $name;  ?>" placeholder="Enter your Name" >
	</div>


		<div class="form-group">
		<label>location:</label>
		<input type="text" name="location" class="form-control" value="<?php echo $location;  ?>" placeholder="Enter your Location">
	</div>
 

	<div class="form-group">

		<?php 
		 if ($update == true):
		  ?>
		  <button type="submit" class="btn btn-info" name="update" >update</button>

		  <?php else:       ?>
<button type="submit" class="btn btn-primary" name="save" >Save</button>
<?php endif;   ?>
	</div>
</form>
</div>






















</body>
</html>