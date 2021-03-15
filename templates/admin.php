<?php if($_SESSION['is_admin'] == '1'):?>
    <div id="result"></div>
    <form id="news_form" method="post" enctype="multipart/form-data">
        <p class="fn">Пожалуйста, добавьте новость и нажмите "отправить".</p>
        Заголовок:<br> <input id="title" type="text" name="title" /><br>
        Краткое содержание:<br> <textarea id="prev" rows="10" cols="45" name="prev"></textarea><br>
        Детальное описание:<br> <textarea id="det" rows="10" cols="45" name="det"></textarea><br>
        Категория:<br> <input id="kat" type="text" name="kat" /><br>
        Изображение к новости:<br> <input id="file" type="file" name="user_file"/><br>
        <input type="button" name="otp" id="an" value="Отправить" class="send button"/>
    </form>
    <div id="add_news">

        <div id="addHistory">
            <p>ПОСЛЕДНИЕ ДОБАВЛЕННЫЕ НОВОСТИ:</p>
            <?=$contAdd;?>
        </div>

    </div>
<?php else:?>
<form method="post">
    <p>Пожалуйста, авторизируйтесь для продолжения работы.</p>
    Login: <input type="text" name="login" /><br>
    Passwprd: <input type="password" name="pass" /><br>
    <input type="submit" value="Login" />
</form>
<?php endif?>