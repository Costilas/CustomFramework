<?php \Classes\Utility\Facades\View\View::render('interface/header', compact('title'));?>
<div class="wrapper">
    <div class="news_block">
        <div class="title_block">
            <h1>Новости</h1>
        </div>
        <div class="articles_block">
            <?php foreach ($news->items() as $article) { ?>

                <div class="article">
                    <div class="article_header">
                        <div class="article_date">
                            <?=$article->getFormattedDate();?>
                        </div>
                        <a href="/article/<?= $article->id ?>">
                            <?= $article->title ?>
                        </a>
                    </div>
                    <?= $article->announce ?>
                </div>

            <?php } ?>
        </div>
        <p> Страницы: </p>
        <div class="pagintion_block">
            <?= $news->links() ?>
        </div>
    </div>
</div>
<?php \Classes\Utility\Facades\View\View::render('interface/footer');?>
