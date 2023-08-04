<?php declare(strict_types=1); ?>
<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
        <!-- <title><?php echo $title; ?></title> -->
        <title>Title</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <!-- <link rel="stylesheet" type="text/css" href='css/style.css'/> -->
    </head>
    <body>
    <div id="header">
        <h1>
            <div class="clearfix">
                <div class="fl">社員管理システム</div>
            </div>
        </h1>
    </div>
    <div id="login_main">
        <h3 id="title">TOP画面</h3>
        <form action="index.php" method="post">
            <button type="submit">Sing in</button>
        </form>
    </div>
<?php require_once("footer.php"); ?>