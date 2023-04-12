<?php
ini_set("display_errors", 1); 

include $_SERVER['DOCUMENT_ROOT']."/db.php";


# 로그인 확인
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit();
}



# 로그인 유저 세션
$user_id = $_SESSION['user_primary_key'];

# 닉네임 생성
if(isset($_POST["create_nickname"])){
    $nickname = $_POST["nickname"];


    # 닉네임 유무 체크, 없으면 추가
    $DBcheck_nickname = "SELECT * FROM community_userinformation WHERE userPrimary='$user_id'"; # 닉네임 유뮤 체크용
    $check_nickname = mysqli_query($conn, $DBcheck_nickname);

    if (mysqli_num_rows($check_nickname) == 0 ) {
        $insert_nickname = "INSERT INTO `community_userinformation` ( `userPrimary` ) VALUES ( '$user_id' )";
        mysqli_query($conn, $insert_nickname);
    }

    $update_nickname = "UPDATE `community_userinformation` SET `nickname` = '$nickname' WHERE `userPrimary` = '$user_id'"; # 닉네임 추가용
    if (mysqli_query($conn, $update_nickname)){
        echo "<script>alert('닉네임 만들기 완료!');
        location.href='mypage.php';
        </script>";
        # header('Location:mypage.php');
    }
    else{
        echo "실패! : ".mysqli_error($conn);
    }

    exit();
}

mysqli_close($conn);

?>



<html>
    <head>
        <title>닉네임 생성</title>
    </head>

    <body>
        <h1>닉네임 만들기</h1>
        <form method = "post" action = "">
            <p>사용할 닉네임을 입력해주세요 : <input type = "text" name = "nickname"></p>
            <input type = "submit" name = "create_nickname" value = "만들기!">
        </form>
    </body>
</html>
