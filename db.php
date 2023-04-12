<?php
# 서버 연결 
$servername = "localhost"; # 주소
$username = "root"; # 사용자 명
$password = ""; # 비밀번호 설정 안 함
$dbname = "community"; # 데이터 베이스 이름
# 데이터 베이스 연결 키
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("db 불러오기 실패: " . mysqli_connect_error());
}

?>