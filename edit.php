<?php
session_start();

require __DIR__ . "/connectDB.php";

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
   <title>Редактор резюме</title>
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

   <section class="resume-form">
      <form action="./edit-res-in-db.php" method="post">
         <div class="container">
            <div class="row">
               <div class="col-md">
                  <div class="card">
                     <h5 class="card-header">Основная информация</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-around">
                           <div class="profile-input">
                              <input type="hidden" value="<?=$_SESSION['student_id'];?>" id="student_id" name="student_id">
                              <label for="firstname" class="form-label">Имя</label>

                              <input type="text" placeholder="Введите имя" class="form-control" value="<?=$user_data['first_name']?>" name="firstname" id="firstname">

                              <label for="surname" class="form-label">Фамилия</label>

                              <input type="text" placeholder="Введите фамилию" class="form-control" value="<?=$user_data['surname']?>" name="surname" id="surname">

                              <label for="patronymic" class="form-label">Отчество</label>

                              <input type="text" placeholder="Введите отчество" class="form-control" value="<?=$user_data['patronymic']?>" name="patronymic" id="patronymic">
                           </div>
                           <div class="profile-input">
                              <label for="date_birth" class="form-label">Дата рождения</label>
                              <input type="date" class="form-control" value="<?=$user_data['date_birth']?>" name="date_birth" id="date_birth">
                              <label for="current_city" class="form-label">Город проживания</label>
                              <input type="text" placeholder="Введите город" class="form-control" value="<?=$user_data['current_city']?>" name="current_city" id="current_city">
                              <label for="citizenship" class="form-label">Гражданство</label>
                              <input type="text" placeholder="Введите гражданство" class="form-control" value="<?=$user_data['citizenship']?>" name="citizenship" id="citizenship">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Контакты</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-around">
                           <div class="profile-input">
                              <label for="email" class="form-label">Электронная почта</label>
                              <input type="email" placeholder="zakharoff@mail.ru" value="<?=$user_data['email']?>" class="form-control" name="email" id="email">
                           </div>
                           <div class="profile-input">
                              <label for="phone" class="form-label">Телефон</label>
                              <input type="text" placeholder="+7 (999)-999-99-99" class="form-control" value="<?=$user_data['phone']?>" name="phone" id="phone">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Опыт работы</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center line">
                           <div class="resume-title">
                              <h5 class="d-flex align-items-center"></h5>
                           </div>
                           <div class="resume-icon d-flex align-items-center">
                              <img src="./img/resume-list-wrap/line.png" alt="line">
                              <img src="./img/resume-list-wrap/delete.png" alt="delete">
                           </div>
                        </div>
                        <div class="d-flex justify-content-around line">
                           <div class="profile-input">
                              <label for="beginning_work" class="form-label">Начало работы</label>
                              <input type="date" class="form-control" value="<?=$user_data['beginning_work']?>" name="beginning_work" id="beginning_work">
                              <label for="job_title" class="form-label">Должность</label>
                              <select class="form-select" aria-label="Default select example" name="job_title" id="job_title">
                                 <option value="<?=$user_data['job_title']?>" selected>Выберите должность</option>
                                 <option value="Системный администратор">Системный администратор</option>
                                 <option value="Разработчик">Разработчик</option>
                                 <option value="Системный аналитик">Системный аналитик</option>
                                 <option value="Тестировщик">Тестировщик</option>
                                 <option value="Специалист по информационной безопасности">Специалист по информационной безопасности</option>
                              </select>
                              <label for="exampleFormControlTextarea1" class="form-label">Обязанности</label>
                              <textarea class="form-control" value="<?=$user_data['responsibilities']?>" name="responsibilities" id="responsibilities" rows="3"></textarea>
                           </div>
                           <div class="profile-input">
                              <label for="end_work" class="form-label">Окончание работы</label>
                              <input type="date" class="form-control" value="<?=$user_data['end_work']?>" name="end_work" id="end_work">
                              <label for="company" class="form-label">Введите название компании</label>
                              <input type="text" placeholder="Название компании" class="form-control" value="<?=$user_data['company']?>" name="company" id="company">
                           </div> 
                        </div>
                        
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Основное образование</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center line">
                           <div class="resume-title">
                              <h5 class="d-flex align-items-center"></h5>
                           </div>
                           <div class="resume-icon d-flex align-items-center">
                              <img src="./img/resume-list-wrap/line.png" alt="line">
                              <img src="./img/resume-list-wrap/delete.png" alt="delete">
                           </div>
                        </div>
                        <div class="d-flex justify-content-around line">
                           <div class="profile-input">
                              <label for="name_institution" class="form-label">Название учебного заведения</label>
                              <input type="text" placeholder="Название" class="form-control" value="<?=$user_data['name_institution']?>" name="name_institution" id="name_institution">
                              <label for="faculty" class="form-label">Факультет</label>
                              <input type="text" placeholder="Факультет" class="form-control" value="<?=$user_data['faculty']?>" name="faculty" id="faculty">
                              <label for="year_graduation" class="form-label">Год окончания</label>
                              <input type="date" class="form-control" value="<?=$user_data['year_graduation']?>" name="year_graduation" id="year_graduation">
                           </div>
                           <div class="profile-input">
                              <label for="level_education" class="form-label">Уровень образования</label>
                              <select class="form-select" aria-label="Default select example" value="<?=$user_data['level_education']?>" name="level_education" id="level_education">
                                 <option selected>Выберите уровень</option>
                                 <option value="Основное общее образование">Основное общее образование</option>
                                 <option value="Среднее общее образование">Среднее общее образование</option>
                                 <option value="Высшее образование">Высшее образование</option>
                              </select>
                              <label for="speciality" class="form-label">Специальность</label>
                              <input type="text" placeholder="Специальность" class="form-control" value="<?=$user_data['speciality']?>" name="speciality" id="speciality">
                           </div>
                        </div>
                        
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Курсы повышения квалификации</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center line">
                           <div class="resume-title">
                              <h5 class="d-flex align-items-center"></h5>
                           </div>
                           <div class="resume-icon d-flex align-items-center">
                              <img src="./img/resume-list-wrap/line.png" alt="line">
                              <img src="./img/resume-list-wrap/delete.png" alt="delete">
                           </div>
                        </div>
                        <div class="d-flex justify-content-around line">
                           <div class="profile-input">
                              <label for="course_name" class="form-label">Название курса</label>
                              <input type="text" placeholder="Название курса" class="form-control" value="<?=$user_data['course_name']?>" name="course_name" id="course_name">
                              <label for="course_end_year" class="form-label">Год окончания</label>
                              <input type="date" class="form-control" name="course_end_year" id="course_end_year">
                           </div>
                           <div class="profile-input">
                              <label for="host_organization" class="form-label">Проводившая организация</label>
                              <input type="text" placeholder="Организация" class="form-control" value="<?=$user_data['host_organization']?>" name="host_organization" id="host_organization">
                           </div>
                        </div>
                        
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Владение языками</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center line">
                           <div class="resume-title">
                              <h5 class="d-flex align-items-center"></h5>
                           </div>
                           <div class="resume-icon d-flex align-items-center">
                              <img src="./img/resume-list-wrap/line.png" alt="line">
                              <img src="./img/resume-list-wrap/delete.png" alt="delete">
                           </div>
                        </div>
                        <div class="d-flex justify-content-around line">
                           <div class="profile-input">
                              <label for="choose_language" class="form-label">Выберите язык</label>
                              <select class="form-select" aria-label="Default select example" name="choose_language" id="choose_language">
                                 <option value="<?=$user_data['choose_language']?>" selected>Выберите язык</option>
                                 <option value="Английский">Английский</option>
                                 <option value="Немецкий">Немецкий</option>
                                 <option value="Французский">Французский</option>
                              </select>
                           </div>
                           <div class="profile-input">
                              <label for="exampleInput" class="form-label">Уровень владения</label>
                              <select class="form-select" aria-label="Default select example" name="proficiency_level" id="proficiency_level">
                                 <option value="<?=$user_data['proficiency_level']?>" selected>Выберите уровень</option>
                                 <option value="A1">(A1) - начальный</option>
                                 <option value="A2">(A2) - ниже среднего</option>
                                 <option value="B1">(B1) - средний</option>
                                 <option value="B2">(B2) - выше среднего</option>
                                 <option value="C1">(C1) - продвинутый</option>
                                 <option value="C2">(C2) - профессиональный уровень владения</option>
                              </select>
                           </div>
                        </div>
                        
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Профессиональные навыки</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center line">
                           <div class="resume-title">
                              <h5 class="d-flex align-items-center"></h5>
                           </div>
                           <div class="resume-icon d-flex align-items-center">
                              <img src="./img/resume-list-wrap/line.png" alt="line">
                              <img src="./img/resume-list-wrap/delete.png" alt="delete">
                           </div>
                        </div>
                        <div class="profile-input line">
                           <label for="skill_description" class="form-label ms-2">Описание навыка</label>
                           <input type="text" placeholder="Навык" class="form-control ms-2" value="<?=$user_data['skill_description']?>" name="skill_description" id="skill_description">
                        </div>
                        
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Личные качества</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center line">
                           <div class="resume-title">
                              <h5 class="d-flex align-items-center"></h5>
                           </div>
                           <div class="resume-icon d-flex align-items-center">
                              <img src="./img/resume-list-wrap/line.png" alt="line">
                              <img src="./img/resume-list-wrap/delete.png" alt="delete">
                           </div>
                        </div>
                        <div class="line">
                           <label for="quality" class="form-label ms-2">Качество</label>
                           <input type="text" placeholder="Качество" class="form-control ms-2" value="<?=$user_data['quality']?>" name="quality" id="quality">
                        </div> 
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Активности</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center line">
                           <div class="resume-title">
                              <h5 class="d-flex align-items-center"></h5>
                           </div>
                           <div class="resume-icon d-flex align-items-center">
                              <img src="./img/resume-list-wrap/line.png" alt="line">
                              <img src="./img/resume-list-wrap/delete.png" alt="delete">
                           </div>
                        </div>
                        <div class="d-flex justify-content-around line">
                           <div class="profile-input">
                              <label for="activity_name" class="form-label">Название</label>
                              <input type="text" placeholder="Название" class="form-control" value="<?=$user_data['activity_name']?>" name="activity_name" id="activity_name">
                              <label for="activity_course" class="form-label">Курс</label>
                              <select class="form-select" aria-label="Default select example" name="activity_course" id="activity_course">
                                 <option value="<?=$user_data['activity_course']?>" selected>Курс</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                              </select>
                              <label for="activity_description" class="form-label">Описание</label>
                              <textarea class="form-control" name="activity_description" value="<?=$user_data['activity_description']?>" id="activity_description" rows="3"></textarea>
                           </div>
                           <div class="profile-input">
                              <label for="year_activity" class="form-label">Год</label>
                              <select class="form-select" aria-label="Default select example" name="year_activity" id="year_activity">
                                 <option value="<?=$user_data['year_activity']?>" selected>Год</option>
                                 <option value="2018">2018</option>
                                 <option value="2019">2019</option>
                               <option value="2020">2020</option>
                                 <option value="2021">2021</option>
                                 <option value="2022">2022</option>
                              </select>
                           </div>
                        </div>
                        
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Публикации</h5>
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center line">
                           <div class="resume-title">
                              <h5 class="d-flex align-items-center"></h5>
                           </div>
                           <div class="resume-icon d-flex align-items-center">
                              <img src="./img/resume-list-wrap/line.png" alt="line">
                              <img src="./img/resume-list-wrap/delete.png" alt="delete">
                           </div>
                        </div>
                        <div class="d-flex justify-content-around line">
                           <div class="profile-input">
                              <label for="publication_title" class="form-label">Название или ссылка</label>
                              <input type="text" placeholder="Название" class="form-control" value="<?=$user_data['publication_title']?>" name="publication_title" id="publication_title">
                              <label for="exampleInput" class="form-label">Год</label>
                              <select class="form-select" aria-label="Default select example" id="publication_year" name="publication_year">
                                 <option value="<?=$user_data['publication_year']?>" selected>Год</option>
                                 <option value="2018">2018</option>
                                 <option value="2019">2019</option>
                                 <option value="2020">2020</option>
                                 <option value="2021">2021</option>
                              </select>
                           </div>
                           <div class="profile-input">
                              <label for="exampleInput" class="form-label">Месяц</label>
                              <select class="form-select" aria-label="Default select example" name="publication_month" id="publication_month">
                                 <option value="<?=$user_data['publication_month']?>" selected>Месяц</option>
                                 <option value="Январь">Январь</option>
                                 <option value="Февраль">Февраль</option>
                                 <option value="Март">Март</option>
                                 <option value="Апрель">Апрель</option>
                                 <option value="Май">Май</option>
                                 <option value="Июнь">Июнь</option>
                                 <option value="Июль">Июль</option>
                                 <option value="Август">Август</option>
                                 <option value="Сентябрь">Сентябрь</option>
                                 <option value="Октябрь">Октябрь</option>
                                 <option value="Ноябрь">Ноябрь</option>
                                 <option value="Декабрь">Декабрь</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">О себе</h5>
                     <div class="card-body">
                        <textarea class="form-control" value="<?=$user_data['about_myself']?>" name="about_myself" id="about_myself" rows="3"></textarea>
                     </div>
                  </div>
                  <div class="d-flex justify-content-center">
                     <button class="btn btn-primary" data-bs-toggle="modal">Сохранить</button>
                     <a href="./resumes.html" class="btn btn-primary" type="button">Отмена</a>
                  </div>
               </div>
            </div>
         </div>
      </form>
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