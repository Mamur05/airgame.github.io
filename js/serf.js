function getHTTPRequest()
{
    var req = false;
    try {
        req = new XMLHttpRequest();
    } catch(err) {
        try {
            req = new ActiveXObject("MsXML2.XMLHTTP");
        } catch(err) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(err) {
                req = false;
            }
        }
    }
    return req;
}

function startClock() {
    if (vtime == stattime) {
        //console.log("ass"+vtime);
        document.getElementById('blockwait').style.display = 'none';
        document.getElementById('blocktimer').style.display = '';
    }
    if (vtime >= 0) {
        //console.log("ass2");
        document.forms['frm'].clock.value = vtime;
        vtime --;
        tm = setTimeout("startClock(0)", 1000);
        cptfix=1;
    } else {
        if (tm)
            clearTimeout(tm);
        nextstep(0, cnt);
        cptfix=1;
    }
}

//////////////
function checkPageFocus() {
    var info = document.getElementById("message");

    if ( document.hasFocus() ) {
        info.innerHTML = "Документ имеет фокус.";
    } else {
        info.innerHTML = "Документ не имеет фокус.";
    }
}

function vernum(vnum) {
    nextstep(vnum, cnt);
    return false;
}
                        
function nextstep(num, cnt)
{
    var myReq = getHTTPRequest();
    var params = "num="+num+"&cnt="+cnt;

    function setstate()
    {
        if ((myReq.readyState == 4)&&(myReq.status == 200)) {
            var resvalue = myReq.responseText;
            
            if (resvalue != '') {
                //console.log("->"+resvalue);
                if (resvalue.substr(0, 2) == 'OK') { 
                    vars = resvalue.split(";"); 
                    //console.log("->"+vars+"->"+vars[2]);
                    document.getElementById("blockverify").innerHTML = '<div class="blocksuccess">Спасибо за посещение!<br /><span>Плата за просмотр ('+vars[1]+' руб.) зачислена</span></div>';
                    if ((vars[2] != '0')&&(vars[2].length > 1)) {
                        setTimeout("top.location = '"+vars[2]+"'", 500);
                    }
                } else
                if (resvalue == '0')
                    //alert(resvalue);
                    document.getElementById("blockverify").innerHTML = '<div class="blockerror">Действие не произведено</div>';
                else
                    document.getElementById("blockverify").innerHTML = resvalue;
            }
        } else {
            document.getElementById("blockverify").innerHTML = "<span class='loading' title='Подождите пожалуйста...'></span>";
        }
    }
    myReq.open("POST", "/ajax/serf/coin.php", true);
    myReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myReq.setRequestHeader("Content-lenght", params.length);
    //myReq.setRequestHeader("Connection", "close");
    myReq.onreadystatechange = setstate;
    myReq.send(params);
    return false;
}