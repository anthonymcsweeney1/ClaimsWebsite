<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "test_db");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM offer 
  WHERE OfferCode LIKE '%".$search."%'
  
 ";
}
else
{
 $query = "
  SELECT * FROM offer ORDER BY id
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Offer Code</th>
         
     <th>Customer </th>
   
     <th>Earned</th>
     
     <th>Paid </th>
   
     <th>Action</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {

     
            
  $output .= '
   <tr>
  
    <td>'.$row["OfferCode"].'</td>
          <td>'.$row["Customer"].'</td>
    <td>'.$row["Earned"].'</td>
    <td>'.$row["Paid"].'</td>
    
      <td><a href= "ViewOffer.php?id='.$row["ID"].'" class="edit">View</a></td>
                       
              
   </tr>
  ';
 }
 

 
 
 echo $output;
}


else
{
 echo 'No Offer Found';
}

?>