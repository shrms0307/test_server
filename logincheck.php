<?php
# 서버 연결
include $_SERVER['DOCUMENT_ROOT']."/db.php";

session_start();

if (isset($_POST['login'])) { // 로그인 양식 제출 확인
    $ID = $_POST['ID'];
    $password = $_POST['password'];
    // 유효성 검사
    $sql = "SELECT * FROM user_information WHERE `ID`='$ID' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_error($conn);


    // 로그인 성공 시 메인 화면으로
    if (mysqli_num_rows($result) == 1) {
    

        $sql1 = "SELECT userPrimary FROM user_information WHERE ID='$ID'";
        $result1 = mysqli_query($conn, $sql1);

        # 해당 유저의 primary 키 검색
        if (mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $user_primary_key = $row["userPrimary"];
            // 유저 primary 키 세션에 저장 -> 넘겨주기
            $_SESSION['user_primary_key'] = $user_primary_key;
        }

        $_SESSION['login'] = $username;
        header('Location: home.php');}


    // 로그인 실패 출력 메시지
    else {    
        echo "<script>
        alert('아이디 또는 패스워드가 잘못되었습니다.');
        history.back();</script>";
        }}

?>