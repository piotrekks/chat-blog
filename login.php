<?php

  session_start();
  
  if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
  {
    header('Location: index.html');
    exit();
  }

  require_once "connect.php";

  $connection = @new mysqli($host, $db_user, $db_password, $db_name);
  
  if ($connection->connect_errno!=0)
  {
    echo "Error: ".$connection->connect_errno;
  }
  else
  {
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
  
    if ($result = @$connection->query(
    sprintf("SELECT * FROM users_table_name WHERE user='%s'",
    mysqli_real_escape_string($connection,$login))))
    {
      $how_many_users = $result->num_rows;
      if($how_many_users>0)
      {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['pass']))
        {
          $_SESSION['Logged'] = true;
          $_SESSION['id'] = $row['id'];
          $_SESSION['user'] = $row['user'];
          $_SESSION['email'] = $row['email'];
          
          unset($_SESSION['error']);
          $result->free_result();
          header('Location: chat.php');
        }
        else
        {
          $_SESSION['error'] = '<span style="color:red">Incorrect login or password!</span>';
          header('Location: index.html');
        }
        
      } else {
        
        $_SESSION['error'] = '<span style="color:red">Incorrect login or password!</span>';
        header('Location: index.html');
        
      }
       
    }
    
    $connection->close();
  }
 
  
?>