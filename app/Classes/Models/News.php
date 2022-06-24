<?php

namespace Classes\Models;

class News extends Model
{
    public function getFormattedDate() {
        return date('d.m.Y', $this->idate);
    }
}