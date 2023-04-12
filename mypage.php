<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";


	# 로그인 확인
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
        exit();
    }
	# 로그인저 세션 유 
    $user_id = $_SESSION['user_primary_key'];


    // 유저 포인트 가져오기(테이블 : community_userinformation)
    $user_query = mysqli_query($conn, "SELECT * FROM `community_userinformation` WHERE `userPrimary` = '$user_id'");
	while($user_info = mysqli_fetch_assoc($user_query)){
		$points = $user_info['point'];
	}


	// 유저 정보 가져오기(테이블 : user_information)
	$user_information = mysqli_query($conn, "SELECT * FROM `user_information` WHERE `userPrimary` = '$user_id'");
	while($user_infoma= mysqli_fetch_assoc($user_information)){
		$User_name = $user_infoma['name'];
	}


    // 작성한 게시물 정보 가져오기
    $posts_query = mysqli_query($conn, "SELECT * FROM filepost WHERE post_userPrimary='$user_id' ORDER BY post_Timestamp DESC");


	// 닉네임 가져오기
	$sql_user_nickname = mysqli_query($conn,"SELECT `nickname` FROM `community_userinformation` WHERE `userPrimary`='$user_id'");
	while($user_nickname= mysqli_fetch_assoc($sql_user_nickname)){
		$User_nickname = $user_nickname['nickname'];
	}


    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Page</title>
</head>

<body>
	<h1>My Page</h1>
	<!--유저 이름 띄우기-->
	<p>환영합니다, <?php echo $User_name; ?>!</p>
	
	<!-- 비밀번호 변경 -->
	<form method="get" action="change_password.php">
		<input type="submit" name="change_password" value="비밀번호 변경">
	</form>

	<!-- 잔여 포인트 출력 -->
	<p>보유 포인트: <?php
	if ($points==Null){echo "포인트가 없습니다. 게시물을 작성하여 포인트를 얻으세요!";} 
	else echo $points; ?></p>
	<!-- 작성한 게시물 -->
	<h3>작성한 게시물</h3>
	<?php while($post = mysqli_fetch_assoc($posts_query)){ ?>
		<p>
			<form method = "get" action = "post_details.php">
			<a href="post_details.php? id=<?php echo $post['filePrimary']; ?>"><?php echo $post['title']; ?></a> - 
			<?php echo $post['post_Timestamp']; ?>
		</p>
	<?php } ?>

	

	<!-- 게시물 작성 -->
	<form method="post" action="create_post.php">
		<!--<input type="submit" name="create_post" value=""> 이거 삭제하면 안 됨 뭘까-->
	</form>

	<a class="p-2 text-muted" href="create_post.php">
	<input type="submit" value="게시물 작성"></a>


	<!-- 닉네임 생성 -->
	<h5><?php echo $User_name; ?> 님의 닉네임은 ?</h5>
	<form method="get" action="create_nickname.php">
		<p><?php if(isset($User_nickname)){echo $User_nickname;} else { echo "닉네임이 존재하지 않습니다.";
		} ?></p>
		<input type="submit" name="create_nickname" value="닉네임이 없으신가요?">
	</form>


</body>
</html>
