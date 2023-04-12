<html>
<head>
    <title>댓글 삭제하기</title>
</head>
<body>
<h2>삭제할 댓글을 체크 해주세요</h2>
<p>(아래 표시된 댓글들은 본인이 작성한 댓글입니다.)</P>

<?php


session_start();

include $_SERVER['DOCUMENT_ROOT']."/db.php";

# 파일 Primary
$filePrimary = $_SESSION["filePrimary"];

# 로그인 유저
$user_id = $_SESSION['user_primary_key'];


# 클라이언트가 작성한 댓글 가져오기
$comments = "SELECT * FROM `postcomments` WHERE `filePrimary`='$filePrimary' and `comment_user`= '$user_id'";
$result = mysqli_query($conn, $comments);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $comment = $row['commentContent'];
        $commentTime = $row['commentTimestamp'];
        $comment_primary = $row['commentPrimary'];
        echo $comment_primary;
        ?>
            <p>
                <form method = "post" action = "real_delect(comment).php">
                <input type = "checkbox"  name = "choice_comment" value = "<?=$comment_primary ?>" ><?php echo "  " . $comment; ?></a></td><td><?php echo "  /" . $commentTime; ?></td></tr>
            </p>
        <?php }

    }


else {
    echo "<script>alert('작성한 댓글이 존재하지 않습니다.');
    history.back();
    </script>";}
?>

      <input type = "submit" naem = "submit" value = "삭제"> 
</body>
</html>
    

