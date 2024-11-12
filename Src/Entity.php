<?php 
namespace Src;

#[\AllowDynamicProperties()]

abstract class Entity {
    protected \PDO $dbc;
    protected $fields = [];
    abstract protected function initFields();
    protected string $tableName;
    protected array $primaryKeys = ['id'];

    public function __construct($tableName) {
        $this->dbc = DataBaseConnection::getConnection();
        $this->tableName = $tableName;
        $this->initFields();
    }

    abstract public function updateCondition(): bool;

    private function JoinArray($fields): string {
        $fieldsArr = [];
        foreach ($fields as $fieldName) {
            $fieldsArr[$fieldName] = " $fieldName = :$fieldName ";
        }
        $fieldsString = join(',', $fieldsArr);
        return $fieldsString;
    }

    public function save(): bool {
        if (!$this->updateCondition()) return false;

        $fieldsString = $this->JoinArray($this->fields);
        $keysString = $this->JoinArray($this->primaryKeys);

        $sql = "UPDATE $this->tableName SET $fieldsString WHERE $keysString";

        $preparedValues = [];
        foreach($this->fields as $filedName) {
            $preparedValues[$filedName] = $this->$filedName;
        }

        foreach($this->primaryKeys as $key) {
            $preparedValues[$key] = $this->$key;
        }
        
        try {
            $this->dbc->beginTransaction();
            $stmt = $this->dbc->prepare($sql);
            $stmt->execute($preparedValues);
            $this->dbc->commit();
        } catch (\Throwable $e) {
            echo $e->getMessage();
            if ($this->dbc->inTransaction()) {
                $this->dbc->rollback();
            }
            return false;
        }
        return true;
    }

    public function findBy($fieldName, $fieldValue): ?object
    {
        $result = $this->find($fieldName, $fieldValue);

        if ($result && $result[0]) {
            $this->setValues($result[0]);
            return $this;
        }

        return NULL;
    }

    public function findAll(): array {
        $allData = $this->find();

        $results = [];
        $className = static::class;
        foreach ($allData as $Data) {
            $object = new $className();
            $object->setValues($Data, $object);
            $results[] = $object;
        }
        return $results;
    }

    private function find($fieldName = '', $fieldValue = ''): array {
        $sql = new Sql;
        $sql->read($this->tableName);
        if ($fieldName) {
            $sql->addCondition($fieldName, $fieldValue);
        }

        $stmt = $sql->prepare($this->dbc);
        $sql->execute($stmt);

        return $stmt->fetchAll();
    }

    public function setValues($values, $object = null) {
        if ($object === null) $object = $this;
        
        foreach ($object->fields as $fieldName) {
            if (isset($values[$fieldName])) {
                $object->$fieldName = $values[$fieldName];
            }
        }

        foreach ($object->primaryKeys as $keyName) {
            if (isset($values[$keyName])) {
                $object->$keyName = $values[$keyName];
            }
        }
    }
}