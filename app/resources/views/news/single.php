<?php \Classes\View\Presenter::render('interface/header', compact('title'));?>
<div class="wrapper">
    <div class="news_block">
        <div class="title_block">
            <h1><?= $article->title ?></h1>
        </div>
        <div class="articles_block">
            <div class="article">
                <?= $article->content ?>
            </div>
        </div>
        <a href="/">Все новости >></a>
    </div>
</div>
<?php \Classes\View\Presenter::render('interface/footer'); ?>
