<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr = $phoneErr = "";
$name = $phone = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "لطفا نام خود را وارد کنید.";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Zالف-ی ]*$/", $name)) {
      $nameErr = "نام وارد شده نادرست است.";
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "لطفا شماره تماس خود را وارد کنید.";
  } else {
    $phone = test_input($_POST["phone"]);
    // check if e-mail address is well-formed
    if (!filter_var($phone, FILTER_VALIDATE_phone)) {
      $phoneErr = "شماره تلفن وارد شده نادرست است.";
    }
  }

  if (empty($_POST["message"])) {
    $message = "";
  } else {
    $message = test_input($_POST["message"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="phone" value="<?php echo $phone;?>">
  <span class="error">* <?php echo $phoneErr;?></span>
  <br><br>
  message: <textarea name="message" rows="5" cols="40"><?php echo $message;?></textarea>
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $phone;
echo "<br>";
echo $message;
?>

</body>
</html>
