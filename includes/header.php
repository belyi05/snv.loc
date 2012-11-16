<?/*if ((substr_count($_SERVER['REQUEST_URI'], 'banner')>0)&&($_COOKIE['ads']!='banner')) 
        { 
           setcookie("ads", 'banner',time()+259200);  
                
         }
else if ((substr_count($_SERVER['REQUEST_URI'], 'openstat')>0)&&($_COOKIE['ads']!='direct')) 
        { 
           setcookie("ads", 'direct',time()+259200);
                
         }
		 
else if ((substr_count($_SERVER['REQUEST_URI'], 'adwords')>0)&&($_COOKIE['ads']!='adwords')) 
        { 
           setcookie("ads", "adwords",time()+259200);
                
         }*/
 ?>
<?header("Content-Type: text/html; charset=utf8");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Description" content="" />
    <meta name="KeyWords" content="" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="shortcut icon" href="#" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

    <!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="/js/zvonok.js"></script>
   <script type="text/javascript" src="/js/fancybox.js"></script>
    <script type="text/javascript" src="js/hoverIntent.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="http://snvproject.ru/js/preview.js"></script>

    <link rel="stylesheet" href="/css/fancybox.css" type="text/css">
    <script type="text/javascript" src="js/jquery.jcarousellite.min.js"></script>
    <script type="text/javascript" src="http://snvproject.ru/js/jquery.tools.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("a[rel*=image]").fancybox({'showNavArrows': true, 'titlePosition'  : 'over'});
            $("a[rel*=popup]").fancybox({'showNavArrows': false});

        });
    </script>
    <!-- timer -->
    <script type="text/javascript" src="/js/timer/lb_timer.js"></script>
    <link href="/js/timer/timer.css" rel="stylesheet" type="text/css" media="all" />
    <?
    function is_page($Link, $Name)
    {
        $H='';
        if (!preg_match('~(/|^)'.$Link.'$~', $_SERVER['REQUEST_URI']))
        {
            $H='<a href="'.$Link.'">'.$Name.'</a>';
        } else {
            $H=$Name;
        }
        echo $H;
        return;
    }

    // ===================== ряд функция для облекчения написания кода =============
    /**
     * Вводим константы для названия проектов
     */
    define('SNV_PROJECT_GORKI', 'gorki');
    define('SNV_PROJECT_POKROVSKOE', 'pokrovskoe');
    define('SNV_PROJECT_POKROVSKOIE_GORKI', 'ie-gorki');
    define('SNV_PROJECT_BEREZOVKA', 'berezovka');

    /**
     * функция для определения выбраного посёлка
     *
     * з.ы.
     * данная функция юзаеться для определния какой виджет выводить
     */
    function _snv_getProject() {
        // декодируем url
        $url = urldecode($_SERVER['REQUEST_URI']);
        // список посёлков
        $projects = array(SNV_PROJECT_GORKI, SNV_PROJECT_POKROVSKOE, SNV_PROJECT_POKROVSKOIE_GORKI, SNV_PROJECT_BEREZOVKA);
        // запись в резулть первого элемента - тобишь горки
        $result = array_shift($projects);
        // выбор по url типа проэкта
        foreach ($projects as $project) {
            if (stristr($url, $project) != FALSE) {
                $result = $project;
                break;
            }
        }

        return $result;
    }

    /**
     * функция для определения ид виджета
     */
    function _snv_getWidgetId() {
        $project = _snv_getProject();

        $ids = array(
            SNV_PROJECT_GORKI => 21946362,
            SNV_PROJECT_POKROVSKOE => 37707744,
            SNV_PROJECT_POKROVSKOIE_GORKI => 35744827,
            SNV_PROJECT_BEREZOVKA => 37707743,
        );

        return $ids[$project];
    }

    /**
     * для определния страниц
     */
    function _snv_ispage($pages) {
        // декодируем url
        $url = urldecode($_SERVER['REQUEST_URI']);

        $result = FALSE;
        foreach ($pages as $page) {
            if (stristr($url, $page)) {
                $result = TRUE;
                break;
            }
        }

        return $result;
    }
    ?>

    <script type="text/javascript" src="http://sedu.adhands.ru/js/counter.js"></script>
    <script type="text/javascript">
        var report = new adhandsReport ('http://sedu.adhands.ru/site/');
        report.id('1569');
        report.send();
    </script>
    <noscript>
        <img width="1" height="1" src="http://sedu.adhands.ru/site/?static=on&clid=1569&rnd=1234567890123" style="display:none;">
    </noscript>
</head>
<body>
<div class="page  <? if($_SERVER['REQUEST_URI']=='/') echo 'page-main'; ?>">
    <div class="contacts">
        <div class="contacts-inner">
            <p class="work">Отдел продаж <span>с 9 до 21 без вых.</span></p>
            <p class="tel"><span>(812)</span>900-33-10</p>
            <a href="#zv_popup" rel="popup" class="zakaz">Заказать<br> звонок</a>
            <p class="reklama">Реклама/партнерам</p>
            <p class="tel-second">(812)900-51-10</p>
        </div>
    </div>
    <div class="contacts messege">
        <div class="messege-inner_ clearfix">

            <h3><a href="/projects-pokrovskie-gorki.htm#kv" title="">Квартиры за 980 тыс.р.*</a></h3>
            <p>Только в ноябре <b>отделка в подарок</b>!<br />*при 100% оплате</p>
        </div>
    </div>

    <div class="contacts messege_">
        <div class="messege-inner clearfix">
            <a href="http://snvproject.ru/i/big_houses/presto-big.jpg" rel="popup" title=""> <img src="http://snvproject.ru/i/big_houses/presto-big.jpg" width="100" style="float:left;padding-right: 10px;"  alt="" title="" /> </a>
           <div style="margin-right:10px;"> <h3 style="margin-left:20px"><a href="/cottage-presto.htm"   title="">  Готовый дом 136 м2</a></h3>  </div>
            <p style="line-height:20px;">+коммуникации<br /> +участок 10,5 соток <br />за <b>4,893 млн.р.*</b><br /><br />*при 100% оплате</p>
        </div>
    </div>
    <div class="wrapper">
        <div class="main">
            <div class="head">
                <div class="top-bar">
                    <div class="top-inner">
                        <a class="logo" href="/" title=""><span>Производственно-строительная группа</span></a>
                    </div>
                </div>
                <div class="desc"><img src="images/tx-bg.png" width="561" height="76" alt="" title=""></div>
                <div class="polosa"></div>
            </div>

            <div class="content">
                <ul class="menu clearfix">
                    <li class="curent"><i></i><a href="/projects.htm" title="">Наши проекты</a>
                        <ul class="second-menu">
                            <li class="m01"><a href="#" title="">«Горки-10»</a>
                                <ul class="third-menu <? if(strstr($_SERVER['REQUEST_URI'], 'plan.htm')!='') echo 'ax';
                                    else if (strstr($_SERVER['REQUEST_URI'], 'area.htm')!='')    echo 'ax';
                                    else if (strstr($_SERVER['REQUEST_URI'], 'projects.htm')!='')    echo 'ax';

                                    else if (strstr($_SERVER['REQUEST_URI'], 'serve.htm')!='')    echo 'ax';

                                    else if (strstr($_SERVER['REQUEST_URI'], 'photo.htm')!='')           echo 'ax';
                                    else if (strstr($_SERVER['REQUEST_URI'], 'plan.htm')!='')                    echo 'ax';
                                    else if (strstr($_SERVER['REQUEST_URI'], 'area-i.htm')!='')                    echo 'ax';
                                    else if (strstr($_SERVER['REQUEST_URI'], 'documents-gorki.htm')!='')  echo 'ax';
                                        ?>">
                                    <li><a href="/area.htm" title="">Расположение</a><span>|</span></li>
                                    <li><a href="/projects.htm" title="">Проекты и цены</a><span>|</span></li>
                                    <li><a href="/plan.htm" title="">Генплан</a><span>|</span></li>
                                    <li><a href="/photo.htm" title="">Фотогалерея</a><span>|</span></li>
                                    <li><a href="/documents-gorki.htm" title="">Документы</a><span>|</span></li>
                                    <li><a href="/serv.htm" title="">Акции</a></li>
                                </ul>
                            </li>
                            <li class="m02"><a href="#" title="">«Покровское»</a>
                                <ul class="third-menu <? if(strstr($_SERVER['REQUEST_URI'], 'pokrovskoe')!='') echo 'ax'; ?>">
                                    <li class="pp"><a href="/area-pokrovskoe.htm" title="">Расположение</a><span>|</span></li>
                                    <li><a href="/projects.htm" title="">Проекты и цены</a><span>|</span></li>
                                    <li><a href="/plan-pokrovskoe.htm" title="">Генплан</a><span>|</span></li>
                                    <li><a href="/photo-pokrovskoe.htm" title="">Фотогалерея</a><span>|</span></li>
                                    <li><a href="/documents-pokrovskoe.htm" title="">Документы</a><span>|</span></li>
                                    <li><a href="/serv.htm" title="">Акции</a></li>
                                </ul>
                            </li>
                            <li class="m03"><a href="#" title="">«Березовка»</a>
                                <ul class="third-menu <? if(strstr($_SERVER['REQUEST_URI'], 'berezovka')!='') echo 'ax'; ?>">
                                    <li><a href="/area-berezovka.htm" title="">Расположение</a><span>|</span></li>
                                    <li><a href="/projects.htm" title="">Проекты и цены</a><span>|</span></li>
                                    <li><a href="/plan-berezovka.htm" title="">Генплан</a><span>|</span></li>
                                    <li><a href="/photo-berezovka.htm" title="">Фотогалерея</a><span>|</span></li>
                                    <li><a href="/documents-berezovka.htm" title="">Документы</a><span>|</span></li>
                                    <li><a href="/serv.htm" title="">Акции</a></li>
                                </ul>
                            </li>
                            <li class="last m04"><a href="#" title="">«Покровские горки»</a>
                                <ul class="third-menu <? if(strstr($_SERVER['REQUEST_URI'], 'ie-gorki')!='') echo 'ax'; ?>">
                                    <li><a href="/area-pokrovskie-gorki.htm" title="">Расположение</a><span>|</span></li>
                                    <li><a href="/projects-pokrovskie-gorki.htm" title="">Проекты и цены</a><span>|</span></li>
                                    <li><a href="/plan-pokrovskie-gorki.htm" title="">Генплан</a><span>|</span></li>
                                    <li><a href="/photo-pokrovskie-gorki.htm" title="">Фотогалерея</a><span>|</span></li>
                                    <li><a href="/documents-pokrovskie-gorki.htm" title="">Документы</a><span>|</span></li>
                                    <li><a href="/serv-pokrovskie-gorki.htm" title="">Акции</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="/rassrochka.htm" title="">Финансовые условия</a></li>
                    <li><a href="/company.htm" title="">о компании</a></li>
                    <li><a href="/contacts.htm" title="">Контакты</a></li>
                    <li><a href="/newspaper/" title="">СНВ-Газета</a></li>
                    <li class="last" style=""><a href="/uk-gorki.htm" title="">Управляющая компания</a></li>
                </ul>
                <div class="links  links-second">
                    <ul class="m01">
                        <li>Гатчинский район</li>
                        <li><a   title="">Индивидуальные коттеджи</a></li>
                    </ul>
                    <ul class="m02">
                        <li>Гатчинский район</li>
                        <li><a   title="">Индивидуальные коттеджи</a></li>
                        <li><a   title="">Таунхаусы</a></li>
                        <li><a   title="">Земельные участки</a></li>
                    </ul>
                    <ul class="m03">
                        <li>Всеволожский район</li>
                        <li><a  title="">Индивидуальные коттеджи</a></li>
                        <li><a   title="">Таунхаусы</a></li>
                        <li><a   title="">Земельные участки</a></li>
                    </ul>
                    <ul class="last m04">
                        <li>Гатчинский район</li>
                        <li><a  title="">Таунхаусы</a></li>
                        <li><a   title=""> Квартиры</a></li>
                    </ul>
                </div>
                <div class="text">
                                	<? if($_SERVER[REQUEST_URI]!="/")echo '<h1>'.$h1.'</h1>';   ?>
<!--timer -->
<?php if (_snv_ispage(array('projects-pokrovskie-gorki'))):?>                                  
<div class="timer clearfix" align="center">
  <div class="lb-timer-text">  До повышения цен осталось:</div>
  <div class="lb-timer" lbt_deadline="1354320000" lbt_display="full"></div>
</div>
<?php endif;?>                                