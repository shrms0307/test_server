
<?php
    
    session_start();
    if (isset($POST['login'])) { // 로그인 양식 제출 확인
        $username = $_POST['ID'];
        $password = $_POST['password'];
        // 유효성 검사
        $sql = "SELECT * FROM user_information WHERE `ID`='$username' AND `Password`='$password'";
        $result = mysqli_query($conn, $sql);
        echo mysqli_error($conn);
        if (mysqli_num_rows($result) == 1) {
            // 로그인 성공 시 메인 화면으로
            $_SESSION['name'] = $username;
            header('Location: home.php');
        } else {
            // 로그인 실패 출력 메시지
            echo "아이디 또는 비밀번호를 확인해주세요";
        }
    }
    ?>