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


# 삭제 요청 유저
$user_id = $_SESSION['user_primary_key'];
#echo " / 유저 식별 번호 : " . $user_id;


# check box 로 넘겨 받은 댓글 삭제
if(isset($_POST["choice_comment"])){
    $comment = $_POST["choice_comment"];
    #echo $comment;
    $comment_D = json_encode($comment);
    #echo $comment_D;
    $sql_delect = "DELETE FROM `postcomments` WHERE `commentPrimary` = $comment_D" ;
    mysqli_query($conn, $sql_delect);
    echo "<script>alert('삭제 완료.');
    history.back();
    </script>";
}
 

else{
    echo "<script>alert('한개 이상의 항목을 선택해야 합니다.');
    location.href='comment_delect.php';
    </script>" ;}

    
# 삭제
#$sql_delect = "DELETE FROM `postcomments` WHERE `commentPrimary` = $comment_D " ;
#mysqli_query($conn, $sql_delect);
#echo "<script>alert('삭제 완료.');
#history.back();
#</script>";
?>
