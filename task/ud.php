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
 $sql1=" SELECT * FROM TASKS WHERE id='$id'";
 $res=$conn->query($sql1);
 $task=$res->fetch_assoc();
 $description=$task['description'];
 $name=$task['name'];
 
$descriptionError= $nameError="";

function data_correcting($word)
{
$word = htmlspecialchars($word);
$word = trim($word);
$word = stripslashes($word);
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
    if(!empty($_POST['description'])){
        $description=data_correcting($_POST['description']);
    }else{
        $descriptionError="required";
    }

    if(!empty($name)&& !empty($description)){
        $sql="UPDATE TASKS SET name='$name' , description='$description' WHERE id='$id' ";
        $result=$conn->query($sql);
        if($result){

            $sql2="DELETE FROM TASK_USER WHERE task_id='$id'";
            $conn->query($sql2);
            $users=$_POST['users'];
            foreach($users as $user){
            $sql3="INSERT INTO TASK_USER (id,task_id,user_id) VALUES (NULL,'$id','$user')";
            $conn->query($sql3);
            }
            echo "task added successfuly";
            header("REFRESH:0, URL=../index.php");

        }else{
            echo "error";
             }
        $conn->close();
    }
       
        
  }
} else if($_GET['box']=='delete'){
    $sql2="DELETE FROM TASKS WHERE id='$id' ";
    $result=$conn->query($sql2);
    if($result){
        echo "task deleted successfuly";
        header("REFRESH:0, URL=../index.php");

    }else{
        echo "error";
    }
    $conn->close();  
}
}
?>
<h1>update task: </h1>
<form action="#" method="POST" enctype="multipart/form-data" style="width: 35rem;">
    <div class="form-group">
      <label for="p_t" class="form-label">task name:</label>
      <input type="text" class="form-control" id="p_t" name="name" value="<?php echo $name ?>">
      <?php echo $nameError ?>
    </div>
    <div class="form-group">
    <label for="p_image" class="form-label">task description:</label><br>
    <input type="text" class="form-control-file" id="p-image" name="description" value="<?php echo $description ?>">
    <?php echo $descriptionError ?>
    </div>
    <div class="form-group">
    <label >users:</label>
    <select name="users[]" multiple class="form-select" aria-label="Default select example"  >
        <?php
        require "../connect.php";
        $sql="SELECT * FROM USERS";
        $users=$conn->query($sql);
        while ($user= $users->fetch_assoc()){?>
        <option value="<?php echo $user['id']?>" ><?php echo $user['name']?></option>
        <?php
        }
        $conn->close();
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">update</button>
  </form>

</body>
</html>