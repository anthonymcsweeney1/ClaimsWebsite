  <?php
        
           
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "INSERT INTO approved SELECT * FROM request WHERE id = $id; DELETE FROM request WHERE id = $id; Update approved SET status ='Approved' Where id = $id; Update claims SET status ='Approved' Where id = $id;" ;  echo "<script>alert('Claim is now approved.  Thank you.')</script>";
    $stmt = $con->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
   
 
    // values to fill up our form
    $ClaimNum = $row['ClaimNum'];
    $InvoiceNum = $row['InvoiceNum'];
    $status = $row['status'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
            
           
        
    
    ?>
<htm>
    <a href="ApprovalPage.php" >Go back to Claim page</a>
    
</htm>

