<?php

include 'includes/database.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; 
   charset=UTF-8" />
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

      <div class="col-md-6">  <!-- start main content column -->
        
         <!-- book panel  -->
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>Catalog
            <?php

            if ( isset($_GET['category'])) {
               echo '|Category='.$_GET['category'].'| <form action="book-list.php" style="display:inline;"><button type="submit" class="btn btn-danger"><b>X</b> Remove Filter</button></form>';
            }
            if ( isset($_GET['imprint'])) {
               echo '|Imprint='.$_GET['imprint'].'| <form action="book-list.php" style="display:inline;"><button type="submit" class="btn btn-danger"><b>X</b> Remove Filter</button></form>';
            }
            if ( isset($_GET['status'])) {
               echo '|Status='.$_GET['status'].'| <form action="book-list.php" style="display:inline;"><button type="submit" class="btn btn-danger"><b>X</b> Remove Filter</button></form>';
            }
            if ( isset($_GET['binding'])) {
               echo '|Binding='.$_GET['binding'].'| <form action="book-list.php" style="display:inline;"><button type="submit" class="btn btn-danger"><b>X</b> Remove Filter</button></form>';
            }
            
            ?></h4></div>
           <table class="table">
             <tr>
               <th>Cover</th>
               <th>ISBN</th>
               <th>Title</th>
             </tr>
             <?php
               $sqlQuery = 'SELECT ID, CoverImage, ISBN10, Title, SubcategoryID, ImprintID, ProductionStatusID, BindingTypeID FROM books';

               if (isset($_GET['category'])) {
                   $category = $_GET['category'];
                   $sqlQuery .= ' WHERE SubcategoryID = '.$category;
               }
               else if ( isset($_GET['imprint'])) {
                  $imprint = $_GET['imprint'];
                  $sqlQuery .= ' WHERE ImprintID = '.$imprint;
               }
               else if ( isset($_GET['status'])) {
                  $status = $_GET['status'];
                  $sqlQuery .= ' WHERE ProductionStatusID = '.$status;
               }
               else if ( isset($_GET['binding'])) {
                  $binding = $_GET['binding'];
                  $sqlQuery .= ' WHERE BindingTypeID = '.$binding;
               }
               
               $sqlQuery .= ' ORDER BY Title';
               $stmt = $pdo->prepare($sqlQuery);
               $stmt->execute();
               $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
               
               foreach ($result as $row) {
                   echo "<tr><td><image src=\"images\\tinysquare\\".$row['ISBN10'].".jpg\" /></td><td>".$row['ISBN10']."</td><td><a href=\"book-details.php?id=".$row['ID']."\" >".$row['Title']."</a></td></tr>";
               } 
             ?>
             
           </table>
         </div>           
      </div>
      
      <div class="col-md-2">  <!-- start left navigation rail column -->
         <div class="panel panel-info spaceabove">
            <div class="panel-heading"><h4>Categories</h4></div>
               <ul class="nav nav-pills nav-stacked">

               <?php
               $sqlQuery = 'SELECT ID, SubcategoryName FROM subcategories ORDER BY SubcategoryName LIMIT 20';

               $result = $pdo->query( $sqlQuery );
               $numberOfRows = $result->rowCount();
               for($i=0; $i<$numberOfRows; $i++) {
                  $row = $result->fetch();
                  echo "<li><a href=\"book-list.php?category=".$row['ID']."\"> ".$row['SubcategoryName']."</a></li>";    
               }   
             ?>
                  
             </ul> 
         </div>
                 
      </div>  <!-- end left navigation rail --> 
      
      <div class="col-md-2">  <!-- start left navigation rail column -->
         <div class="panel panel-info spaceabove">
            <div class="panel-heading"><h4>Imprints</h4></div>
            <ul class="nav nav-pills nav-stacked">

            <?php
               $sqlQuery = 'SELECT ID, Imprint FROM imprints';

               $result = $pdo->query( $sqlQuery );
               $numberOfRows = $result->rowCount();
               for($i=0; $i<$numberOfRows; $i++) {
                  $row = $result->fetch();
                  echo "<li><a href=\"book-list.php?imprint=".$row['ID']."\"> ".$row['Imprint']."</a></li>";    
               }   
             ?>
               
             </ul>
         </div>    

         <div class="panel panel-info">
            <div class="panel-heading"><h4>Status</h4></div>
            <ul class="nav nav-pills nav-stacked">

            <?php
               $sqlQuery = 'SELECT ID, ProductionStatus FROM productionstatuses';

               $result = $pdo->query( $sqlQuery );
               $numberOfRows = $result->rowCount();
               for($i=0; $i<$numberOfRows; $i++) {
                  $row = $result->fetch();
                  echo "<li><a href=\"book-list.php?status=".$row['ID']."\"> ".$row['ProductionStatus']."</a></li>";    
               }   
             ?>
               
             </ul>
         </div>  
         
         <div class="panel panel-info">
            <div class="panel-heading"><h4>Binding</h4></div>
            <ul class="nav nav-pills nav-stacked">

            <?php
               $sqlQuery = 'SELECT ID, BindingType FROM bindingtypes';

               $result = $pdo->query( $sqlQuery );
               $numberOfRows = $result->rowCount();
               for($i=0; $i<$numberOfRows; $i++) {
                  $row = $result->fetch();
                  echo "<li><a href=\"book-list.php?binding=".$row['ID']."\"> ".$row['BindingType']."</a></li>";    
               }   
             ?>
               
             </ul>
         </div>           
      </div>  <!-- end left navigation rail -->       


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