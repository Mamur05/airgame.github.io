
<div class="card p-2 pb-1 mb-2">
	<div><h4 class="text-uppercase mb-0 ml-1 text-center"><b>Внимание акция!!!</b> Пополни баланс и получи бонус!</h4>
<div class="nav nav-pills nav-fill text-uppercase">
<?php
$bon_p= $db->query('SELECT * FROM db_percent WHERE type = 1  ORDER BY sum_a < sum_a DESC LIMIT 7')->fetchAll();
foreach ($bon_p as $bon_p) {
		?>
<div class="nav-item nav-link alert-warning text-dark m-1 p-1 text-center"><div class="p-1">ПОПОЛНИ<br/>
от <b class="text-danger"><?=$bon_p['sum_a']; ?></b> до <b class="text-danger"><?=$bon_p['sum_b']; ?></b> руб. <br/> <b><span class="text-white" style="padding: 3px 10px; border-radius: 1em;background-color: #e62e37;font-size: 110%;">бонус <span style="color: #ffef02;">+<?=$bon_p['sum_x']*100; ?>%</span></span></b></div></div>
		<?php
	}
  ?></div></div>
</div>