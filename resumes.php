<?php

session_start();
include "./connectDB.php";

$sql = sprintf("SELECT * FROM tbl_resumes 
         WHERE student_id ='%s'", $_SESSION["student_id"]);

$auth_result = $conn->query($sql);
$user_data = $auth_result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="./css/style.css">
   <title>Личный кабинет</title>
</head>
<body>
   <header class="header">
      <nav class="navbar navbar-expand-lg">
         <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
               aria-controls="navbarContent" aria-expanded="false">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a href="#" class="nav-link">О сибади</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Абитуриенту</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Студенту</a>
                  </li>
                  <a href="./index.php" class="navbar-brand"><img src="./img/header/logo.gif" alt="logo"></a>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Институты</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Наука</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Обучение</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
   </header>
   <?php  if (isset($_SESSION["student_id"])):   ?>
      <p> Здравствуйте, <?= $_SESSION["stud_username"] ?></p> 
      <p><a href="./logout.php">Выйти из аккаутна </a></p>
      <?php  if (isset($user_data["resume_id"])):                             ?>
   <section class="resume-list-wrap">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="title">
                  <h1>Ваше резюме</h1>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col">
               <div class="in-code">
                  <div class="card" type="hidden">
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="resume-title">
                              <h5 class="card-title">Резюме <?= $user_data["first_name"]?></h5>
                              <p class="card-text">Заполнено</p>
                           </div>
                           <div class="resume-icon">
                              <a href="./edit.php"><img src="./img/personalArea/edit.png" alt="edit"></a> 
                              <a href="./generate_pdf.php"><img src="./img/personalArea/download.png" alt="download"></a>
                              <a href="./delete-res.php" type="button" data-del="delete"><img src="./img/personalArea/delete.png" alt="delete"></a> 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
            <?php else:  ?>
               <a href="./createNewResume.php" class="btn btn-primary" type="button" >Добавить резюме</a>
            <?php endif ?>


      <?php else: ?>
         <p>Непонятно, как вы сюда попали, но вам нужно <a href="./signup.html">зарегистрироваться</a>.</p>
      <?php endif; ?>



   <footer class="footer">
      <div class="container">
         <div class="row">
            <div class="col-md-6 text-center">
               <div class="footer-title">
                  <h2>&copy 2020 ФГБОУ ВО «СибАДИ»</h2>
               </div>
               <div class="footer-sub">
                  <p>644080, г. Омск, пр. Мира 5</p>
                  <p>Обязательные сведения</p>
                  <p>8 (3812) 90-94-59</p>
                  <p>Email: info@sibadi.org</p>
               </div>
            </div>
            <div class="col-md-6 text-center">
               <div class="footer-title">
                  <h2>Контакты и обращения</h2>
               </div>
               <div class="footer-sub">
                  <p>Приемная коммиссия:</p>
                  <p>Обязательные сведения</p>
                  <p>Email: priem_kom@sibadi.org</p>
                  <p>8 (3812) 65-98-81</p>
               </div>
            </div>
         </div>
      </div>
   </footer>

   <script src="./js/script.js"></script>
   <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>