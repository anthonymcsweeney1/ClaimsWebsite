<!DOCTYPE HTML>
<?php
//index.php


$message = '';

$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

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
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
 

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 

 $message = '
  <h2 align="center">Invoice Details</h2>
 
  <a> Dear Sir/Madam, </a><br><br><a>Invoice ' .$row['InvoiceNum']. ' has been assigned to you, for action. See summary details and attached invoice below.</a><br><br>
<a>Please review and take the nessary action for this invoice. You can Approve Or Reject the invoice from this e-mail by clicking one of the action buttons, you can navigate to the ERP system with this <a href="http://localhost/PhpProject1/ApprovalPage.php">Link</a> or you can use the Robopto mobile app.</a><br>

  <table border="1" width="100%" cellpadding="5" cellspacing="5">
   <tr>
    <td width="30%">ID</td>
    <td width="70%">'.$row['id'].'</td>
   </tr>
   <tr>
    <td width="30%">Claim Number</td>
    <td width="70%">'.$row['ClaimNum'].'</td>
   </tr>
   <tr>
    <td width="30%">Invoice Number</td>
    <td width="70%">'.$row['InvoiceNum'].'</td>
   </tr>
 <tr>
    <td width="30%">Customer</td>
    <td width="70%">'.$row['Cus_Name'].'</td>
   </tr>
    <tr>
    <td width="30%">Bill To</td>
    <td width="70%">'.$row['BillTo'].'</td>
   </tr>
    <tr>
    <td width="30%">Ship To</td>
    <td width="70%">'.$row['ShipTo'].'</td>
   </tr>
     <tr>
    <td width="30%">Claim Type</td>
    <td width="70%">'.$row['claim_type'].'</td>
   </tr>
   <tr>
    <td width="30%">Customer Reason</td>
    <td width="70%">'.$row['customer_reason'].'</td>
   </tr>
   <tr>
    <td width="30%">Offer Code</td>
    <td width="70%">'.$row['offercode'].'</td>
   </tr>
     <tr>
    <td width="30%">Customer Reason</td>
    <td width="70%">'.$row['PO_number'].'</td>
   </tr>
   <tr>
    <td width="30%">Settlement Method</td>
    <td width="70%">'.$row['settlement'].'</td>
   </tr>
   
     <tr>
    <td width="30%">Amount</td>
    <td width="70%">'.$row['amount'].'</td>
   </tr>
     <tr>
    <td width="30%">Invoice Date</td>
    <td width="70%">'.$row['invoice_date'].'</td>
   </tr>
    <tr>
    <td width="30%">Approver</td>
    <td width="70%">'.$row['Approver'].'</td>
   </tr>
    
  </table>
     <a href="http://localhost/PhpProject1/Approve.php?id='.$row['id'].'" class="trash">Approve</a><br>
                    <a href="http://localhost/PhpProject1/Reject.php?id='.$row['id'].'" class="a2">Reject</a><br>
                        <a href="http://localhost/PhpProject1/downloads.php?file_id='.$row['id'].'">Download Invoice</a>
 ';
 
 require 'PHPMailer/PHPMailerAutoload.php';
 $mail = new PHPMailer;
 $mail->IsSMTP();        //Sets Mailer to send message using SMTP
 $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
 $mail->Port = '465';        //Sets the default SMTP server port
 $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
 $mail->Username = 'roboptoap@gmail.com';     //Sets SMTP username
 $mail->Password = 'Anthony3!';     //Sets SMTP password
 $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
 $mail->From = ('no-reply@gmail.com');     //Sets the From email address for the message
 $mail->FromName = 'AP Automation';    //Sets the From name of the message
 $mail->AddAddress('antomc99@gmail.com', 'Approver');  //Adds a "To" address

 $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
 $mail->IsHTML(true);       //Sets message type to HTML
     //Adds an attachment from a path on the filesystem
 $mail->Subject = 'Invoice Action Needed';    //Sets the Subject of the message
 $mail->Body = $message;       //An HTML or plain text message body
 if($mail->Send())        //Send an Email. Return true on success or false on error
 {
  $message = '<div class="alert alert-success">Application Successfully Submitted</div>';
  
 }
 else
 {
  $message = '<div class="alert alert-danger">There is an Error</div>';
 }
}

?>
<html>
<head>
    <title>View Claim</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Claim Details</h1>
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
            <a href='Claims.php' class='btn btn-danger'>Back to Claim Page</a>
             &emsp; &emsp;&ensp;     <a  href="downloads.php?file_id=<?=$number?>">Download Invoice</a>
        
           
           
        </td>
    </tr>
</table>
       
       <?php print_r($message); ?>
     <form method="post" enctype="multipart/form-data">
         
         <input href="Request.php?id=<?=$row['id']?>" type="submit" name="submit" value="Request Approval" class="btn btn-info" />
      </div>
     </form>
       <a href="Request.php?id=<?=$row['id']?>" class="trash">Request Approval in DB</a>
       

       
       
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>