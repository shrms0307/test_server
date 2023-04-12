<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";

session_start();


# 로그인 확인 시 진행
if(!isset($_SESSION['login'])) {
    header('Location: login.php');# 로그인 안 된 유저 로그인 페이지로 강제 이동
    exit();
}

# 유저 확인, 해당 유저 닉네임 가져오기
$user_id = $_SESSION['user_primary_key'];
$sql_user_nickname = "SELECT `nickname` FROM `community_userinformation` WHERE `userPrimary`='$user_id'";
$nickname_result = mysqli_query($conn, $sql_user_nickname);
while ($row = mysqli_fetch_array($nickname_result)) {
    $user_nickname = $row[ 'nickname' ];}

if(isset($_POST['upload'])){
     # community_userinformation 필드에 존재하지 않는 userPrimary일 시 issert 후 진행

     $DBcheck = "SELECT * FROM community_userinformation WHERE userPrimary='$user_id'";
     $check_user = mysqli_query($conn, $DBcheck);
 
     if (mysqli_num_rows($check_user) == 0 ) {
         $insert_user = "INSERT INTO `community_userinformation` ( `userPrimary` ) VALUES ( '$user_id' )";
         mysqli_query($conn, $insert_user);
     }

    $post_userPrimary = $user_id; # 해당 유저 primary key 저장
    $title = $_POST['title'];
    # 파일은 나중에 구현
    $content = $_POST['content'];
    $nickname = $user_nickname;
    $sql = "INSERT INTO filepost (title, content, nickname, post_userPrimary) VALUES ('$title', '$content', '$nickname', '$post_userPrimary')";
    if(mysqli_query($conn, $sql)) {

        # community_userinformation 테이블 업데이트 (포인트 지급, 업로드 수 측정)
        
        
        $updatePointsSql = "UPDATE community_userinformation SET point = point + 1, Create_Posts = Create_Posts + 1 WHERE userPrimary = $post_userPrimary";
        mysqli_query($conn, $updatePointsSql);
        echo "<script>alert('게시물 업로드 완료!');
        location.href='home.php';
        </script>";
        # header('Location: home.php');
        exit();}

    else {echo "Error: " . $sql . "<br>" . mysqli_error($conn);}
}


mysqli_close($conn);
?>

<html>
<head>
    <title>Create Post</title>
</head>
<body>
    <h1>게시물 작성</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="10" cols="30" required></textarea><br>
        <label for="file">업로드:</label>
        <input type="file" id="file" name="file"><br><br>
        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>