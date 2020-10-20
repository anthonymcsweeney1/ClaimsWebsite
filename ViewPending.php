<!DOCTYPE HTML>

<html>
<head>
    <title>View Pending Claim</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Pending Claim</h1>
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
    $query = "SELECT * FROM claims WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $number = $row['id'];
    $ClaimNum = $row['ClaimNum'];
    $InvoiceNum = $row['InvoiceNum'];
    $status = $row['Status'];
    $Customer_reason = $row['customer_reason'];
    $claim_type = $row['claim_type'];
    $offercode = $row['offercode'];
    $settlement = $row['settlement'];
    $PO_number = $row['PO_number'];
    $date = $row['invoice_date'];
    $Amount = $row['amount'];
    $CusName = $row['Cus_Name'];
     $BillTo = $row['BillTo'];
      $BillToAcc = $row['BillToAcc'];
     $ShipTo = $row['ShipTo'];
     $Approver = $row['Approver'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
       <!--we have our html table here where the record will be displayed-->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>ID</td>
        <td><?php echo htmlspecialchars($number, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Claim Number</td>
        <td><?php echo htmlspecialchars($ClaimNum, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Invoice Number</td>
        <td><?php echo htmlspecialchars($InvoiceNum, ENT_QUOTES);  ?></td>
    </tr>
      <tr>
        <td>Customer</td>
        <td><?php echo htmlspecialchars($CusName, ENT_QUOTES);  ?></td>
    </tr>
        <tr>
        <td>Bill To:</td>
        <td><?php echo htmlspecialchars($BillTo, ENT_QUOTES);  ?></td>
    </tr>
     <tr>
        <td>Bill To Account</td>
        <td><?php echo htmlspecialchars($BillToAcc, ENT_QUOTES);  ?></td>
    </tr>
      <tr>
        <td>Ship To:</td>
        <td><?php echo htmlspecialchars($ShipTo, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?php echo htmlspecialchars($status, ENT_QUOTES);  ?></td>
    </tr>
      <tr>
        <td>Customer Reason</td>
        <td><?php echo htmlspecialchars($Customer_reason, ENT_QUOTES);  ?></td>
    </tr>
  
     <tr>
        <td>Claim Type</td>
        <td><?php echo htmlspecialchars($claim_type, ENT_QUOTES);  ?></td>
    </tr>
     <tr>
        <td>Offer Code</td>
        <td><?php echo htmlspecialchars($offercode, ENT_QUOTES);  ?></td>
    </tr>
     <tr>
        <td>Settlement</td>
        <td><?php echo htmlspecialchars($settlement, ENT_QUOTES);  ?></td>
    </tr>
      <tr>
        <td>Customer Refernce</td>
        <td><?php echo htmlspecialchars($PO_number, ENT_QUOTES);  ?></td>
    </tr>
     <tr>
        <td>Amount</td>
        <td><?php echo htmlspecialchars($Amount, ENT_QUOTES);  ?></td>
    </tr>
     <tr>
        <td>Date</td>
        <td><?php echo htmlspecialchars($date, ENT_QUOTES);  ?></td>
    </tr>
     <tr>
        <td>Approver</td>
        <td><?php echo htmlspecialchars($Approver, ENT_QUOTES);  ?></td>
    </tr>
     <tr>
        <td>Approver Email</td>
        <td><?php echo htmlspecialchars($date, ENT_QUOTES);  ?></td>
    </tr>
    
    <tr>
        <td></td>
        <td>
            <?php include 'filesLogic.php';?>
            <a href='PendingClaims.php' class='btn btn-danger'>Back to Claim Page</a>
        &emsp; &emsp;&ensp;     <a  href="downloads.php?file_id=<?=$number?>">Download Invoice</a>
           
           
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
