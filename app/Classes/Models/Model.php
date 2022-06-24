<?php

namespace Classes\Models;

use Classes\ORM\Orm;
use Classes\Services\Paginator;

abstract class Model
{
    static protected Orm $orm;

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->fillEmptyObject($data);
        }

        return $this;
    }

    static public function find(int $id): Model
    {
        return static::getStaticORM()->find($id, get_called_class());
    }

    static public function findAll(): array
    {
        return static::getStaticORM()->findAll(get_called_class());
    }

    public function save()
    {
        return static::getStaticORM()->save($this, get_called_class());
    }

    static public function remove(int $id): bool
    {
        return static::getStaticORM()->remove($id, get_called_class());
    }

    static public function paginate(int $perPage, int|null $currentPage, array $orderBy){
        $currentPage = $currentPage ?? 1;
        $className = get_called_class();

        $count = static::getStaticORM()->count($className);
        $models =  static::getStaticORM()->paginate($className, $perPage, $currentPage, $orderBy);
        return new Paginator($models, $count, $perPage, $currentPage);

    }

    private function fillEmptyObject(array $data): void
    {
        foreach ($data as $attribute => $value) {
            $this->$attribute = $value;
        }
    }

    private static function getStaticORM(): object
    {
        static::setStaticORM();
        return static::$orm;
    }

    private static function setStaticORM():void
    {
        static::$orm = new Orm();
    }
}