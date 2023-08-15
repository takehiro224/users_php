<?php declare(strict_types=1); ?>
<?php require_once(TEMPLATE_DIR . "header.php"); ?>

<div class="clearfix">
    <?php require_once(TEMPLATE_DIR . "menu.php"); ?>
    <div id="main">
        <div class="error_message"><?php echo $errorMessage; ?></div>
    </div>
    <form action="input.php" method="POST">
        <input type="button" id="back_button" value="戻る" onclick="location.href='input.php'; return false;">
    </form>
</div>

<?php require_once(TEMPLATE_DIR . "footer.php"); ?>