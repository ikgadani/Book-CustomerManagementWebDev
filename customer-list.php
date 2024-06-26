<?php
session_start();
include 'includes/database.inc.php';

$glyph = 'class="glyphicon glyphicon-arrow-down"';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['sort'])) {
   $sort = $_GET['sort'];
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
   $search = $_GET['search'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Book Template</title>

   <link rel="shortcut icon" href="../../assets/ico/favicon.png">   

   <!-- Bootstrap core CSS -->
   <link href="bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap theme CSS -->
   <link href="bootstrap3_bookTheme/theme.css" rel="stylesheet">


   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_bookTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>

<body>

<?php include 'includes/book-header.inc.php'; ?>
   
<div class="container">
   <div class="row">  <!-- start main content row -->

      <div class="col-md-2">  <!-- start left navigation rail column -->
         <?php include 'includes/book-left-nav.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 

      <div class="col-md-10">  <!-- start main content column -->
        
         <!-- book panel  -->
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>My Customers
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
               foreach ( $_GET as $key => $value ) {
                  if ($key == 'sort' || $key == 'search')  {
                  echo '|'.$key .'='. $value .'| ';
                  }
               }
            if (count($_GET) != 0) {
               echo '<form action="customer-list.php" style="display:inline;"><button type="submit" class="btn btn-danger"><b>X</b> Remove Filter</button></form>';
            }
         }
            

            ?>
           </h4></div>
           <table class="table">
             <tr>
             <th><a href="customer-list.php<?php 
             if (isset($_GET['search'])) { 
               echo "?search=".$_GET['search']."&";
            }
            else {
               echo "?";
            }
            echo 'sort=name';
               ?>
               " >Name</a><span <?php if(isset($_GET['sort'])) { if ($_GET['sort'] == "name") {echo $glyph;}}?> ></span></th>
               <th>Email</th>
               <th>Address</th>
               <th><a href="customer-list.php<?php 
             if (isset($_GET['search'])) { 
               echo "?search=".$_GET['search']."&";
            }
            else {
               echo "?";
            }
            echo 'sort=city';
               ?>
               " >City</a><span <?php if(isset($_GET['sort'])) { if ($_GET['sort'] == "city") {echo $glyph;}}?> ></span></th>
               <th><a href="customer-list.php<?php 
             if (isset($_GET['search'])) { 
               echo "?search=".$_GET['search']."&";
            }
            else {
               echo "?";
            }
            echo 'sort=country';
               ?>
               " >Country</a><span <?php if(isset($_GET['sort'])) { if ($_GET['sort'] == "country") {echo $glyph;}}?> ></span></th>
             </tr>

             <?php
               $sqlQuery = 'SELECT firstName, lastName, email, address, city, country FROM customers';
               if (isset($_GET["search"])) {
                  $sqlQuery .= " WHERE lastName=\"".$_GET["search"]."\"";
               }
               if ( isset($_GET['sort'])) {
                  if ( $_GET['sort'] == 'name' ) {
                     $sqlQuery .= ' ORDER BY lastName';
                  }
                  else if ( $_GET['sort'] == 'city') {
                     $sqlQuery .= ' ORDER BY city';
                  }
                  else if ( $_GET['sort'] == 'country') {
                     $sqlQuery .= ' ORDER BY country';
                  }
               }
               $result = $pdo->query( $sqlQuery );
               $numberOfRows = $result->rowCount();
               for($i=0; $i<$numberOfRows; $i++) {
                  $row = $result->fetch();
                  echo "<tr><td>".$row['firstName']." ".$row['lastName']."</td><td>".$row['email']."</td><td>".$row['address']."</td><td>".$row['city']."</td><td>".$row['country']."</td></tr>";    
               }   

             ?>

           </table>
         </div>           
      </div>
      
      


      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end container -->
   


   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_bookTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_bookTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_bookTheme/assets/js/holder.js"></script>
</body>
</html>