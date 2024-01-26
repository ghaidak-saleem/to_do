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
<?php 
 require "../connect.php";
 $id=intval($_GET['id']);
 $sql1=" SELECT * FROM USERS WHERE id='$id'";
 $res=$conn->query($sql1);
 $user=$res->fetch_assoc();
 $role=$user['role'];
 $name=$user['name'];
 
$roleError= $nameError="";

function data_correcting($word)
{
$word =htmlspecialchars($word);
$word= trim($word);
$word= stripslashes($word);
return $word;
}
if(isset($_GET['box'])){
    if($_GET['box']=='update'){

if (isset($_POST['submit'])){
    if(!empty($_POST['name'])){
        $name=data_correcting($_POST['name']);
    }else{
        $nameError="required";
    }
    if(!empty($_POST['role'])){
        $role=data_correcting($_POST['role']);
    }else{
        $roleError="required";
    }

    if(!empty($name)&& !empty($role)){
        $sql="UPDATE USERS SET name='$name' , role='$role' WHERE id='$id' ";
        $result=$conn->query($sql);
        if($result){
            echo "user added successfuly";
            header("REFRESH:0, URL=index.php");

        }else{
            echo "error";
        }
        $conn->close();
        }
       
        
  }
} else if($_GET['box']=='delete'){
    $sql2="DELETE FROM USERS WHERE id='$id' ";
    $result=$conn->query($sql2);
    if($result){
        echo "user deleted successfuly";
        header("REFRESH:0, URL=index.php");

    }else{
        echo "error";
    }
    $conn->close();  
}
}
?>
<h1>update user: </h1>
<form action="#" method="POST" enctype="multipart/form-data" style="width: 35rem;">
    <div class="form-group">
      <label for="p_t" class="form-label">user name:</label>
      <input type="text" class="form-control" id="p_t" name="name" value="<?php echo $name ?>">
      <?php echo $nameError ?>
    </div>
    <div class="form-group">
    <label for="p_image" class="form-label">user role:</label><br>
    <input type="text" class="form-control-file" id="p-image" name="role" value="<?php echo $role ?>">
    <?php echo $roleError ?>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">update</button>
  </form>

</body>
</html>