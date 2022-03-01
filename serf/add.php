<?php
if(isset($_POST['add'])){
	$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	$url = filter_var($_POST['url'], FILTER_VALIDATE_URL);
	$tarif = filter_var($_POST['tarif'], FILTER_VALIDATE_INT);
	$time = time();

    if($title === FALSE){
        $data['error'] = 'Неверно указано название!';
        $data['id'] = 'title';
    }
    if($url === FALSE && empty($data)){
        $data['error'] = 'Неверно указана ссылка!';
        $data['id'] = 'url';
    }
    if($tarif === FALSE && empty($data)){
        $data['error'] = 'Неверно выбран тариф!';
        $data['id'] = 'tarif';
    }
	
	if (mb_strlen($title) > 45) {
		$data['error'] = 'В поле Названия можно написать только 45 символов!';
        $data['id'] = '';
	}
	
	if (strlen($url) > 255) {
		$data['error'] = 'В поле URL можно написать только 255 символов!';
        $data['id'] = '';
	}
	
    if(!empty($data)){
        $data['status'] = 'error';
        $data['title'] = 'Ошибка';
        $data['redirect'] = '';
    }
    if(empty($data)){
		$list = $db->query("SELECT * FROM `db_serf_item` WHERE id = ?",$tarif)->fetchArray();
		$db->query("INSERT INTO db_serf (title, uid, url, price, date_add, status) VALUES (?,?,?,?,?,?)",$title,$uid,$url,$list['p_user'],$time,'deactive');
        $data['status'] = 'success';
        $data['title'] = 'Успешно';
        $data['error'] = 'Вы успешно добавили ссылку!';
        $data['redirect'] = '/user/serf/cabinet';
    }
}else{
    $data['status'] = 'error';
    $data['title'] = 'Ошибка';
    $data['error'] = 'Ошибка данных';
    $data['redirect'] = '';
}
echo json_encode($data);