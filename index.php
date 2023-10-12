<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

   include "./connectDB.php";

   $sql = sprintf("SELECT * FROM usr_table
            WHERE stud_email = '%s'", 
            $conn->real_escape_string($_POST["stud_email"]));
   $auth_result = $conn->query($sql);
   
   $user = $auth_result->fetch_assoc();

   if ($user) {
      if (password_verify($_POST["stud_password"], $user["stud_password"])) {

         session_start();

         session_regenerate_id();

         $_SESSION["student_id"] = $user["student_id"];
         $_SESSION["stud_username"] = $user["stud_username"];
         header("Location: resumes.php");
         exit;

      }
   }
   $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="./css/style.css">
   <title>СибАДИ - резюме</title>
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

   <section class="auth">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center">
               <h1>Резюме студентов СибАДИ</h1>
            </div>
         </div>
         
         <div class="row">
            <div class="col-md-12 d-flex justify-content-center text-center">
               <form class="auth-form" method="post">
                  <h2>Вход в систему:</h2>
                  <?php  if ($is_invalid):       ?>
                     <em>Неправильная почта или пароль</em>
                  <?php endif;                         ?>
                  <div class="mb-3">
                    <label for="stud_email" class="form-label">Ваша почта</label>
                    <input type="email" class="form-control" name="stud_email" id="stud_email" 
                                          value="<?=htmlspecialchars($_POST["stud_email"] ?? "")?>">
                  </div>
                  <div class="mb-5">
                    <label for="stud_password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="stud_password" id="stud_password">
                  </div>
                  <button class="btn btn-primary">Войти</button>
                  <a href="./signup.html" class="d-flex justify-content-center">Регистрация</a>
                </form>
            </div>
         </div>
      </div>
   </section>

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

   <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>