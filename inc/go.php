<?php
# Ищем ID ссылки
$IDLink = intval($pg->params[1]);
$link_rows = $db->query('SELECT * FROM db_links WHERE id = ?',$IDLink)->fetchArray();

# Существование ссылки
if($link_rows != null) {
	$LinkCnt = $link_rows['id'];
	$LinkRows = $link_rows['url'];
	$db->query("UPDATE db_links SET `count` = `count` + 1 WHERE id = ?",array($LinkCnt));

	header('Location: '.$LinkRows.''); return; 
} else {
	exit('Такой ссылки нет!');
}
?>