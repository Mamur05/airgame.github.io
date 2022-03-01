<?php
if(!empty($_POST['serf_id'])){
    $serf_id = filter_var($_POST['serf_id'],FILTER_VALIDATE_INT);
    if($serf_id === FALSE){
        $data['error'] = 'Неверные данные!';
    }
    if(empty($data)){
       $numb =  $db->query("SELECT `uid` FROM `db_serf` WHERE `id` = '$serf_id'")->numRows();
        if($numb > 0){
			$data_serf = $db->query("SELECT `uid`, `balance` FROM `db_serf` WHERE `id` = '$serf_id'")->fetchArray();
			$owner = $data_serf['uid'];
            if($uid != $data_serf['uid'] && $uid != 1){
                $data['error'] = "Неверные данные!";
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
		$money = $data_serf['balance'];
		$owner = $data_serf['uid'];
		$db->query('UPDATE db_users SET money_b = money_b + ? WHERE id = ?',array($money, $owner));
		$db->query('DELETE FROM db_serf WHERE id = ?',array($serf_id));
        $data['status'] = 'success';
        $data['title'] = 'Успешно';
        $data['error'] = 'Вы успешно удалили ссылку, средства вам возвращены!';
        $data['redirect'] = '';
    }
}else{
    $data['status'] = 'error';
    $data['title'] = 'Ошибка';
    $data['error'] = 'Ошибка данных';
    $data['redirect'] = '';
}
echo json_encode($data);