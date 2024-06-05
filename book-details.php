<?php

include 'includes/database.inc.php';

$sqlQuery = 'SELECT * FROM books WHERE ID='.$_GET['id'];

               $result = $pdo->query( $sqlQuery );
               $row = $result->fetch();
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

      <div class="col-md-10">  <!-- start main content column -->
        
         <!-- book panel  -->
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>Book Details</h4></div>
           
           <table class="table">
             <tr>
               <th>Cover</th>
               <td>
                  <?php
                    echo '<image src="images\\tinysquare\\'.$row['ISBN10'].'.jpg" />';
                  ?>
               </td>
             </tr>            
             <tr>
               <th>Title</th>
               <td><em>
                <?php
                  echo $row['Title'];
                ?>
               </em></td>
             </tr>    
             <tr>
               <th>Authors</th>
               <td>
               <?php
                $authorQuery = 'SELECT FirstName, LastName FROM authors
                JOIN bookauthors ON authors.ID = bookauthors.authorID JOIN books ON bookauthors.bookID = books.ID WHERE books.ID='.$_GET['id'];
                 $authors = $pdo->query( $authorQuery );
                 $numberOfRows = $authors->rowCount();
               for($i=0; $i<$numberOfRows; $i++) {
                  $author = $authors->fetch();
                  echo $author['FirstName'].' '.$author['LastName']."<br>";   
               }  
                  
                ?>
               </td>
             </tr>   
             <tr>
               <th>ISBN-10</th>
               <td>
               <?php
                  echo $row['ISBN10'];
                ?>
               </td>
             </tr>
             <tr>
               <th>ISBN-13</th>
               <td>
               <?php
                  echo $row['ISBN13'];
                ?>
               </td>
             </tr>
             <tr>
               <th>Copyright Year</th>
               <td>
               <?php
                  echo $row['CopyrightYear'];
                ?>
               </td>
             </tr>   
             <tr>
               <th>Instock Date</th>
               <td>
               <?php
                  echo $row['LatestInstockDate'];
                ?>
               </td>
             </tr>              
             <tr>
               <th>Trim Size</th>
               <td>
               <?php
                  echo $row['TrimSize'];
                ?>
               </td>
             </tr> 
             <tr>
               <th>Page Count</th>
               <td>
               <?php
                  echo $row['PageCountsEditorialEst'];
                ?>
               </td>
             </tr> 
             <tr>
               <th>Description</th>
               <td>
               <?php
                  echo $row['Description'];
                ?>
               </td>
             </tr> 
             <tr>
               <th>Sub Category</th>
               <td>
               <?php
               $categoryQuery = 'SELECT SubcategoryName FROM subcategories
               JOIN books ON subcategories.ID = books.SubcategoryID WHERE books.ID='.$_GET['id'];
                $categories = $pdo->query( $categoryQuery );
                $category = $categories->fetch();
                 echo $category['SubcategoryName'];
                ?>
               </td>
             </tr>
             <tr>
               <th>Imprint</th>
               <td>
               <?php
               $imprintQuery = 'SELECT Imprint FROM imprints
               JOIN books ON imprints.ID = books.imprintID WHERE books.ID='.$_GET['id'];
                $imprints = $pdo->query( $imprintQuery );
                $imprint = $imprints->fetch();
                 echo $imprint['Imprint'];
                ?>
               </td>
             </tr>   
             <tr>
               <th>Binding Type</th>
               <td>
               <?php
               $bindingQuery = 'SELECT BindingType FROM bindingtypes
               JOIN books ON bindingtypes.ID = books.BindingTypeID WHERE books.ID='.$_GET['id'];
                $bindings = $pdo->query( $bindingQuery );
                $binding = $bindings->fetch();
                 echo $binding['BindingType'];
                ?>
               </td>
             </tr> 
             <tr>
               <th>Production Status</th>
               <td>
               <?php
               $prodQuery = 'SELECT ProductionStatus FROM productionstatuses
               JOIN books ON productionstatuses.ID = books.ProductionStatusID WHERE books.ID='.$_GET['id'];
                $prods = $pdo->query( $prodQuery );
                $prod = $prods->fetch();
                 echo $prod['ProductionStatus'];
                ?>
               </td>
             </tr>              
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