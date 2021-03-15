<?if($show):?>


<p class="pages">
    <small>Страница <?=$curPage;?> из <?=$totalPage;?> &nbsp;&nbsp;&nbsp;</small>
    <?if($curPage > 1):?>
    <a href="?<?=setPagePar('page', 1);?>">&laquo;</a>
    <?endif;?>
    <?if($prevPage != ''):?>
    <a href="?<?=setPagePar('page', $prevPage);?>"><?=$prevPage;?></a>
    <?endif;?>
    <span><?=$curPage;?></span>
    <?if($nextPage != ''):?>
    <a href="?<?=setPagePar('page', $nextPage);?>"><?=$nextPage;?></a>
    <?endif;?>
    <?if($curPage < $totalPage):?>
    <a href="?<?=setPagePar('page', $totalPage);?>">&raquo;</a>
    <?endif;?>
</p>



<?endif;?>
