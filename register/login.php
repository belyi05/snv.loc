<?php
if(isset($_SESSION["user_id"]))
	{    
		echo 'Здравствуйте уважаемый(ая) '.$_SESSION["famil"].' '.$_SESSION["name"].'<br />';
		echo '<a href="#logout" id="logout">Выход</a>';
		?><br><br>
		<style type="text/css">.documents{display:block;} .doc:hover{cursor:pointer;} h1.doc{border-bottom:1px dashed #B8032E !important;}</style>
		<script type="text/javascript">
		$(document).ready(function() {
		
		$("#bolv").hide();
		$(".doc").click(function() {
$(this).next().toggle();
});
		  
			

		 
		});
		</script>
		<? if(strstr($_SERVER['REQUEST_URI'], 'pokrovskoe')!='') 
		
		echo '	<!--<h1 id="gorki_doc" class="doc">Покровское (документы)</h1>-->
			 <div id="gorki_documents" class="documents">
 
				 
					
					<h2>Необходимая информация</h2>
					<ul>
				<li><a href="/docs/dogovor_podryada_pokrovskoe.doc">Договор подряда</a></li>
				<li><a href="/docs/dog_kup_prod_zu_pokrovskoe.doc">Договор купли-продажи земельного участка</a></li>
				<li><a href="/docs/kadastrowyi_pokrowscoe_1.pdf">Кадастровый паспорт</a></li>
				<li><a href="/docs/penplan_pokrovskoe.jpg">Генплан поселка</a></li>
				<li><a href="/docs/sv-vo_sobstv_pokrovskoe.pdf">Свидетельство на собственность</a></li>
				</ul>
			</div>';
		
		?>
	
		<? if(strstr($_SERVER['REQUEST_URI'], 'pokrovskie')!='') 
		
		echo '	<!--<h1 id="gorki_doc" class="doc">Покровские Горки (документы)</h1>-->
			 <div id="gorki_documents" class="documents">
 
				 
					
					<h2>Необходимая информация</h2>
					<ul>
				<li><a href="/docs/svid_pg.jpg">Свидетельство на собственность земельного участка</a></li>	
				<li><a href="/docs/kadastrowyi_pokrowskie_gorky.zip">Кадастровый паспорт</a></li>	
				<li><a href="/docs/zacony.zip">Законы, регламентирующие строительство на землях ИЖС</a></li>
				<li><a href="/docs/expert_pg.zip">Экспертное заключение на земельный участок</a></li>
				<li><a href="http://snvproject.ru/files/genplan_pokrovskie_gorki.pdf">Генплан в формате PDF</a></li>
				<li><a href="/docs/tu_kanal_pg.jpg">Технические условия на канализацию и электричество</a></li>
				<li><a href="/docs/geologiya_pokrovskie_gorki.pdf">Геология</a></li>
				<li><a href="/docs/teh_usloviya_elektr_pg.jpg">Технические условия на электричество</a></li>
				<li><a href="/docs/tu_gaz_kom.pdf">Технические условия на газ</a></li>
			</ul>
			</div>';
		
		?>	
			
		<? if(strstr($_SERVER['REQUEST_URI'], 'berezovka')!='') 
		
		echo '	<!--<h1 id="gorki_doc" class="doc">Березовка (документы)</h1>-->
			 <div id="gorki_documents" class="documents">
		 
					<h2>Необходимая информация</h2>
					<ul>
				<li><a href="/docs/dogovor_podryada_berezovka.doc">Договор подряда</a></li>
				<li><a href="/docs/dog_kup_prod_zu_berezovka.doc">Договор купли-продажи земельного участка</a></li>
				<li><a href="/docs/geo_berezowca.zip">Геология</a></li>
				<li><a href="/i/genplan_berezovka.jpg">Генплан в формате JPG</a></li>	
<li><a href="/i/genplan_berezovka.pdf">Генплан в формате PDF</a></li>				
				<li><a href="/docs/svidetelstwo_berezowca.zip">Свидетельство на собственность земельного участка</a></li>	
				<li><a href="/docs/kadastrowiy_berezowca.zip">Кадастровый паспорт</a></li>			
					<li><a href="/docs/tu_gaz_berezovka.jpg">ТУ газ</a></li>		
			</ul>
			</div>';
		
		?>
			
			
<? if($_SERVER['REQUEST_URI']=='/documents-gorki.htm') 
		
		echo '	<!--<h1 id="gorki_doc" class="doc">Горки-10 (документы)</h1>-->
			 <div id="gorki_documents" class="documents">
	
					<h2>Необходимая информация</h2>
					<ul>
				<li><a href="/docs/dogovor_podryada_gorki.doc">Договор подряда</a></li>
				<li><a href="/docs/teh_ysloviya_na_elektrichestvo.pdf">Технические условия</a></li>
				<li><a href="/docs/reglament_zastroyki.pdf">Регламент застройки</a></li>				
				<li><a href="/docs/geologiya.pdf">Геология</a></li>
				<li><a href="/docs/genplan.pdf">Генплан в формате PDF</a></li>
				<li><a href="/docs/analiz_vodi.pdf">Химический анализ воды</a></li>						
				<li><a href="/docs/gazific_gatchin.rar">Программа газификации Гатчинского р-на</a></li>
				<li><a href="/docs/scheme_gaz_gatchin.pdf">Схема газоснабжения Гатчинского р-на</a></li>
			</ul>
			</div>';
		
		?>
			
		<?php

		
	}
else{	
		?>
		<p>Если вы уже зарегистрированы, пожалуйста, войдите в систему, используя свой номер телефона в качестве логина и пароль, высланный вам по SMS.</p>
		<div id="loginform_block" style="background: #F3F2F2;padding: 10px 0 10px 20px;">
			<div id="result_login"></div>
			<form id="login_form" method="post" name="loginform">
				<div class="errors"></div>	
				
				<label for="login">Логин:<br /><span class="small">(моб. телефон)</span></label>
				<input type="text" name="login" id="login" /><br />
				
				<label for="pass">Пароль:</label>
				<input type="password" name="pass" id="pass" /><br />
				<input type="hidden" name="redirect" id="redirect" value="<?php echo  $_SERVER['PHP_SELF']; ?>" />
				
				<a href="#fogot_pass" id="fogot_pass">Забыли пароль?</a>
				<input type="submit" value="Войти" class="submit" />
				<div id="fogot">
					<p>Для восстановления пароля введите свой номер телефона</p>
					<div id="err_fogot"></div>
					<input type="text" name="tel" id="tel" /><br />
					<input type="button" class="fogot_but" id="get_pass" value="восстановить пароль" />
				</div>
			</form>
		</div>
		<p>Если вы у нас впервые, пожалуйста, зарегистрируйтесь.</p>
		<a href="#register" id="reg_link">Регистрация&nbsp;<span class="arrow_dn" id="arrow"></span></a>
			
		<div id="register_block" style="background: #F3F2F2;padding: 10px 0 10px 20px;">			
			<div id="register_form">
				<div id="result"></div>
				<form method="post" name="reg_form" id="reg_form"> 

				<div id="err_reg"></div>	
				
				<label for="name_f">Имя:</label>
				<input type="text" name="name_f" id="name_f" /><br />
				
				<label for="name_s">Фамилия:</label>
				<input type="text" name="name_s" id="name_s" /><br />
				
				<p style="vertical-align:top;">
				<label for="phone">Телефон:<br /><span class="small">(мобильный)</span></label>
				<input type="text" name="phone" id="phone" /><span class="small" style="padding: 5px 0 0 10px;">пример: 89110010101</span><br />
				</p>
				
				<label for="email">Email:</label>
				<input type="text" name="email" id="email" /><br />

				<input type="submit" value="зарегистрироваться" class="submit" />
				</form>
			</div>
		</div>	
		
		<?php
		
	}
	/*
	echo '<br /> SESSION -<pre>';
		print_r($_SESSION);
		echo '</pre>';
	*/
?>