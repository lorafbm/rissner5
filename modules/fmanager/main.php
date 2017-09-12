<?php
/*файловый менеджер*/
$dir =(isset($_GET['link'])?( $_GET['link']) :'.');
$files=scandir($dir);
unset ($files[0]);
$infa= '<ul style="list-style: none">';
foreach ($files as $v){
    if (is_dir( $dir .'/' . $v)) {
        $infa.= '<li style="text-align: left;"><img src="/skins/default/img/img2.png" width="17px" height="17px" alt="papka"><a href="/fmanager?link='.(isset($_GET['link']) ? ($_GET['link']).'/'.$v :$v).'">'.$v.'</a></li>';
    }else {
        $infa.= '<li style="text-align: left;"><img src="/skins/default/img/img1.png" width="17px" height="17px" alt="file">'.$v.'</li>';
    }
}
'</ul>';
if (isset($_GET['link'])) {
    $iinfa= '<a href="/fmanager">Вернуться</a>';
}





