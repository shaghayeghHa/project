<?php



if (!isset($_GET['id'])) {

   header("Location: /test/index.php");

   return;
}



$link = mysqli_connect('localhost:3306', 'root', '');

if (!$link) {
   echo 'could not connect : ' . mysqli_connect_error();

   exit;
}



mysqli_select_db($link, 'test');

$stmt = mysqli_prepare($link, "SELECT * FROM users3 where id = ?");

$id = (int) $_GET['id'];

mysqli_stmt_bind_param($stmt, 'i', $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST'  &&  !is_null($user)) {

   $stmt = mysqli_prepare($link, "UPDATE users3 SET  first_name = ? , last_name = ?  , email = ?  , age = ?  where id = ?");

   mysqli_stmt_bind_param($stmt, 'ssssi', $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['age'], $user['id']);

   mysqli_stmt_execute($stmt);



   if (mysqli_affected_rows($link)) {

      header("Location: /test/index.php");

      return;
   }
}

?>


<html>

<head>

   <title> user information </title>

</head>

<body>

   <h3> user edit </h3><br>

   <form action="edit.php?id=<?= $user['id'] ?>" method="post">

      <label for="">First Name : </label>
      <input type="text" name="fname" value="<?= $user['first_name'] ?>"><br>

      <label for=""> Last Name : </label>
      <input type="text" name="lname" value="<?= $user['last_name'] ?>"><br>

      <label for=""> Age : </label>
      <input type="text" name="age" value="<?= $user['age'] ?>"><br>

      <label for=""> Email : </label>
      <input type="email" name="email" value="<?= $user['email'] ?>"><br>

      <button type="submit"> save edit </button>

   </form>

</body>

</html>