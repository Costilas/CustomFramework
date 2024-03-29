<?php

namespace Classes\Utility\ORM;

use Classes\Utility\Database\Db;
use Classes\Models\Model;
use Classes\Utility\ORM\Support\CleanerORM;
use Classes\Utility\ORM\Support\QueryORM;

class Orm
{
    private Db $db;

    public function __construct(private string|null $modelAssignedTable)
    {
        $this->db = new Db();
    }

    public function find(int $id, string $className): Model|null
    {
        $table = CleanerORM::initTableName($className, $this->modelAssignedTable);
        $sql = QueryORM::formFindQuery($table);

        $statement = $this->db->pdo->prepare($sql);
        $statement->execute([$id]);
        $result = $statement->fetch();
        $statement->closeCursor();

        if (!empty($result)) {
            return new $className($result);
        }
        return null;
    }

    public function findAll(string $className): array
    {
        $table = CleanerORM::initTableName($className, $this->modelAssignedTable);
        $sql = QueryORM::formFindAllQuery($table);
        $result = [];

        $statement = $this->db->pdo->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();


        if (!empty($rows)) {
            foreach ($rows as $row) {
                $result[] = new $className($row);
            }
        }

        return $result;
    }

    public function save(Model $model, string $className): bool
    {
        if (isset($model->id)) {
            return $this->update($model, $className);
        }
        return $this->create($model, $className);
    }

    public function remove(int $id, string $className): bool
    {
        $table = CleanerORM::initTableName($className, $this->modelAssignedTable);
        $sql = QueryORM::formRemoveQuery($table, $id);

        return $this->db->pdo->exec($sql);
    }

    public function create(Model $model, string $className): bool
    {
        $table = CleanerORM::initTableName($className, $this->modelAssignedTable);
        $sql = QueryORM::formCreateQuery($model, $table);

        $this->db->pdo->prepare($sql)->execute();
        $model->id = $this->db->pdo->lastInsertId();

        if ($this->db->pdo->lastInsertId()) {
            return true;
        }
        return false;
    }

    public function update(Model $model, string $className): bool
    {
        $table = CleanerORM::initTableName($className, $this->modelAssignedTable);
        $query = QueryORM::formUpdateQuery($model, $table);

        $statement = $this->db->pdo->prepare($query['sql']);
        $statement->execute($query['data']);
        $status = $statement->errorInfo();
        return ($status[0] === "00000");
    }

    public function paginate(string $className, int $perPage, int|null $currentPage, array $orderBy):array {
        $currentPage = $currentPage ?? 1;
        $table = CleanerORM::initTableName($className, $this->modelAssignedTable);
        $query = QueryORM::formPaginateQuery($table, $perPage, $currentPage, $orderBy);

        $statement = $this->db->pdo->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $result = [];
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $result[] = new $className($row);
            }
        }

        return $result;
    }

    public function count(string $className) {
        $table = CleanerORM::initTableName($className, $this->modelAssignedTable);
        $query = QueryORM::formCountQuery($table);

        $statement = $this->db->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        return array_pop($result);
    }

}