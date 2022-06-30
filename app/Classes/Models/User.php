<?php

namespace Classes\Models;

class User extends Model
{
    public function toJSON():string {
        return json_encode($this);
    }
}