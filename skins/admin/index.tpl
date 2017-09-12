<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo hsc(Core:: $META['title']); ?></title>
    <meta name="description" content="<?php echo hsc(Core::$META['description']); ?>">
    <meta name="keywords" content="<?php echo hsc(Core::$META['keywords']); ?>">
    <link href="/skins/default/css/style5.css" rel="stylesheet" type="text/css">
    <?php if(count(Core::$CSS)){echo implode("\n",Core::$CSS);} ?>
    <?php if(count(Core::$JS)){echo implode("\n",Core::$JS);} ?>
</head>
<body>
<div class="main">
    <header>
        <div class="hr">&nbsp;</div>
        <nav>
            <!-- <a href="/" class="logoo"></a>-->
            <div class="cms">CMS<span>Управление сайтом</span></div>
            <?php if (isset($_SESSION['user'])&& $_SESSION['user']['access'] == 5){ ?>
            <a href="/admin">главная</a>/
            <a href="/admin/news"> новости</a>/
            <a href="/admin/goods"> товары</a>/
            <a href="/admin/books">книги</a>/
            <a href="/admin/users">пользователи</a>/
            <?php } ?>
            <a href="/cab/exit" class="alast"> Выход </a>
        </nav>
        <div class="clear"></div>
    </header>
    <div class="include">
        <?php  echo $content;  ?>
    </div>
    <footer>
        <div class="wfooter">
            <div class="af1">
                <h1>rissner</h1>
                <p>© <?php
                    if (Core::$DATE != date('Y')) {
                        echo Core::$DATE. '-' . date('Y');
                    } else {
                        echo Core::$DATE;
                    }
                    ?>
                    <span class="ppart">|</span><a href="#"> CMS</a></p>
            </div>
            <div class="clear"></div>
        </div>
    </footer>
    <a href="/admin" class="uptotop"></a>
</div>
</body>
</html>
