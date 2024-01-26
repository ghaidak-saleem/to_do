
<?php 
$description= $name="";
$descriptionError= $nameError="";

function data_correcting($word)
{
$word =htmlspecialchars($word);
$word= trim($word);
$word= stripslashes($word);
return $word;
}

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
        require "../connect.php";
        $sql="INSERT INTO TASKS (id,name,description) VALUES (NULL,'$name' ,'$description')";
        $result=$conn->query($sql);
        if($result){
        $users2=$_POST['users'];
        foreach($users2 as $row){
        $sql1="SELECT id FROM TASKS WHERE name='$name'AND description='$description'";
        $task=$conn->query($sql1);
        $r=$task->fetch_assoc();
        $task_id=$r['id'];
        $sql2="INSERT INTO TASK_USER (id,task_id,user_id) VALUES (NULL,'$task_id','$row')";
        $end=$conn->query($sql2);
        }
        echo "user added successfuly";
        header("REFRESH:0, URL=../index.php");
        $conn->close();
    }
       

}
}

?><!DOCTYPE html>
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
<h1>create task: </h1>
<form action="#" method="POST" enctype="multipart/form-data" style="width: 35rem;">
    <div class="form-group">
      <label for="p_t" class="form-label">task name:</label>
      <input type="text" class="form-control" id="p_t" name="name">
      <?php echo $nameError ?>
    </div>
    <div class="form-group">
    <label for="p_image" class="form-label">task description:</label><br>
    <input type="text" class="form-control-file" id="p-image" name="description">
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
    <button type="submit" class="btn btn-primary" name="submit">Create</button>
  </form>

</body>
</html>