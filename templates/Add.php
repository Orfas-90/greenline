<?php
//pr($arAdd);
if(!empty($arAdd)):
?>
    <?php foreach ($arAdd as $add):?>
    <div class="fl">
    <p><?=$add['date']?></p>
    <p><?=$add['title']?></p>
    <p><?=$add['preview_text']?></p>
    </div>
<?php endforeach;?>

<?php else:?>

    <p>Новости пока не добавлены</p>

<?php endif;?>