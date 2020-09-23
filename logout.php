<?php require_once 'globals.php'; ?>
<?php
if(isset($_POST['logout']))
{
  // destroy session
  end_session();
  
  redirect("index.php");
}
?>