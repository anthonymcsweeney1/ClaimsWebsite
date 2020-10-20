<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Update a Record - PHP CRUD Tutorial</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Product</h1>
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
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
    <?php
 
// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE claims 
                    SET ClaimNum=:ClaimNum, InvoiceNum=:InvoiceNum, Status=:status, customer_reason=:customer_reason, Cus_Name=:Cus_Name, offercode=:offercode, settlement=:settlement, PO_number=:PO_number, amount=:amount, invoice_date=:invoice_date
                    WHERE id = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $ClaimNum=htmlspecialchars(strip_tags($_POST['ClaimNum']));
        $InvoiceNum=htmlspecialchars(strip_tags($_POST['InvoiceNum']));
        $status=htmlspecialchars(strip_tags($_POST['status']));
         $Customer_reason=htmlspecialchars(strip_tags($_POST['customer_reason']));
         $CusName=htmlspecialchars(strip_tags($_POST['Cus_Name']));
        $offercode=htmlspecialchars(strip_tags($_POST['offercode']));
         $settlement=htmlspecialchars(strip_tags($_POST['settlement']));
          $PO_number=htmlspecialchars(strip_tags($_POST['PO_number']));
           $Amount=htmlspecialchars(strip_tags($_POST['amount']));
               $date=htmlspecialchars(strip_tags($_POST['invoice_date']));
           
        // bind the parameters
        $stmt->bindParam(':ClaimNum', $ClaimNum);
        $stmt->bindParam(':InvoiceNum', $InvoiceNum);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':customer_reason', $Customer_reason);
        $stmt->bindParam(':Cus_Name', $CusName);
        $stmt->bindParam(':offercode', $offercode);
        $stmt->bindParam(':settlement', $settlement);
        $stmt->bindParam(':PO_number', $PO_number);
        $stmt->bindParam(':amount', $Amount);
         $stmt->bindParam(':invoice_date', $date);
        
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
     
        
        <tr>
            <td>Claim Number</td>
            <td><input type='text' name='ClaimNum' value="<?php echo htmlspecialchars($ClaimNum, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Invoice Number</td>
            <td><input type='text' name='InvoiceNum' value="<?php echo htmlspecialchars($InvoiceNum, ENT_QUOTES);  ?>" class='form-control' /></td>
       </tr>
         <tr>
            <td>Customer</td>
            <td><input type='text' name='Cus_Name' value="<?php echo htmlspecialchars($CusName, ENT_QUOTES);  ?>" class='form-control' /></td>
       </tr>
         <tr>
            <td>Bill To:</td>
            <td><input type='text' name='Cus_Name'  class='form-control' /></td>
       </tr>
         <tr>
            <td>Ship To:</td>
            <td><input type='text' name='Cus_Name'  class='form-control' /></td>
       </tr>
        <tr>
            <td>Status</td>
            <td><input type='text' name='status' readonly value="<?php echo htmlspecialchars($status, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
         <tr>
            <td>Customer Reason</td>
            <td><input type='text' name='customer_reason' value="<?php echo htmlspecialchars($Customer_reason, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
         <tr>
            <td>Claim Type</td>
            <td><input type='text' name='customer_reason' value="<?php echo htmlspecialchars($Customer_reason, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
          <tr>
            <td>Offer Code</td>
            <td><input type='text' name='offercode' value="<?php echo htmlspecialchars($offercode, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
          <tr>
            <td>Settlement</td>
            <td><input type='text' name='settlement' value="<?php echo htmlspecialchars($settlement, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
         <tr>
            <td>Customer Reference</td>
            <td><input type='text' name='PO_number' value="<?php echo htmlspecialchars($PO_number, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
         <tr>
            <td>Amount</td>
            <td><input type='text' name='amount' value="<?php echo htmlspecialchars($Amount, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
          <tr>
            <td>Due Date</td>
            <td><input type='text' name='invoice_date' value="<?php echo htmlspecialchars($date, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='Claims.php' class='btn btn-danger'>Back to read products</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>