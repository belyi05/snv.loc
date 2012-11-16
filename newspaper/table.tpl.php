  <!-- список подписчиков -->
  <?php if (!empty($title)):?><span><?php print $title;?></span><?php endif;?><br />
  <span><?php print $page * $limit +  count($data)?> из <?php print $end;?></span>

  <table cellpadding="0" cellspacing="0">
    <?php if (!empty($headers)):?>
      <tr>
        <?php foreach ($headers as $name):?>
          <th><?php print $name;?></th>
        <?php endforeach;?>
      </tr>
    <?php endif;?>
  
  <!-- подписчики -->
  <?php if (!empty($data)):?>
    <?php $count = 0;?>
    <?php foreach ($data as $member):?>
      <tr class="<?php print ($count % 2 == 0? 'odd': 'even');?>">
        <?php foreach ($member as $cell):?>
          <td><p><?php print $cell;?></p></td>
        <?php endforeach;?>
      </tr>
      <?php $count++;?>
    <?php endforeach;?>
  <?php endif;?>
  </table>
  <p>
    <?php if (!empty($prev_url)):?><a href="<?php print $prev_url;?>">передедущая</a><?php endif;?>
    <?php if (!empty($next_url)):?><a href="<?php print $next_url;?>">следующая</a><?php endif;?>
  </p>  
  