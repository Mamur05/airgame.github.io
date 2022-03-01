<?php
if(!empty($_POST['serf_id']) && !empty($_POST['status'])){
    $status_array = array('active','deactive');
    $serf_id = filter_var($_POST['serf_id'],FILTER_VALIDATE_INT);
    $status = $_POST['status'];
    if($serf_id === FALSE){
        $data['error'] = 'Неверные данные!';
    }
    if(!in_array($status,$status_array) && empty($data)){
        $data['error'] = 'Ошибка данных';
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
    if(in_array($status,$status_array) && empty($data)){
        $db->query("UPDATE `db_serf` SET `status` = '$status' WHERE `id` = '$serf_id'");
        $data['status'] = 'success';
        $data['title'] = 'Успешно';
        $data['error'] = 'Вы успешно одобрили задание';
        $data['redirect'] = '';
    }
}else{
    $data['status'] = 'error';
    $data['title'] = 'Ошибка';
    $data['error'] = 'Ошибка данных';
    $data['redirect'] = '';
}
echo json_encode($data);