<?php \Classes\Utility\Facades\View\View::render('interface/header', ['title' => 'Поиск пользователей']);?>

    <div class="wrapper">
        <div class="user_block">
            <form action="<?= '/user/create' ?>" method="post">

            </form>
        </div>
    </div>

<?php \Classes\Utility\Facades\View\View::render('interface/footer');?>