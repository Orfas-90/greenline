<?php
//pr($arComments);
if(!empty($arComments)):

?>
<?php foreach ($arComments as $comments):?>
<div class="clr"></div>
<div class="comment"> <a href="#"><img src="images/userpic.gif" width="40" height="40" alt="" class="userpic" /></a>
    <p><a href="#"><?=$comments['author']?></a> Says:<br />
        <?=$comments['date']?></p>
    <p><?=$comments['text']?></p>
</div>
<?php endforeach;?>

<?php else:?>

<p>Комментариев пока нет</p>

<?php endif;?>