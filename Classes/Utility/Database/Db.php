<?php

namespace Classes\Utility\Database;

use PDO;

class Db
{
    public ?PDO $pdo;

    public function __construct()
    {
        $credentials = $this->getCredentials();
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($this->formAuth($credentials), $credentials['database']['username'], $credentials['database']['password'], $opt);

        return $this;
    }

    private function getCredentials()
    {
        return [
            'database' => [
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
                'host' => $_ENV['DB_HOST'],
                'port' => $_ENV['DB_PORT'],
                'driver' => $_ENV['DB_DRIVER'],
                'db' => $_ENV['DB_NAME']
            ]
        ];
    }

    private function formAuth(array $credentials): string
    {
        return $credentials['database']['driver'] .
            ':host=' . $credentials['database']['host'] .
            ((!empty($credentials['database']['port'])) ? (';port=' . $credentials['database']['port']) : '') .
            ';dbname=' . $credentials['database']['db'];
    }


}