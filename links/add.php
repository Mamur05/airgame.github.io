<?php
if(isset($_POST['add'])){
	$text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
	$url = filter_var($_POST['url'], FILTER_VALIDATE_URL);
	$price_link = $db->query("SELECT price_link FROM  db_conf WHERE id = 1")->fetchArray();
	$time = time();

    if($text === FALSE){
        $data['error'] = 'Неверно указано название!';
        $data['id'] = 'text';
    }
    if($url === FALSE && empty($data)){
        $data['error'] = 'Неверно указана ссылка!';
        $data['id'] = 'url';
    }
	
	$user = $db->query("SELECT * FROM `db_users` WHERE `id` = '$uid'")->fetchArray();
	
	if ($user['money_b'] < $price_link['price_link']) {
		 $data['error'] = 'У вас не достаточно средств для размещения ссылки!';
	}
	
	if (mb_strlen($text) > 18) {
		$data['error'] = 'В поле ЗАГОЛОВОК ССЫЛКИ можно написать только 18 символов!';
        $data['id'] = '';
	}
	
	if (strlen($url) > 200) {
		$data['error'] = 'В поле URL можно написать только 200 символов!';
        $data['id'] = '';
	}
	
    if(!empty($data)){
        $data['status'] = 'error';
        $data['title'] = 'Ошибка';
        $data['redirect'] = '';
    }
    if(empty($data)){
		$db->query("INSERT INTO db_links (uid, text, url, date_add) VALUES (?,?,?,?)",array($uid,$text,$url,$time));
		$db->query("UPDATE db_users SET money_b = money_b - ? WHERE id = ?",array($price_link['price_link'], $uid));
        $data['status'] = 'success';
        $data['title'] = 'Успешно';
        $data['error'] = 'Вы успешно добавили ссылку в цепочку ссылок!';
        $data['redirect'] = '/user/links';
    }
}else{
    $data['status'] = 'error';
    $data['title'] = 'Ошибка';
    $data['error'] = 'Ошибка данных';
    $data['redirect'] = '';
}
echo json_encode($data);