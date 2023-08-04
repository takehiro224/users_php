<?php declare(strict_types=1); ?>
<?php require_once(TEMPLATE_DIR . "header.php"); ?>

<div id="login_main">
    <h3 id="title">ログイン画面</h3>
    <?php if($message === "") { ?>
        <p><?php echo $message?></p>
    <?php } ?>
    <div class="text_center">
        <form action="login.php" method="POST">
            <div id="login_area">
                <span>ログインID</span>
                <input type="password" name="password" value="" />
            </div>
            <div>
                <span>パスワード</span>
                <input type="password" name="password" value="" />
            </div>
            <div class="text_center">
                <input type="submit" id="login_button" value="ログイン">
            </div>
        </form>
    </div>
</div>

<?php require_once("footer.php"); ?>