
<html>
<head>
    <title>게시판</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <?php
    
    include $_SERVER['DOCUMENT_ROOT']."/db.php";

    session_start();
    # 로그인 체크

    # echo $_SESSION['login'];

    # 데이터 가져오기
    $sql_post = "SELECT * FROM filepost";
    $result_1 = mysqli_query($conn, $sql_post);
    
    echo '<img class="fit-picture" src= "./img1.jpg">';
    echo '<table class="table" id="article-table">';
    echo '<tr class="table-primary"><th>제목</th><th>작성자</th><th>댓글</th><th>업로드 시각</th></tr>';



    while($row = mysqli_fetch_assoc($result_1)) {
        $post_id = $row['filePrimary'];
        $title = $row['title'];
        $nickname = $row['nickname'];
        $comments = $row['comments'];
        $post_timestamp = $row['post_Timestamp'];
        ?>
        <tr class="table-secondary">
            <td class="title"><a href="post_details.php? id=<?=$post_id?>"><?=$title?></a></td>
            <td class="hashtag"><a><?=$nickname?></a></td>
            <td class="user-id"><a><?=$comments?></a></td>
            <td class="created-at"><a><?=$post_timestamp?></a></td>
        </tr>
        <?php
    }


    if (isset($_SESSION['login'])) {
        $is_logged_in = true;

        # 로그인 되어 있을 시 로그아웃 버튼 활성화  
        if ($is_logged_in) {
            ?>
            <form method="post" action="">
            <input type="submit" name="logout" value="Logout" style="float:right;">
            </form>
            </tr>
            <?php
            }


        # 로그인 확인시 게시물 만들기 버튼 활성화   
        if ($is_logged_in) {
            $_SESSION['user_primary_key'];
            echo '
            <td>
            <br><form method="post" action="create_post.php">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end"></div>
            <input class="btn btn-primary me-md-2" type="submit" name="userPrimary" value="글쓰기">
            </form>
            </td>';
            
            echo '<br><a href="mypage.php"class="btn btn-outline-primary" style="float:right;">My Page</a></br>';


        }
        
        # 로그아웃 시
        if (isset($_POST['logout'])) {
            # 세션 종료 로그인 페이지로 이동
            session_destroy();
            header('Location: login.php');
            exit();
        }

	}

    # 로그인 안 되어 있을 시 로그인 버튼 활성화      
    else {
        echo '<form method="get" action="login.php">
                <input type="submit" name="login" value="Login" style="float:right;">
              </form>';
    }

    echo '</table>';

    mysqli_close($conn);

    ?>


     <!--<div class="row">
        <div class="card card-margin search-form">
            <div class="card-body p-0">
                <form id="search-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="row no-gutters">

                                <div class="col-lg-8 col-md-6 col-sm-12 p-0">
                                    <label for="search-value" hidden>검색어</label>
                                    <input type="text" placeholder="검색어..." class="form-control" id="search-value"
                                           name="searchValue">
                                </div>
                                <div class="col-lg-1 col-md-3 col-sm-12 p-0">
                                    <button type="submit" class="btn btn-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>-->

    <div class="row">
        <nav id="pagination" aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
    <style>
        .search-form {
  width: 80%;
  margin: 0 auto;
  margin-top: 1rem;
}

.search-form input {
  height: 100%;
  background: transparent;
  border: 0;
  display: block;
  width: 100%;
  padding: 1rem;
  height: 100%;
  font-size: 1rem;
}

.search-form select {
  background: transparent;
  border: 0;
  padding: 1rem;
  height: 100%;
  font-size: 1rem;
}

.search-form select:focus {
  border: 0;
}

.search-form button {
  height: 100%;
  width: 100%;
  font-size: 1rem;
}

.search-form button svg {
  width: 24px;
  height: 24px;
}

.card-margin {
  margin-bottom: 1.875rem;
}

@media (min-width: 992px) {
  .col-lg-2 {
    flex: 0 0 16.66667%;
    max-width: 16.66667%;
  }
}

.card {
  border: 0;
  box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
  -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
  -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
  -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
}

.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #ffffff;
  background-clip: border-box;
  border: 1px solid #e6e4e9;
  border-radius: 8px;
}

    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</tbody>
</html>

