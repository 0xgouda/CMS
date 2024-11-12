<?php
namespace Src;
class Sql {
    private string $sqlstmt = "";

    private bool $WhereExists = false;
    private array $preparedFileds = [];
    public function read($tableName) {
        $this->sqlstmt = "SELECT * FROM $tableName";
    }

    public function update($tableName, $fieldName, $fieldValue) {
        $this->sqlstmt = "UPDATE $tableName SET $fieldName = ?";
        $this->preparedFileds[] = $fieldValue;
    }

    public function addCondition($fieldName, $fieldValue): bool {
        if ($this->sqlstmt) {
            if (!$this->WhereExists) {
                $this->sqlstmt .= " WHERE ";
                $this->WhereExists = true;
            } else {
                $this->sqlstmt .= " AND ";
            }

            $this->preparedFileds[] = $fieldValue;
            $this->sqlstmt .= " $fieldName = ? ";

            return True;
        }
        echo $this->sqlstmt;
        return False;
    }

    public function prepare($dbc) {
        return $dbc->prepare($this->sqlstmt);
    }

    public function execute($stmt) {
        return $stmt->execute($this->preparedFileds);
    }
}