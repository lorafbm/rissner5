<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo hsc(Core:: $META['title']); ?></title>
    <meta name="description" content="<?php echo hsc(Core::$META['description']); ?>">
    <meta name="keywords" content="<?php echo hsc(Core::$META['keywords']); ?>">
    <link href="/skins/<?php echo Core::$SKIN; ?>/css/style5.css" rel="stylesheet" type="text/css">
    <?php if(isset($_SESSION['user'])){ $name =  hsc($_SESSION['user']['name']); $color =  $_SESSION['user']['color']; $access =  $_SESSION['user']['access']; } ?>
    <script> var name = '<?php echo @name; ?>';var color = '<?php echo @$color; ?>';var access = '<?php echo @$access; ?>';</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type=text/javascript src="/skins/default/js/scripts1_v1.js"></script>
    <?php if(count(Core::$CSS)){echo implode("\n",Core::$CSS);} ?>
    <?php if(count(Core::$JS)){echo implode("\n",Core::$JS);} ?>
    <!--карта-->
    <style type="text/css">
       /* html, body, */#map-canvas { height: 500px; margin: 0; padding: 0;}
    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAvnworgEyqESckECta1SYq0yFLnYgAZg&callback">
    </script>
    <script type="text/javascript">
        function initialize() {
            var myLatlng = new google.maps.LatLng(49.9286585, 36.2555004);
            var mapOptions = {
                center: { lat: 49.9286585, lng: 36.2555004},
                zoom: 14
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
            var contentString = '<div id="content">'+
                '<div id="siteNotice"></div>'+
                '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
                '<div id="bodyContent">'+
                '<p><b>Артсити</b></p>'+
                '<p>Харьков, Сохора,1</p>'+
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Сохора,1'
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <!--конец карта-->
</head>
<body>
<div class="main">
    <div class="prfon1" id="prfon1" style="display: none"></div>
    <header>
        <div class="left">
            <a href="#" class="f"></a>
            <a href="#" class="g"></a>
            <a href="#" class="c"></a>
            <a href="#" class="r"></a>
            <a href="#" class="in"></a>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <?php if (isset($_SESSION['user'])){ ?>
        <div class="right1"><?php echo '<p class="game">Здравствуйте,'.hsc($_SESSION['user']['name']).'</p>';?></div>
        <?php } ?>

        <div class="right">phone: + 8 800 757 43 92 <span class="rline"> &nbsp;</span><a href="#"> Sitemap </a>|<a
                    href="#">FAQ</a></div>
        <div class="clear"></div>
        <div class="hr">&nbsp;</div>
        <nav>
            <a href="/">главная</a>/
            <!--<a href="static/about" class="active">о нас</a>/-->
            <a href="/goods">продукция</a>/
            <a href="/news">новости</a>/
            <a href="/fmanager">ф менеджер</a>
            <a href="/calcul">калькулятор</a>/
            <a href="/games">игра</a>/
            <!--<a href="/cab">регистрация</a>/
            <a href="/cab/auth">авторизация</a>/-->
            <a href="/comments">отзывы</a>/
            <a href="/books">книги</a>/
            <a href="/chat">чат</a>/
            <?php if (!isset($_SESSION['user'])){ ?>
            <span class="go" onclick="hideShow('prfon1');">вход</span>
            <?php } ?>
            <a href="/lupa" class="lupa"></a>
            <?php if (isset($_SESSION['user'])){ ?>
            <a href="/admin">админ</a>/
            <a href="/cab/exit"> Выход</a> <?php } ?>
        </nav>
        <div class="clear"></div>
    </header>

    <div id="aaa" class="aaa" style="display: none">
        <a href="/" class="close">&#215;</a>
        <fieldset>
            <div class="fon">
                <form action="/cab/auth" method="post" class="formauto" onsubmit="return check('name','pass');">
                    <p><input type="text" name="name" id="name" placeholder="логин"><br><span class="prim" id="primn"> *  от   2 до 16  символов</span>
                    </p>
                    <p><input type="password" name="pass" id="pass" placeholder="пароль"><br><span class="prim"
                                                                                                   id="primp"> * не менее 4 символов</span>
                    </p>
                    <div class="mess" style="display: none"></div>
                    <input type="hidden" name="ip" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                    <input type="hidden" name="hua" id="hua" value="<?php echo $_SERVER['HTTP_USER_AGENT']; ?>">
                    <p><input type="checkbox" name="remember" id="remember"><span class="zap">Запомнить</span>
                        <input type="submit" name="button" value="Войти"></p>
                    <p class="gamel"><a href="/cab" class="goreg">Регистрация</a></p>
                </form>
            </div>
        </fieldset>
    </div>
</div>
<div class="include">
    <?php  echo $content;  ?>
</div>
<div class="partners">
    <div class="wpartners">
        <a href="#" class="gabro"></a>
        <a href="#" class="industrix"></a>
        <a href="#" class="rapid"></a>
        <a href="#" class="diplomat"></a>
        <a href="#" class="green"></a>
        <a href="#" class="foower"></a>
        <div class="clear"></div>
    </div>
</div>
<div class="footer">
    <footer>
        <div class="wfooter">
            <div class="f1">
                <h1>rissner</h1>
                <p>© <?php
                    if (Core::$DATE != date('Y')) {
                        echo Core::$DATE. '-' . date('Y');
                    } else {
                        echo Core::$DATE;
                    }
                    ?>
                    <span class="ppart">|</span><a href="#"> Privacy Policy</a></p>
            </div>
            <div class="f2"><p class="ftitle">Последние новости</p>
                <p>Eos et accusamus et iustom odgnissimos ducimus qui blap.</p>
                <p class="dotted"><a href="#">5 Days ago.</a></p>
                <p>At accusamus et iustom odgnissimos ducimus qui blapraesentium.</p>

                <?php
                     if (Core::$DATAPRICE < date('j')) {
                         echo '<p>New price is availible &nbsp;'.(date('j') - Core::$DATAPRICE).'&nbsp;days ago.</p>';
                } else {
                echo '<p>New price is availible today.</p>';
                }
                ?>
            </div>
            <div class="f3"><p class="ftitle">Online Support</p>
                <p class="phone"> + 8 800 757 43 92</p>
                <p>Ask Your questions by e-mail:</p>
                <p><a href="mailto:mail@demolink.org">mail@demolink.org</a></p>
            </div>
            <div class="seti"><p class="ftitle">Get In Touch</p>
                <a href="#" class="ff"></a>
                <a href="#" class="fg"></a>
                <a href="#" class="fc"></a>
                <a href="#" class="fr"></a>
                <a href="#" class="fin"></a>
            </div>
            <div class="clear"></div>
        </div>
    </footer>
    <!--<a href="#" class="map"></a>-->
    <div id="map-canvas"></div>

    <a href="/" class="uptotop"></a>
</div>
</body>
</html>
