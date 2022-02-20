<?php

namespace App;

class DB
{

    /** @var DB */
    private static $instance;

    /** @var \PDO  */
    protected $connection;


    private function __construct()
    {
        try {
            // todo read connections data from file
            $this->connection = new \PDO('mysql:host=mysql;dbname=school', 'root', '123456');
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $exception) {
            print_r($exception);
            http_response_code(500);
            echo "Can't connect to DB.";
            die;
        }
    }

    /**
     * Returns instance of static
     *
     * @return DB
     */
    public static function getInstance(): DB
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Returns Connected PDO instance
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    /**
     * @param string $query
     * @param array $params
     * @return \PDOStatement
     */
    public static function getQueryStatement(string $query, array $params = []): \PDOStatement
    {
        $statement = static::getInstance()->getStatement($query);

        if (!$statement) {
            throw new \UnexpectedValueException('Sql Statement is false.');
        }

        foreach ($params as $key => $value) {
            $statement->bindParam($key, $value);
        }

        $statement->execute();

        return $statement;
    }

    /**
     * @param string $query
     * @return false|\PDOStatement
     */
    public function getStatement(string $query)
    {
        return static::$instance->connection->prepare($query);
    }
}