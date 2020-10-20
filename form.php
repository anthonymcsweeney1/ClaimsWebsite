<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


$objUser = new User();
// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmt = $objUser->runQuery("SELECT * FROM users WHERE id=:id");
    $stmt->execute(array(":id" => $id));
    $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
  $id = null;
  $rowUser = null;
}

// POST
if(isset($_POST['btn_save'])){
  $username   = strip_tags($_POST['user_name']);
  $password  = strip_tags($_POST['password']);
   $name  = strip_tags($_POST['name']);
    $type  = strip_tags($_POST['User_Type']);

  try{
     if($id != null){
       if($objUser->update($username, $password, $name, $type, $id)){
         $objUser->redirect('Users.php?updated');
       }
     }else{
       if($objUser->insert($username, $password, $name, $type)){
         $objUser->redirect('Users.php?inserted');
       }else{
         $objUser->redirect('Users.php?error');
       }
     }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Head metas, css, and title -->
       
    </head>
    <body>
      
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar menu -->
               
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                  <h1 style="margin-top: 10px">Add / Edit Users</h1>
                  <p>Required fields are in (*)</p>
                  <form  method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input class="form-control" type="text" name="id" id="id" value="<?php print($rowUser['id']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input  class="form-control" type="text" name="username" id="user_name" placeholder="First Name and Last Name" value="<?php print($rowUser['user_name']); ?>" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="email">Password *</label>
                        <input  class="form-control" type="text" name="password" id="password" placeholder="johndoel@gmail.com" value="<?php print($rowUser['password']); ?>" required maxlength="100">
                    </div>
                       <div class="form-group">
                        <label for="email">name *</label>
                        <input  class="form-control" type="text" name="name" id="name" placeholder="johndoel@gmail.com" value="<?php print($rowUser['name']); ?>" required maxlength="100">
                    </div>
                       <div class="form-group">
                        <label for="email">Type *</label>
                        <input  class="form-control" type="text" name="User_Type" id="User_Type" placeholder="johndoel@gmail.com" value="<?php print($rowUser['User_Type']); ?>" required maxlength="100">
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Save">
                  </form>
                </main>
            </div>
        </div>

    </body>
</html>