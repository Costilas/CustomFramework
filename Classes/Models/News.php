<?php

namespace Classes\Models;

class News extends Model
{
    public string $id;
    public string $idate;
    public string $title;
    public string $announce;
    public string $content;

    public function getFormattedDate() {
        return date('d.m.Y', $this->idate);
    }
}