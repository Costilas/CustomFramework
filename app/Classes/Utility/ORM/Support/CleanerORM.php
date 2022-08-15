<?php

namespace Classes\Utility\ORM\Support;

use ICanBoogie\Inflector;

class CleanerORM
{
    static function initTableName(string $className, string|null $modelAssignedTable = null):string
    {
        return $modelAssignedTable ?? self::prepareTableName($className);
    }

    static private function prepareTableName(string $className): string
    {
        $inflector = Inflector::get('en');
        $result = self::cleanClassName(strtolower($className));

        return $inflector->pluralize($result);
    }

    static private function cleanClassName(string $className): string
    {
        $array = explode('\\', $className);

        return array_pop($array);
    }
}