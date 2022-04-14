<?php
// define variables and set to empty values
$titleErr = $seoErr = $genderErr = $categotyErr = "";
$title = $_POST['title'];
$seo = $_POST['seo'];
$content = $_POST['content'];
$categoty = $_POST['category'];

$db = mysqli_connect("localhost", "admin", "2075", "firstwebsite");
$query = "";
mysqli_execute($db, $query);


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  if (empty($_POST["title"])) {
    $titleErr = "title is required";
  } else {
    $title = test_input($_POST["title"]);
    // check if title only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$title)) {
      $titleErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["seo"])) {
    $seoErr = "seo is required";
  } else {
    $seo = test_input($_POST["seo"]);
    // check if e-mail address is well-formed
    if (!filter_var($seo, FILTER_VALIDATE_seo)) {
      $seoErr = "Invalid seo format";
    }
  }
    
  if (empty($_POST["categoty"])) {
    $categoty = "";
  } else {
    $categoty = test_input($_POST["categoty"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$categoty)) {
      $categotyErr = "Invalid URL";
    }
  }

  if (empty($_POST["content"])) {
    $content = "";
  } else {
    $content = test_input($_POST["content"]);
  }

  // if (empty($_POST["gender"])) {
  //   $genderErr = "Gender is required";
  // } else {
  //   $gender = test_input($_POST["gender"]);
  // }
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
  Title: <input type="text" name="title" value="<?php echo $title;?>">
  <span class="error">* <?php echo $titleErr;?></span>
  <br><br>
  Seo: <input type="text" name="seo" value="<?php echo $seo;?>">
  <span class="error">* <?php echo $seoErr;?></span>
  <br><br>
  Category: <input type="text" name="category" value="<?php echo $categoty;?>">
  <span class="error"><?php echo $categotyErr;?></span>
  <br><br>
  Content: <textarea name="content" rows="5" cols="40"><?php echo $content;?></textarea>
  <br><br>
  <!-- Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br> -->
  <input type="submit" name="submit" value="Submit">  
</form>
<?php
echo "<h2>Your Input:</h2>";
echo $title;
echo "<br>";
echo $seo;
echo "<br>";
echo $categoty;
echo "<br>";
echo $content;
// echo "<br>";
// echo $gender;
?>

</body>
</html>