<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $username = isset($_POST['user_name']) ? $_POST['user_name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $type = isset($_POST['User_Type']) ? $_POST['User_Type'] : '';
      
        // Update the record
        $stmt = $pdo->prepare('UPDATE users SET id = ?, user_name = ?, password = ?, name = ?, User_Type = ? WHERE id = ?');
        $stmt->execute([$id, $username, $password, $name, $type,  $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$contact['id']?>" readonly id="id">
        <input type="text" name="name" placeholder="John Doe" value="<?=$contact['name']?>" id="name">
        <label for="email">Username/Email</label>
        <label for="phone">Password</label>
        <input type="text" name="user_name" placeholder="johndoe@example.com" value="<?=$contact['user_name']?>" id="email">
        <input type="text" name="password" placeholder="******" value="<?=$contact['password']?>" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <input type="text" name="User_Type" placeholder="Admin" value="<?=$contact['User_Type']?>" id="title">
        <p>Please select Job Role:</p>
  <input type="radio" id="user" name="User_Type" value="User">
  <label for="user">User</label><br>
  <input type="radio" id="admin" name="User_Type" value="Admin">
  <label for="admin">Admin</label><br>
  <input type="radio" id="supplier" name="User_Type" value="Supplier">
  <label for="supplier">Supplier</label><br>
  <input type="radio" id="CFO" name="User_Type" value="CFO">
  <label for="CFO">CFO</label>
         <input type="submit" value="Update">
         
          <a href ="Users.php"> Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>

