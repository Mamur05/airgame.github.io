<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Автореферал';


 
 $db->Query("SELECT * FROM db_users WHERE id = '$uid' LIMIT 1");
 $user_data = $db->FetchArray();
 $username = $user_data['login'];
 $db->Query("SELECT * FROM db_leader");
 $leader = $db->FetchArray();
 $price = 30;
 #$db->Query("INSERT INTO db_leader (user_id, user) VALUES ('1', 'first')");
 ?> 
 <div style="   margin-left: px;">

		
<BR />
<div class="alert bg-light text-center">
    Воспользовавшись данной функцией, Вы будете получать каждого зарегистрированного нового реферала, который приходит в систему без приглашения и Ваш заработок увеличится в разы!<br>
	<font color="red"> Дополнительно за каждого реферала Вам начисляется <b>0.0001 руб/час</b> к скорости заработка!</font>
</div>
<BR />
<?PHP
if(isset($_POST["leader"])){
if ($user_data["money_b"] >= $price AND $price>0) {

if ($leader['user_id'] != $uid) {

$db->Query("UPDATE db_users SET money_b = money_b - '$price' WHERE id = '$uid'");
$db->Query("UPDATE db_leader SET login = '$username', user_id = '$uid' WHERE id = '1'");
Header("Location: /user/pin");

}else echo '<script> swal("Операция отменена!", "Вы уже являетесь лидером рефералов!", "error"); </script>';

}else echo '<script> swal("Неудача!", "У Вас недостаточно средств для оплаты!", "error"); </script>';
}

?>

<div class="alert alert-success text-center">
    На данный момент лидером рефералов является пользователь: <b style="color:red; font-size:25px;"><?=$leader['login'];?></b>
</div>
    <br><br><center><form action="" method="post"><input type="submit" name="leader" class="btn btn-lg btn-success mt-1" value="Стать лидером за <?=$price;?> руб."/></center></form>
<br><br><br><br>
</div> 
