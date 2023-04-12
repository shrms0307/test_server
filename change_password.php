<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";

# 로그인 확인
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit();
}


# 로그인 유저 세션 
$user_id = $_SESSION['user_primary_key'];

# html 값 받아오기
if (isset($_POST['change'])) {
    $Existing_password = $_POST['checkpassword'];
    $changepassword_1 = $_POST['changepassword_1'];
    $changepassword_2 = $_POST['changepassword_2'];
    ### 기존 비밀번호 확인
    
    # db 가져오기
    $sql_check = "SELECT `password` FROM `user_information` WHERE `userPrimary`='$user_id'";
    $result = mysqli_query($conn, $sql_check);
    echo mysqli_error($conn);

    while ($row = mysqli_fetch_array($result)) {
        $checkpassword = $row[ 'password' ];
        if ($Existing_password == $checkpassword){

            if ($changepassword_1 == $changepassword_2){
                $change = "UPDATE `user_information` SET `password` = '$changepassword_1' WHERE `userPrimary` = '$user_id'";
                mysqli_query($conn, $change);
                #echo "<h1>변경 완료</h1>";
                echo "<script>alert('변경 완료.');
                location.href='mypage.php';
                </script>";
                #header('Location: mypage.php');
            }

            else echo "<p>새 비밀번호가 서로 일치하지 않습니다.</p>";
        }
    

        else echo "<p>현재 비밀번호가 틀렸습니다.</p>";
            
    }
    
}




?>



<html>
    <head>
        <title>비밀번호 변경</title>
    </head>
<body>
    <h1> 비밀번호 변경 </h1>
    <form method = "post" action = "">
        <label>기존 비밀번호 : <input type = "text" name = "checkpassword"></label>
        <div></div>
        변경 비밀번호 : <input type="text" name="changepassword_1"><br>
        변경 비밀번호 확인 : <input type="text" name="changepassword_2"><br></br>
        <input type="submit" name="change" value="변경하기">
    </form>
</html>

    