<?php \Classes\Utility\Facades\View\View::render('interface/header', ['title' => 'Поиск пользователей']);?>

<div class="wrapper">
    <div class="user_block">
        <div class="user_info" id="user_info">
            <!-- Для данных пользователя через AJAX -->
        </div>
        <label for="user_id"></label>
        <input id="user_id" type="number">
        <button id="start_search" type="button">Найти</button>
    </div>
</div>

<?php \Classes\Utility\Facades\View\View::render('interface/footer');?>
