<?php
session_start();

# 로그인 확인 시 진행
if(!isset($_SESSION['login'])) {
    header('Location: login.php');# 로그인 안 된 유저 로그인 페이지로 강제 이동
    exit();
}

# 서버 연결 
include $_SERVER['DOCUMENT_ROOT']."/db.php";


# 삭제할 해당 파일 받아오기
$filePrimary = $_SESSION["filePrimary"];
#echo "파일 식별 번호 : " . $filePrimary;

# 삭제
$sql_delect = "DELETE FROM `filepost` WHERE `filePrimary` = $filePrimary";
mysqli_query($conn, $sql_delect);
echo "<script>alert('삭제 완료.');
    location.href='post_details.php';
    </script>";

?>