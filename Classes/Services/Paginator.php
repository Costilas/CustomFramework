<?php

namespace Classes\Services;

class Paginator
{

    //$total - общее количество записей
    //$limit - количество записей на страницу
    //$currentPage - текущая страница

    //Ключ для GET, в который пишется номер страницы
    private string $index = 'page';

    //Общее число страниц
    private int $amount;

    //Ссылок навигации на страницу
    private int $max = 300;


    public function __construct(private array $items, private int $total, private int $limit, int $currentPage)
    {
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    public function items(): array {
        return $this->items;
    }

    public function links(): string
    {
        $links = null;
        $limits = $this->limits();
        $html = '<ul class="pagination">';

        for ($page = $limits['start']; $page <= $limits['end']; $page++) {
            $links .= $page == $this->current_page
                ? '<a class="active" href=""><li>' . $page . '</li></a>'
                : $this->generateHtml($page);
        }

        if (!is_null($links)) {
            # Если текущая страница не первая
            if ($this->current_page > 1)
                # Создаём ссылку "На первую"
                $links = $this->generateHtml(1, '&lt;') . $links;

            # Если текущая страница не первая
            if ($this->current_page < $this->amount)
                # Создаём ссылку "На последнюю"
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= $links . '</ul>';

        return $html;
    }

    private function generateHtml($page, $text = null): string
    {
        $text = $text ?? $page;
        $currentURI = strtok($_SERVER['REQUEST_URI'], '?');

        return '<a href="' . $currentURI . '?' . $this->index . '=' . $page . '"><li>' . $text . '</li></a>';
    }

    private function limits(): array
    {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0
            ? $left
            : 1;

        if ($start + $this->max <= $this->amount)
            $end = $start > 1
                ? $start + $this->max
                : $this->max;
        else {
            $end = $this->amount;
            $start = ($this->amount - $this->max) > 0
                ? $this->amount - $this->max
                : 1;
        }

        return ['start' => $start, 'end' => $end];
    }

    private function setCurrentPage($currentPage): void
    {
        $parameterToSet = $currentPage > 0
            ? $currentPage
            : 1;

        $parameterToSet = $parameterToSet > $this->amount
            ? $this->amount
            : $parameterToSet;

        $this->current_page = $parameterToSet;
    }


    private function amount(): int
    {
        return round($this->total / $this->limit);
    }
}