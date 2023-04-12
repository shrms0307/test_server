<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";



	# 로그인 확인
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
        exit();
    }

	if (isset($_POST['submit'])) {
        # 로그인 유저
        $userlog = $_SESSION['user_primary_key'];
		$id = $_SESSION["filePrimary"];
        echo $userlog;

        # 입력한 댓글 가져오기
        $commentContent = $_POST['comment'];
        $sql2 = "INSERT INTO `postcomments` (`filePrimary`, `comment_user`, `commentContent`) VALUES ('$id', '$userlog', '$commentContent')";
        $countcomment = "UPDATE `filepost` SET `comments` = `comments` + 1 WHERE `filePrimary` = $id";
        mysqli_query($conn, $countcomment );
        # db 넣기
        if (mysqli_query($conn, $sql2)) {
            echo "<script>alert('댓글 업로드 성공!');
            history.back();
            </script>";
        } else {
            echo "업로드 실패: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);