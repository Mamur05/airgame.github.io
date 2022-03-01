<?php

session_start();


$id = intval($pg->params[1]);

if (!isset($_SESSION['uid'])) { exit(); }

$nums = $db->query("SELECT * FROM db_serf WHERE id = '".$id."' and balance >= price and status = 'active' LIMIT 1")->numRows();
if ($nums >= 1){
$list = $db->query("SELECT * FROM db_serf WHERE id = '$id'")->fetchArray();
$price = $list['price'];
$tarif = $db->query("SELECT * FROM db_serf_item WHERE p_user = '$price'")->fetchArray();

	$_SESSION['view']['cnt'] = md5(session_id().$list['uid'].$list['id']);
	$_SESSION['view']['id'] = $list['id'];
	$_SESSION['view']['timer'] = $tarif['timer'];
	$_SESSION['view']['timestart'] = time();

?>

<html>
<head>
<title><?=$config->sitename;?> - Просмотр сайта <?=$list['title'];?></title>
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
    <link href="/assets/css/frame.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript">
        var vtime = stattime = <? echo $_SESSION['view']['timer'];?>;
        var cnt = '<? echo $_SESSION['view']['cnt'];?>';
    </script>
	
	 <script type="text/javascript">
        startClock();
    </script>
	<script type="text/javascript">
  function getXMLHTTP() {
    var xmlhtmp=null;
    if(window.XMLHttpRequest) {
      xmlhtmp=new XMLHttpRequest();
    } else if(window.ActiveXObject) {
      xmlhtmp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlhtmp;
  }
  var cptfix=0;
  var cptcode=0;
  var focus=0;
  var focuscheck=<?=$tarif['wind'];?>;
  var time=<?=$tarif['timer'];?>;
  var TTimer;
  function timerStep() {
    if(time<0) {
      time=0;
      cptfix=1;
      checkClick();
      return;
    }
    else
    {
      if(document.getElementById("timer")!=null) {
        time--;
        document.getElementById("timer").innerHTML=time;
        if(time==0) {
          clearTimeout(TTimer);
          cptfix=1;
          getCaptcha();
        }
        else
        {
          TTimer=setTimeout(timerStep, 1000);
        }
      }
    }
  }

  function hasIsFocus() {
    if(cptfix==0) {
      if(document.hasFocus()) {
        if(focus==0) {
          console.log("ass");
          document.getElementById("check").innerHTML='Дождитесь окончания таймера:<div class="timer notranslate" id="timer">'+time+'</div>';
          timerStart();
          focus=1;
        }
      }
      else
      {
        if(focus==1) {
          clearTimeout(TTimer);
          document.getElementById("check").innerHTML='<span style="color:#9e0707;">Окно не активно! Не уходите с вкладки!</span>';
          focus=0;
        }
      }
    }
  }

  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  function changeCpt(num) {
    cptcode=num;
    checkClick();
  }

  function loadArguments() {
    var xmlh=getXMLHTTP();
    xmlh.onreadystatechange=function() {
      if(xmlh.readyState==4 && xmlh.status==200) {
        if(xmlh.responseText!='') {
          $("#check").append(xmlh.responseText);
        }
      }
    };
    xmlh.open("GET", "/ajax/serf/coin.php", true);
    xmlh.setRequestHeader("Content-Type", "text/xml")
    xmlh.send(null);
  }

  function getCaptcha() {
    document.getElementById('check').style.display = 'none';
    nextstep(0, cnt);
  }

  function checkFocus() {
    setInterval(hasIsFocus, 100);
  }

  function timerStart() {
    clearTimeout(TTimer);
    TTimer=setTimeout(timerStep, 1000);
  }

  function checkClick() {
    var xmlh=getXMLHTTP();
    xmlh.onreadystatechange=function() {
      if(xmlh.readyState==4 && xmlh.status==200) {
        if(xmlh.responseText!='time_error' && xmlh.responseText!='create_error' && xmlh.responseText!='captcha_error') {
          window.location.href = '';
        }
        else if(xmlh.responseText=='captcha_error') {
          getCaptcha();
        }
        else
        {
          document.getElementById("check").innerHTML='Просмотр не засчитан! Повторите позже';
        }
      }
    };
    //xmlh.open("GET", "", true);
    //xmlh.setRequestHeader("Content-Type", "text/xml")
    //xmlh.send(null);
    document.getElementById("check").innerHTML='Подождите, загрузка сайта...';
  }

  setTimeout(function() {
    timerStart();
    if (focuscheck == 1) {
      checkFocus();
    }
    document.getElementById('blockwait').style.display = 'none';
  }, 1000);

  </script>
	</head>
	<body>
	<center>
<table class='table_gl' style='position: absolute; bottom: 0px;height:80px;' >
  <tr>
    <td style='width: 100%;text-align:center;padding-left: 10px;' rowspan='2'>
      <div class='logo'><?=$config->sitename;?></div>
      <div id='check'>Дождитесь окончания таймера:<div class='timer notranslate' id='timer'><?=$_SESSION['view']['timer'];?></div></div>
	
                    <div id="blockverify">
                        <div id="blockwait">
                            Подождите, сайт загружается...
                        </div>
                        <div id="blocktimer" style="display: none;">
                            <form class="clockalert" name="frm" method="post" action="" onsubmit="return false;">
                                <input name="clock" size="3" readonly="readonly" type="text" value=""/>
                                <br />
                                <span></span>
                            </form>
                        </div>

                    </div>
    </td>
  </tr>
</table>
</center>
<iFrame style='padding-bottom: 80px;' src='<?=$list['url']; ?>' width='100%' height='100%' id='framesite' frameborder='0' scrolling='yes'></iFrame>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="/assets/js/serf.js"></script>
</body>
</html>
<?php
}else{
    exit('Не существует или закончились просмотры');
}
?>