<?php
if(isset($_POST['edit'])){
    $serf_id = filter_var($_POST['serf_id'],FILTER_VALIDATE_INT);
	$title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $url = filter_var($_POST['url'],FILTER_VALIDATE_URL);
    if($serf_id === FALSE && empty($data)){
        $data['error'] = 'Неверные данные!';
        $data['id'] = 'serf_id';
    }
    if($title === FALSE && empty($data)){
        $data['error'] = 'Неверно указано название!';
        $data['id'] = 'title';
    }
    if($url === FALSE && empty($data)){
        $data['error'] = 'Неверно указан URL!';
        $data['id'] = 'url';
    }

	if (mb_strlen($title) > 45) {
		$data['error'] = 'В поле Названия можно написать только 45 символов!';
        $data['id'] = '';
	}
	
	if (strlen($url) > 255) {
		$data['error'] = 'В поле URL можно написать только 255 символов!';
        $data['id'] = '';
	}
    if(empty($data)){
       $numb =  $db->query("SELECT `uid` FROM `db_serf` WHERE `id` = '$serf_id'")->numRows();
        if($numb > 0){
			$data_serf = $db->query("SELECT `uid`, `balance` FROM `db_serf` WHERE `id` = '$serf_id'")->fetchArray();
			$owner = $data_serf['uid'];
            if($uid != $data_serf['uid'] && $uid != 1){
                $data['error'] = "Ссылка вам не преадлежит!";
            }
        }else{
            $data['error'] = 'Ссылка не существует!';
        }
    }
    if(!empty($data)){
        $data['status'] = 'error';
        $data['title'] = 'Ошибка';
        $data['redirect'] = '';
    }
    if(empty($data)){
        $db->query("UPDATE `db_serf` SET `title` = '$title',`url` = '$url', `status` = 'deactive' WHERE `id` = '$serf_id'");
        $data['status'] = 'success';
        $data['title'] = 'Успешно';
        $data['error'] = 'Вы успешно отредактировали серфинг!';
        $data['redirect'] = '/user/serf/cabinet';
    }
}else{
    $data['status'] = 'error';
    $data['title'] = 'Ошибка';
    $data['error'] = 'Ошибка данных';
    $data['redirect'] = '';
}
echo json_encode($data);