<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body{
          margin: 50px;
        }
    </style>
</head>
<body>
    <a class="btn btn-primary" href="../user/cu.php">Create user</a>
    <a class="btn btn-primary" href="../index.php"> Tasks</a>
    <?php 
    require '../connect.php';
    $sql="SELECT * FROM USERS";
    $users=$conn->query($sql);
    if($users->num_rows>0){
    ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">role</th>
      <th scope="col">actions</th>

    </tr>
  </thead>
  <tbody>
    <?php 
    while($user= $users->fetch_assoc()){
        ?>
    <tr>
      <td><?php echo $user['id'] ?></td>
      <td><?php echo $user['name'] ?></td>
      <td><?php echo $user['role'] ?></td>
      <td><a class="btn btn-primary" href="../user/ud.php?box=update&id=<?php echo $user['id']?>" name="up">Update</a>
      <a class="btn btn-danger" href="../user/ud.php?box=delete&id=<?php echo $user['id']?>" name="de">Delete</a>
    </td>
    </tr>
    <?php
    }}else{
        echo 'no users yet';
    }
    ?>
  </tbody>
</table>
</body>
</html>