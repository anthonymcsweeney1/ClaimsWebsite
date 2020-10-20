<!DOCTYPE HTML>

<html>
<head>
    <title>View Offer Code</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Offer Code</h1>
        </div>
         
       <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM offer WHERE ID = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
 
    $OfferCode = $row['OfferCode'];
    $Earned = $row['Earned'];
    $Paid = $row['Paid'];
  
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
       <!--we have our html table here where the record will be displayed-->
<table class='table table-hover table-responsive table-bordered'>
   
    <tr>
        <td>Offer Code</td>
        <td><?php echo htmlspecialchars($OfferCode, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Earned Amount</td>
        <td><?php echo htmlspecialchars($Earned, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Paid Amount</td>
        <td><?php echo htmlspecialchars($Paid, ENT_QUOTES);  ?></td>
    </tr>
     
        <td></td>
        <td>
           
            <a href='OfferCode.php' class='btn btn-danger'>Back to Offer Codes Page</a>
       
        </td>
    </tr>
</table>
       

       
       
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
