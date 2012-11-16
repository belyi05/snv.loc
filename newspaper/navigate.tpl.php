<?php
/**
 * Template navigate
 *
 * by Lastbyte 
 * last modified 03/05/2012 - 18:00
 */
?>
  <div id="newspaper-navigate-container-pseudo"></div>
  <div id="newspaper-navigate-container" align="center">
    <!-- навигация номера -->
    <div id="newspaper-navigate" align="center">
      <?php if ($prev):?><a class="newspaper-navigate-link" href="<?php print $prev;?>" title="предыдущая"><div class="newspaper-navigate-arr prev">&#8592;</div></a><?php endif;?>
      <?php if ($next):?><a class="newspaper-navigate-link" href="<?php print $next;?>" title="следующая"><div class="newspaper-navigate-arr next">&#8594;</div></a><?php endif;?>
      <div id="newspaper-navigate-content" align="center">
        <!-- подписка и скчаать -->
        <div class="newspaper-navigate-action">
          <a class="newspaper-navigate-action-link" href="<?php print $home_url;?>">на главную</a>
          <a class="newspaper-navigate-action-link" href="<?php print $subscribe_url;?>">подписаться на газету</a>
          <?php if (!empty($download)): ?>
            <p class="newspaper-navigate-action-link">скачать:</p>
            <?php foreach ($download as $ext => $link):?>
              <a class="newspaper-navigate-action-link" href="<?php print $link;?>"><?php print $ext;?></a>
            <?php endforeach;?>
          <?php endif;?>
        </div>
        <!-- навигация по выпускам -->
        <div id="newspaper-navigate-number" align="center">
          <a class="newspaper-navigate-number-link" href="<?php print $number_url['first'];?>" title="первый">первый</a>
          <a class="newspaper-navigate-number-link" href="<?php print $number_url['prev'];?>" title="предедущий">&#8592;</a>
          <p class="newspaper-navigate-number-link">Выпуск: <?php print $id;?></p>
          <a class="newspaper-navigate-number-link" href="<?php print $number_url['next'];?>" title="следующий">&#8594;</a>
          <a class="newspaper-navigate-number-link" href="<?php print $number_url['last'];?>" title="последний">последний</a>
        </div>        
      </div>
    </div>
  </div>