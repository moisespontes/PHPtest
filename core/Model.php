<?php

namespace Core;

use Core\Conn;

class Model
{
    protected $data;
    protected $query;
    protected $params;
    protected $fail;
    protected static $entity;

    /**
     * Model Constructor.
     */
    public function __construct(string $entity)
    {
        self::$entity = $entity;
    }

    public function __set($name, $value)
    {
        if (empty($this->data)) {
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    public function __get($name)
    {
        return ($this->data->$name ?? null);
    }

    /**
     * @return object|null
     */
    public function data(): ?object
    {
        return $this->data;
    }

    /**
     * @return \PDOException
     */
    public function fail(): ?\PDOException
    {
        return $this->fail;
    }

    /**
     * Método de busca
     *
     * @param string|null $terms
     * @param string|null $params
     * @param string $columns
     * @return Model|mixed
     */
    public function find(?string $terms = null, ?string $params = null, string $columns = "*")
    {
        if ($terms) {
            $this->query = "SELECT {$columns} FROM " . static::$entity . " WHERE {$terms}";
            parse_str($params, $this->params);
            return $this;
        }

        $this->query = "SELECT {$columns} FROM " . static::$entity;
        return $this;
    }

    /**
     * Método para leitura de dados
     *
     * @param boolean $all
     * @return Model|null
     */
    public function fetch(bool $all = false)
    {
        try {
            $stmt = Conn::getConn()->prepare($this->query);
            $stmt->execute($this->params);

            if (!$stmt->rowCount()) {
                return null;
            }

            if ($all) {
                return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
            }

            return $stmt->fetchObject(static::class);
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }

    /**
     * Método para cadastro de dados
     *
     * @param array $data
     * @return integer|null
     */
    protected function create(array $data): ?int
    {
        try {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $query = "INSERT INTO " . static::$entity . " ({$columns}) VALUES ({$values})";

            $stmt = Conn::getConn()->prepare($query);
            $stmt->execute($data);

            return Conn::getConn()->lastInsertId();
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }
}
