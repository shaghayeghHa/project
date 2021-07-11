 <?php


    function request($field)
    {
        return isset($_REQUEST[$field]) && $_REQUEST[$field] != "" ? trim($_REQUEST[$field]) : null;
    }

    $link = mysqli_connect('localhost:3306', 'root', '');

    if (!$link) {
        echo 'could not connect : ' . mysqli_connect_error();
        exit;
    }

    mysqli_select_db($link, 'test');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = request('email');
        $first_name = request('fname');
        $last_name = request('lname');
        $age = request('age');

        $SQL = "insert into users3 ( email , first_name , last_name , age ) values ('{$email}' ,'{$first_name}' , '{$last_name}' , '{$age}')";

        if ($result = mysqli_query($link, $SQL)) {

        } else {
            echo 'error : ' . mysqli_error($link);
            exit;
        }
    }


    $SQL = "SELECT * FROM  users3";

    if ($result = mysqli_query($link, $SQL)) {

    } else {
        echo 'error : ' . mysqli_error($link);
        exit;
    }


    ?>


 <html>

 <head>

     <title> user information </title>

 </head>

 <body>

     <h3> user information </h3>
     <br>

     <form action="index.php" method="post">

         <label>First Name : </label>
         <input type="text" name="fname"><br>

         <label> Last Name : </label>
         <input type="text" name="lname" /><br>

         <label> Age : </label>
         <input type="text" name="age" /><br>

         <label> Email : </label>
         <input type="email" name="email" /><br><br>

         <button type="submit">save</button>


     </form>

 </body>

 </html>

 <html>

 <head>

     <title> user list </title>

     <style>
         table {
             font-family: arial, sans-serif;
             border-collapse: collapse;
             width: 100%;
         }

         td,
         th {
             border: 2px solid black;
             text-align: left;
             padding: 8px;
             text-align: center;
         }

         th {
             background-color: rgb(0 164 164);
         }

         tr:nth-child(even) {
             background-color: rgb(0 230 230);
         }

         tr:nth-child(odd) {
             background-color: rgb(157 255 255);
         }

         a {
             color: black;
         }

         a:hover {
             color: blue;
         }

         input {
             border: 1.5px rgb(0 128 198) solid;
         }

         button {
             background-color: rgb(60 60 255);
             color: white;
             font-size: 15px
         }

         label {
             color: rgb(0 0 130);
             font-size: 20px
         }
     </style>


 </head>

 <body>

     <h2> user list </h2>

     <table>

         <thead>

             <tr>

                 <th> id </th>
                 <th> First Name </th>
                 <th> Last Name </th>
                 <th> Email</th>
                 <th> Age </th>
                 <th> Actions</th>

             </tr>

         </thead>

         <tbody>

             <?php while ($user = mysqli_fetch_assoc($result)) { ?>

                 <tr>

                     <td><?= $user['id'] ?></td>
                     <td><?= $user['first_name'] ?></td>
                     <td><?= $user['last_name'] ?></td>
                     <td><?= $user['email'] ?></td>
                     <td><?= $user['age'] ?></td>
                     <td>
                         <a href="/test/edit.php?id=<?= $user['id'] ?>">Edit</a>
                         <a href="/test/delete.php?id=<?= $user['id'] ?>">Delete</a>

                     </td>

                 </tr>

             <?php } ?>

         </tbody>

     </table>

 </body>

 </html>