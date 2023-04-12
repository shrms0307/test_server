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


# 로그인 유저 
$user_id = $_SESSION['user_primary_key'];
# echo " / 유저 식별 번호 : " . $user_id;


# 게시물 삭제 권한 확인
$sql_post = "SELECT `post_userPrimary` FROM `filepost` WHERE `filePrimary`='$filePrimary'";
$check_ = mysqli_query($conn, $sql_post);
echo mysqli_error($conn);
while ($row = mysqli_fetch_array($check_)) {
    $check_postcreater = $row[ 'post_userPrimary' ];
    # 해당 파일의 주인이 현재 삭제 요청한 클라이언트와 일치하는지 확인
    if ($user_id == $check_postcreater){
        # 일치 -> 게시물 삭제
        # $sql_delect = "DELETE FROM `filepost` WHERE `filePrimary` = $filePrimary";
        # mysqli_query($conn, $sql_delect);
        echo "<script>
        alert('정말로 삭제하시겠습니까?');
        location.href='real_delect(post).php';</script>";

        # header('Location: post_details.php');
    }

    else {echo "<script>
        alert('게시물 삭제는 작성자 이외에 삭제할 수 없습니다.');
        history.back();</script>";
    }

}
?>