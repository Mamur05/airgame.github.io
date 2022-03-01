<?php
session_start();

define('TIME', time());
define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
    function get_codek_ckick($dek) {
        $codek[1] = array(1 => '2', 2 => '6', 3 => '3', 4 => '4', 5 => '5', 6 => '1', 7 => '7', 8 => '8');
        $codek[2] = array(1 => '3', 2 => '2', 3 => '8', 4 => '4', 5 => '5', 6 => '7', 7 => '6', 8 => '1');
        $codek[3] = array(1 => '8', 2 => '2', 3 => '4', 4 => '7', 5 => '5', 6 => '6', 7 => '3', 8 => '1');
        if (isset($codek[$dek])) return $codek[$dek];
        return false;
    }

if (!isset($_SESSION['uid'])) { exit('1'); }

if (isset($_POST['cnt']) && isset($_POST['num']) && isset($_SESSION['view']) && $_POST['cnt'] == $_SESSION['view']['cnt'])
{
    $num = (int)$_POST['num'];
    if ($num)
    {
        $minus = TIME - $_SESSION['view']['timestart'];
        if ($minus < $_SESSION['view']['timer']) exit('2');
        $codek = get_codek_ckick($_SESSION['view']['codek_click']);
        foreach ($codek as $k => $v)
        {
            if ($v == $num)
            {
                $num = $k;
                break;
            }
        }

        if ($num == $_SESSION['view']['captcha'])
        {
			
			# Система
			spl_autoload_register(function ($lfc) {
				require_once (BASE_DIR.'/core/'.$lfc.'.php');
			});
           # Класс конфига
			$config = new config;
            # База данных
			$db = new db($config->db_host, $config->db_user, $config->db_pass, $config->db_name);
			
			# Удаляем клик за 24 часа если время прошло
			//$db->query("DELETE FROM db_serf_click WHERE id = '".$_SESSION['view']['id']."' AND time_add + 86400 > '".time()."'");
			
		# Ищем пользователя
		$usid = $_SESSION['uid'];
		$user_info  = $db->query("SELECT * FROM `db_users` WHERE id = ?",$usid)->fetchArray();

		$num_rows = $db->query("SELECT * FROM  db_serf WHERE id = '".$_SESSION['view']['id']."' and balance >= price AND status = 'active' LIMIT 1")->numRows();
		if ($num_rows > 0)
		{

$num24 = $db->query("SELECT ident, time_add FROM db_serf_click WHERE ident = '".$_SESSION['view']['id']."' AND uid = '".$_SESSION['uid']."' AND time_add + 86400 > '".time()."'")->numRows();

if ($num24 >= 1) exit('<div class="blockerror">Ошибка!<br /><span>Не прошло 24 часа!</span></div>');
				
				$result = $db->query("SELECT * FROM  db_serf WHERE id = '".$_SESSION['view']['id']."' and balance >= price LIMIT 1")->fetchArray();
                $move = $result['url'];
                $id = $result['id'];
                if ($id != $_SESSION['view']['id']) exit('<div class="blockerror">ERROR!!!</div>');
		
		# Оплата за просмотр
                $price = $result['price'];
		if($user_info['sum_in'] <= 9.99) {
			$pay_user = number_format(($price/2),2); // не пополнял
		}
		else {
			$pay_user = number_format($price,2); // пополнял
		}

		# Записываем что просмотрена ссылка
               $num_rows_click = $db->query("SELECT id, ident FROM db_serf_click WHERE uid = '".$_SESSION['uid']."' and ident = '".$id."' LIMIT 1")->numRows();
                if ($num_rows_click >= 1)
                {
					//exit ('<div class="blockerror">Ошибка!<br /><span>Вы уже просматривали данную ссылку!</span></div>');
                    $db->query("INSERT INTO db_serf_click (`ident`, `time_add`, `uid`) VALUES (?,?,?)",array($id,time(),$_SESSION['uid']));
                }
                else
                {
                   $db->query("INSERT INTO db_serf_click (`ident`, `time_add`, `uid`) VALUES (?,?,?)",array($id,time(),$_SESSION['uid']));
                }
                
                //зачисление денег за просмотр пользователю
                $to_views = 1;
                $db->query("UPDATE db_users SET `money_p` = `money_p` + ?, `views` = `views` + ? WHERE id = ?",array($pay_user,$to_views,$_SESSION['uid']));
                
                //записываем просмотр списываем бабло
                $db->query("UPDATE db_serf SET `view` = `view` + ?, `balance` = `balance` - ?	WHERE id = ?",array('1',$price, $id));

               
				// Удаляем сессию после записи, и выводим статус ОК
                unset($_SESSION['view']);
                exit('OK;'.$pay_user.';'.$move.'');
            }
            else
            {
                exit(3);
            }


		
        }
        else
        {
            exit('<div class="blockerror">Ошибка!<br /><span>Неверно решена задача!</span></div>');
        }
    }
    else if ($num == 0)
    {
        $codek_new = rand(1, 3);
        $_SESSION['view']['codek_click'] = $codek_new;
        $codek = get_codek_ckick($codek_new);
        $rand = rand(1000000, 9999999);
    ?>
        <table class="clocktable" align="center">
            <tr>
                <td><img src="/assets/captcha/captcha-st/captcha.php?sid=<?php echo $rand; ?>" alt="Проверка" style="margin: 0 10px 0 0;" /></td>
                <td nowrap="nowrap">
                    <?php
                    for($n = 1; $n<=8; $n++)
                    {
                        if ($n == 5) echo '<br />';
                    ?>
                        <span class="serfnum" onclick="vernum(<?php echo $codek[$n] ?>);"><?php echo $n; ?></span>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
<?php
    }
    else
    {
        exit('4');
    }

}
else
{
    exit('5');
}
?>