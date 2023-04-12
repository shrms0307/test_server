<!DOCTYPE html> 

<html lang="en">
  <head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- 나의 스타일 추가 -->
    <link rel="stylesheet" href="login.css?v=1234">

  </head>
  <body class="text-center">
    
    <!--  html 전체 영역을 지정하는 container -->
    <div id="container">
      <!--  login 폼 영역을 : loginBox -->
      <div id="loginBox">
      
        <!-- 로그인 페이지 타이틀 -->
        <div id="loginBoxTitle">DATAHONEY</div>
        <!-- 아이디, 비번, 버튼 박스 -->
        <div id="inputBox">

    <!--<h2><img class="fit-picture" src= "./img.jpg"  ></h2>-->
    <form method="post" action="./logincheck.php" name = "login">
        <div class="input-form-box"><span>아이디 </span><input type="text" name="ID" class="form-control"></div>
        <div class="input-form-box"><span>비밀번호</span><input type="password" name="password" class="form-control"></div>
        <input type="submit" name="login" value="로그인" class="btn btn-primary btn-xs" style="width:100%">
    </form>
    <br>
    <td>비회원 이신가요?</td>
    <a href="signup.php">회원가입</a>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>


