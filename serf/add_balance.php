<?php
if(!empty($_POST['serf_id'])){
    $serf_id = filter_var($_POST['serf_id'],FILTER_VALIDATE_INT);
	$money = filter_var($_POST['money'],FILTER_VALIDATE_FLOAT);
	$balance = filter_var($_POST['balance'],FILTER_VALIDATE_FLOAT);
	$money2 = $money - ($money * 0.1); // комиссия сайта 10%
	
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
	$user = $db->query("SELECT * FROM `db_users` WHERE `id` = '$uid'")->fetchArray();
	
    if($serf_id === FALSE){
        $data['error'] = 'Неверные данные!';
    }
	if($money === FALSE){
        $data['error'] = 'Не указана сумма!';
        $data['id'] = 'money';
    }
	
	if ($user['money_b'] <= $money2) {
		 $data['error'] = 'У вас не достаточно средств!';
	}
	
	if ($money < 0) {
		$data['error'] = 'Сумма не может быть 0!';
	}
	
    if(!empty($data)){
        $data['status'] = 'error';
        $data['title'] = 'Ошибка!';
        $data['redirect'] = '';
    }
    if(empty($data)){
		$db->query('UPDATE db_serf SET balance = balance + ? WHERE id = ?',array($money2, $serf_id));
		$db->query('UPDATE db_users SET money_b = money_b - ? WHERE id = ?',array($money, $uid));
		$data['balance'] = $data['balance'] + $money2;
        $data['status'] = 'success';
        $data['title'] = 'Успешно';
        $data['error'] = 'Вы успешно пополнили баланс ссылки на '.$money2.' руб.';
        $data['redirect'] = '';
    }
}else{
    $data['status'] = 'error';
    $data['title'] = 'Ошибка';
    $data['error'] = 'Ошибка данных';
    $data['redirect'] = '';
}
echo json_encode($data);