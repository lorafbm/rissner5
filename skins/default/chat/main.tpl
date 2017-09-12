<div class="chat">
    <?php if(isset($_SESSION['user'])) { ?>
    <div id="online">
        <p>Сейчас онлайн <span id="num"><?php echo $au->num_rows;?></span> человек:</p>
        <ul id="uonline">
            <?php while($list = $au->fetch_assoc()) {
            if ($list['access']==5){ ?>
            <li style="color:<?php echo hsc($list['color']);?>; background-color:#ccc"><?php echo hsc($list['name']);?></li>
            <?php } else{ ?>
            <li style="color:<?php echo hsc($list['color']);?>"><?php echo hsc($list['name']);?></li>
            <?php }} ?>
        </ul>
    </div>
    <div id="wrapper">
        <p class="wel">Вы вошли как <b><?php echo hsc($_SESSION['user']['name']); ?></b>
            <a href="/cab/exit">Выйти</a></p>
        <div class="clear"></div>
        <div id="allmess">
            <?php while($row = $res->fetch_assoc()) {
            $pos = stripos($row['text'], $_SESSION['user']['name']);
            if ($pos === false) {
            $mycolor = '#ffffff';
            } else{
            $mycolor='#CBE0FA';
            }
            if($row['text']=='Сообщение было удалено!'){ ?>
            <div class="com" id="<?php echo $row['id']; ?>">
                <div class="commentboxbodycom1" style="background-color:#EBF4FB;">
                    <?php if($_SESSION['user']['access']==5) { ?>
                    <?php } ?>
                    <div class="commentboxname"><span class="name1"
                                                      style="color:<?php echo hsc($row['color']);?>">-<?php echo hsc($row['name']);?></span><?php echo $row['data'].' id '.$row['id'];?>
                    </div>
                    <?php echo hsc($row['text']);?>
                </div>
            </div>
            <?php } else{ ?>
            <div class="com" id="<?php echo $row['id']; ?>">
                <div class="commentboxbodycom1" style="background-color:<?php echo  $mycolor; ?>">
                    <?php if($_SESSION['user']['access']==5) { ?>
                    <a class="delmes" onclick="delmes(<?php echo $row['id']; ?>);">&#215;</a>
                    <?php } ?>
                    <div class="commentboxname"><span class="name1"
                                                      style="color:<?php echo hsc($row['color']);?>">-<?php echo hsc($row['name']);?></span><?php echo $row['data'].' id '.$row['id'];?>
                    </div>
                    <?php echo hsc($row['text']);?>
                </div>
            </div>
            <?php } }?>
        </div>
        <div id="info" style="display: none"></div>
        <form name="message" id="message" action="/chat/add" method="post" onsubmit="return sendMess();">
            <input name="text" type="text" id="text">
            <input name="button" type="submit" id="button" value="Сказать">
        </form>
        <?php } else{ echo '<p class="game">Авторизуйтесь чтобы писать сообщения!</p>';} ?>
    </div>
</div>










