<?php

include_once('mysql.class.php');
$action = htmlspecialchars($_POST['action'], ENT_QUOTES, 'UTF-8');
$title = htmlspecialchars(html_entity_decode($_POST['title']), ENT_QUOTES, 'UTF-8');
$content = htmlspecialchars(html_entity_decode(str_replace('<br>', '\n', $_POST['content'])), ENT_QUOTES, 'UTF-8');

if (substr($_POST['tid'], 0, 4) == 'task' ) $tid = substr(htmlspecialchars($_POST['tid'], ENT_QUOTES, 'UTF-8'), 4);
else $tid = 'false';

$content = str_replace('\n', '<br />', $content);

$time = time();
$insert = new DBCON;
var_dump($action);

if (is_numeric($tid) && $action == 'edit') {
    if (!empty($title)) $insert->sql_query = "UPDATE tasks SET title='$title',changed='$time' WHERE tid='$tid' ";
    else $insert->sql_query = "UPDATE tasks SET comment='$content',changed='$time' WHERE tid='$tid' ";
    $insert->sql_execute($insert->sql_query);
    //echo 'Task has been added ' . $title . ' content= ' . $content . ' tid= ' . $tid;
}
elseif(is_numeric($tid) && $action == 'close') {
    $insert->sql_query = "UPDATE tasks SET status='1' WHERE tid = '$tid'";
    $insert->sql_execute($insert->sql_query);
}
else die('Error!');


?>
