<?php
session_start();


# 서버 연결 
include $_SERVER['DOCUMENT_ROOT']."/db.php";

# 게시물 정보 띄우기
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM filepost WHERE `filePrimary`='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $content = $row['content'];
        $author = $row['nickname'];
        $postTimestamp = $row['post_Timestamp'];
    } 
} 

else {
    echo "<script>
        alert('삭제된 게시물 입니다. 확인을 눌러 게시판 목록 페이지로 이동하세요.');
        location.href='home.php';</script>";
}

# 파일 넘겨주기
$_SESSION["filePrimary"] = $id

?>

<html lang="en">


<!-- css 폼 불러오기 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<thead>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
</thead>


<tbody>
    <!-- 게시물 정보 출력 -->
    <h1 class="p-3 mb-2 bg-primary text-white" ><?php echo $title ?></h1>
	<p>작성자 :<?php echo $author ?></p>
    <p>업로드 날짜 : <?php echo $postTimestamp ?></p>

    <div class="card border-primary mb-3" style="max-width: 20rem;">
    <div class="card-header">내용</div>
    <div class="card-body"><p class="card-text"><?php echo $content ?></p></div>
    </div>
    
   

    <!-- 게시물 삭제 -->
    <form method = "get" action = "post_delect.php">
    <input type="submit" value="게시물 삭제하기" class="btn btn-primary me-md-2">
    </form>

    <hr>
    <h3>
    <p>댓글</p>
    </h3>

    <?php
    # 댓글 정보 가져오기 
    $sql1 = "SELECT * FROM `postcomments` WHERE `filePrimary`='$id'";
    $result1 = mysqli_query($conn, $sql1);
    echo '<table class="table" id="article-table">';
    echo '<tr class="table-primary"><th></th><th>댓글</th><th>작성자</th><th>업로드 시각</th></tr>';

    # 댓글 정보 출력
    # 닉넴 추가 언제하지
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $commentAuthor = $row['comment_user']; 
            $commentContent = $row['commentContent'];
            $commentTimestamp = $row['commentTimestamp'];
            ?>

            <tr class="table-secondary">
                <td class = "title"></td>
                <td><?=$commentContent?></td>
                <td><?=$commentAuthor?></td>
                <td><?=$commentTimestamp?></td>
            </tr>
            <?php
            
            echo '<hr>';
            
        }
    }


        # css / bootstrap 사용 이전 출력 코드
        #echo "<p class= p-3 mb-2 bg-primary text-white>$commentContent / <strong>$commentAuthor</strong> / $commentTimestamp</p>";
        #echo "<p>$commentAuthor</p>";
        
    else { echo "댓글이 아직 없습니다."; }
    echo '</table>';
    ?>
    
    <!-- 댓글 삭제 -->
    <form method = "get" action = "comment_delect.php">
    <input type="submit" value="내가 쓴 댓글 삭제하기" class="btn btn-primary me-md-2">
    </form>

    <hr>
    <h4>댓글 달기</h4>
    <form method="post" action="import_comment.php">
        <label>Comment:</label><br>
        <textarea name="comment"></textarea><br><br>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary me-md-2">
    </form>

</tbody>
</html>

