
<html lang="ko">
<head>
    <title>회원 가입</title>
</head>


    <!--<h2>회원 가입</h2>
    <form method="post" action="">
        <label>이름:</label>
        <input type="text" name="name"><br><br>
        <label>아이디:</label>
        <input type="text" name="id"><br><br>
        <label>비밀번호:</label>
        <input type="password" name="password"><br><br>
        <label>비밀번호:</label>
        <input type="password" name="password_confirm"><br><br>
        <label>이메일:</label>
        <input type="text" name="email"><br><br>
        <label>전화번호:</label>
        <input type="text" name="phone"><br><br>
        <input type="submit" name="register" value="회원가입!">
    </form>
</body>
</html> -->





  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style>
    body {
      min-height: 100vh;

      background: -webkit-gradient(linear, left bottom, right top, from(#92b5db), to(#1d466c));
      background: -webkit-linear-gradient(bottom left, #92b5db 0%, #1d466c 100%);
      background: -moz-linear-gradient(bottom left, #92b5db 0%, #1d466c 100%);
      background: -o-linear-gradient(bottom left, #92b5db 0%, #1d466c 100%);
      background: linear-gradient(to top right, #92b5db 0%, #1d466c 100%);
    }

    .input-form {
      max-width: 680px;

      margin-top: 80px;
      padding: 32px;

      background: #fff;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      -webkit-box-shadow: 0 8px 20px 0 rgba(0, 0, 0, 0.15);
      -moz-box-shadow: 0 8px 20px 0 rgba(0, 0, 0, 0.15);
      box-shadow: 0 8px 20px 0 rgba(0, 0, 0, 0.15)
    }
  </style>
</head>

<body>
<form method="post" action="">
  <div class="container">
    <div class="input-form-backgroud row">
      <div class="input-form col-md-12 mx-auto">
        <h4 class="mb-3">회원가입</h4>
        <form class="validation-form" novalidate>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name">이름</label>
              <input type="text" class="form-control" type="text" name = "name" required>
              <div class="invalid-feedback">
                이름을 입력해주세요.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nickname">전화번호</label>
              <input type="text" class="form-control" type="text" name = "phone" required>
              <div class="invalid-feedback">
                전화번호를 입력해주세요.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">이메일</label>
            <input type="email" class="form-control" type="text" name = "email" placeholder="you@example.com" required>
            <div class="invalid-feedback">
              이메일을 입력해주세요.
            </div>
          </div>

          <div class="mb-3">
            <label for="address">아이디</label>
            <input type="text" class="form-control" type = "text" name = "id"  required>
            <div class="invalid-feedback">
              아이디를 입력해주세요.
            </div>
          </div>

          <div class="mb-3">
            <label for="address">비밀번호</label>
            <input type="text" class="form-control" type = "password" name = "password"  required>
            <div class="invalid-feedback">
            비밀번호를 입력해주세요.
            </div>
          </div>

          <div class="mb-3">
            <label for="address2">비밀번호 확인<span class="text-muted"></span></label>
            <input type="text" class="form-control" type = "password" name="password_confirm" placeholder="설정한 비밀번호를 한번 더 입력해주세요.">
          </div>
              
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="aggrement" required>
            <label class="custom-control-label" for="aggrement">개인정보 수집 및 이용에 동의합니다.</label>
          </div>
          <div class="mb-4"></div>
          <button class="btn btn-primary btn-lg btn-block" type="submit" name="register" >가입 완료</button>
        </form>
      </div>
    </div>
    <footer class="my-3 text-center text-small">
      <p class="mb-1">&copy; 20230226-20230410</p>
    </footer>
  </div>
  <script>
    window.addEventListener('load', () => {
      const forms = document.getElementsByClassName('validation-form');

      Array.prototype.filter.call(forms, (form) => {
        form.addEventListener('submit', function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  </script>



  <?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";

    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        
        
        $sql = "SELECT * FROM user_information WHERE ID='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>
            alert('이미 사용중인 아이디 입니다.');
            history.back();</script>";
        } else {
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                alert('이메일을 확인 해주세요.');
                history.back();</script>";
            } else {
                
                if ($password != $password_confirm) {
                    echo "<script>
                    alert('비밀번호가 일치하지 않습니다.');
                    history.back();</script>";
                } else {
                    
                    if (!preg_match('/^[가-힣]+$/', $name)) {
                        echo "<script>
                        alert('이름을 확인해주세요');
                        history.back();</script>";
                    } else {
                        
                        if (!preg_match('/^[0-9]{11}$/', $phone)) {
                            echo "<script>
                            alert('전화번호를 확인 해주세요.');
                            history.back();</script>";
                        } else {
                            # php mysql 문법 insert into 저장할 테이블 이름 (필드 이름...) 밸류(클라이언트 입력 값 담은 변수...)
                            $sql = "INSERT INTO user_information ( name, ID, password, phoneNumber, Email ) VALUES ( '$name', '$id', '$password', '$phone', '$email')";
                            # 데이터 베이스 연결 키, 저장할 테이블 위치와 데이터
                            if (mysqli_query($conn, $sql)) {
                                echo "<script>alert('가입 완료! (확인시 로그인 화면으로)');
                                location.href='login.php';
                                </script>";
                                # header('Location: login.php');
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                        }
                    }
                }
            }
        }
    }

    mysqli_close($conn);
    
    ?>


</body>

</html>






