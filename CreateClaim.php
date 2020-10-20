<!DOCTYPE HTML>
<html>
<head>
    <title>Create a Claim </title>
    
    <style>
   input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
    </style>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Create Claim </h1>
            <h4>This page allows you to create a claim. Please enter data for the required fields and click 'Create'</h4>
        </div>
        
        
 <?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'test_db');

$sql = "SELECT * FROM claims";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    $ClaimNum = $_POST['ClaimNum'];
     $InvoiceNum = $_POST['InvoiceNum'];
    $Cus_Reason = $_POST['customer_reason'];
    $ClaimType = $_POST['ClaimType'];
    $OfferCode = $_POST['OfferCode'];
    $PO = $_POST['PO_number'];
    $settlement = $_POST['settlement'];
    $Cus_Name = $_POST['Cus_Name'];
     $BillTo = $_POST['BillTo'];
    $BillToAcc = $_POST['BillToAcc'];
     $ShipTo = $_POST['ShipTo'];
      $Cus_ID = $_POST['Cus_ID'];
    $Approver = $_POST['Approver'];
   
    $Amount = $_POST['Amount'];
    
     // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    
    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
   
    


    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            
            $sql = "INSERT INTO claims (Invoice_PDF, InvoiceNum, ClaimNum, Status, customer_reason, claim_type, offercode, settlement, PO_number, amount, size, Cus_Name, BillTo, BillToAcc, ShipTo, Cus_ID, Approver) VALUES ('$filename', '$InvoiceNum', '$ClaimNum', 'Open' ,'$Cus_Reason', '$ClaimType', '$OfferCode', '$settlement', '$PO', '$Amount', '$size', '$Cus_Name', '$BillTo', '$BillToAcc', '$ShipTo', '$Cus_ID', '$Approver')";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}

    
?>
        
        <h4>Input Customer ID to fill out form</h4>
<form method="post" action="">
<input type="text" id="id" name="id">
<input type="submit" name="search" value ="Search">
</form>
        
        <br>

 <a href='Claims.php' class='btn btn-danger'>Back to read products</a>
<?php





$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,'test_db');

if(isset($_POST['search']))
{
    $id = $_POST['id'];
    
    $query = "SELECT * FROM tbl_customer WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);
    
    while($row = mysqli_fetch_array($query_run))
    {
        ?>
<form action="" method ="POST">
    <INPUT TYPE ="hidden" name ="CustomerName" value="<?php echo $row['id']?>"/>
     
    
</form>
      <!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" >
    <table class='table table-hover table-responsive table-bordered'>
      
        <tr>
            <td>Claim Number</td>
            <td><input type='text' placeholder= 'CLA2597283'name='ClaimNum' class='form-control' /></td>
        </tr>
        <tr>
            <td>Invoice Number</td>
            <td><textarea name='InvoiceNum' class='form-control'></textarea></td>
        </tr>
      
   
  
        <tr>
            <td>Customer Reason</td>
             <td>  <select name="customer_reason">
    <option value="SAO T1">SAO T1 </option>
    <option value="MDF T1">MDF T1</option>
    <option value="Rebate">Rebate</option>
  
    </select>
   </td>
        </tr>
          <tr>
            <td>Claim Type</td>
            <td><select name="ClaimType">
    <option value="SAO T1">SAO T1 </option>
    <option value="MDF T1">MDF T1</option>
    <option value="Rebate">Rebate</option>
  
    </select></td>
        </tr>
         
          
           <INPUT TYPE ="text" hidden name ="Cus_ID" value="<?php echo $row['id']?>"/>
       
         <tr>
            <td>Customer Name</td>
            <td><INPUT TYPE ="text" readonly name ="Cus_Name" value="<?php echo $row['CustomerName']?>"/></td>
        </tr>
         <tr>
            <td>Bill To</td>
            <td><INPUT TYPE ="text" readonly name ="BillTo" value="<?php echo $row['Address']?>"/></td>
        </tr>
        <tr>
            <td>Bill To Account</td>
            <td><INPUT TYPE ="text" readonly name ="BillToAcc" value="<?php echo $row['PostalCode']?>"/></td>
        </tr>
         <tr>
            <td>Ship To</td>
            <td><INPUT TYPE ="text" readonly name ="ShipTo" value="<?php echo $row['ShipTo']?>"/></td>
        </tr>
        <tr>
            <td>Currency</td>
            <td><textarea name='Currency' class='form-control'></textarea></td>
        </tr>
         <tr>
            <td>Amount</td>
            <td><textarea name='Amount' class='form-control'></textarea></td>
        </tr>
          <tr>
            <td>Offer Code</td>
            <td><textarea name='OfferCode' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>Reference Number</td>
            <td><textarea name='PO_number' class='form-control'></textarea></td>
        </tr>
           <tr>
            <td>Settlement Method</td>
           <td>  <select name="settlement">
    <option value="Credit Memo">Credit Memo</option>
    <option value="AP payment">AP payment</option>
    <option value="Chargeback">Chargeback</option>
  
    </select><br>
            </td>
        </tr>
        
        <tr> 
         <td>Approver</td>   
         <td> <?php
    // start of dbcon
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test_db";


    $conn = new mysqli($servername, $username, $password, $dbname);
    //end of dbcon

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT * FROM `users` WHERE `User_Type` = 'ADMIN'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "<select name='Approver'>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<option value='" . $row['user_name'] . "'>" . $row['user_name'] . "</option>";
        }
        echo "</select>";
    } 
    $conn->close();
    ?>
             </td>
        </tr>
        
    
      <h3>Upload File</h3>
          <input type="file" name="myfile"> <br>
        <tr>
            <td></td>
            <td>
                <input type='submit' name="save" value='Create' class='btn btn-primary' />
           
            </td>
        </tr>
    </table>
    
</form>

  
<?php
    }
}
?>
        
       
 


          
    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script>
function FillBilling(f) {
  if(f.billingtoo.checked == true) {
    f.Customer.value=f.CustomerName.value ;
   
  }
  else
	  {
     f.Customer.value = "";
   
  }
}</script>
  
</body>
</html>