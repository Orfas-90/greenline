    <?if(!empty($arSupp)):?>
        <?foreach($arSupp as $supp):?>
        <div class="article">
          <h2><?=$supp['name'];?></h2>
          <div class="clr"></div>
          <p><strong><?=$supp['title'];?></strong></p>
          <p><?=$supp['text'];?></p>
        </div>
        <?endforeach;?>
    <?else:?>
        <p>Информации пока нет.</p>
    <?endif;?>
