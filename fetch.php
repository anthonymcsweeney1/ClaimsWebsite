<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "test_db");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM claims 
  WHERE ClaimNum LIKE '%".$search."%'
  OR InvoiceNum LIKE '%".$search."%' 
  OR Status LIKE '%".$search."%' 
  OR claim_type LIKE '%".$search."%' 
  OR Cus_Name LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM claims ORDER BY id
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Claim Number</th>
     <th>Invoice Number</th>
     <th>Status</th>
     <th>Claim Type</th>
     <th>Customer Name</th>
     <th>Action</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {

     if   ($row["Status"] == 'Open')         {
            
  $output .= '
   <tr>
    <td>'.$row["ClaimNum"].'</td>
    <td>'.$row["InvoiceNum"].'</td>
    <td>'.$row["Status"].'</td>
    <td>'.$row["claim_type"].'</td>
    <td>'.$row["Cus_Name"].'</td>
      <td><a href= "ViewClaim.php?id='.$row["id"].'" class="edit">View</a></td>
         
                <td>    <a href="DeleteClaim.php?id='.$row["id"].'" class="trash">Cancel</a> </td> 
                   <td>    <a href="UpdateClaim.php?id='.$row["id"].'" class="trash">Edit</a> </td> 
                  <td>     <a href="Request.php?id='.$row["id"].'" class="trash">Request Approval</a> </td> 
                    
               
                       
              
   </tr>
  ';
 }
 
 else
 {
     $output .= '
   <tr>
    <td>'.$row["ClaimNum"].'</td>
    <td>'.$row["InvoiceNum"].'</td>
    <td>'.$row["Status"].'</td>
    <td>'.$row["claim_type"].'</td>
    <td>'.$row["Cus_Name"].'</td>
      <td><a href= "ViewClaim.php?id='.$row["id"].'" class="edit">View</a></td>
         
           
                  
               
                       
              
   </tr>
  ';
 }
 }
 
 echo $output;
}

else
{
 echo 'Data Not Found';
}

?>