<?php 
// $conn= new mysqli('localhost','root','');
// if(!$conn){
//     echo 'error'.$conn->error;
// } else{
//     echo 'true'.'<br>';
// }

// $sql="CREATE DATABASE TO_DO_2 ";
// $result=$conn->query($sql);
// if(!$result){
//     echo 'database not created';
// } else {
//     echo 'database created successfuly';
// }

$conn=new mysqli('localhost','root','','TO_DO_2');
if(!$conn){
    echo 'error'.$conn->error;
}

// $sql="CREATE TABLE USERS (id INT AUTO_INCREMENT PRIMARY KEY,
// name VARCHAR(220), role VARCHAR(220))";
// $result=$conn->query($sql);
// if(!$result){
//     echo 'TABLE not created';
// } else {
//     echo 'TABLE created successfuly';
// }


// $sql="CREATE TABLE TASKS (id INT AUTO_INCREMENT PRIMARY KEY,
// name VARCHAR(220), description VARCHAR(220))";
// $result=$conn->query($sql);
// if(!$result){
//     echo 'TABLE not created';
// } else {
//     echo 'TABLE created successfuly';
// }

// $sql="CREATE TABLE TASK_USER (id INT AUTO_INCREMENT PRIMARY KEY,
// task_id INT,
// user_id INT,
// FOREIGN KEY (task_id) REFERENCES TASKS(id) ON DELETE CASCADE  ,
// FOREIGN KEY (user_id) REFERENCES USERS(id) ON DELETE CASCADE );" ;

// $result=$conn->query($sql);
// if(!$result){
//     echo 'TABLE not created';
// } else {
//     echo 'TABLE created successfuly';
// }


?>