<?php

trait OTS_DB_PDOQuery
{
    /**
     * @param string|null $query
     * @param int|null $fetchMode
     * @param mixed ...$fetchModeArgs
     * @return PDOStatement
     */
    public function query(?string $query = null, ?int $fetchMode = null, mixed ...$fetchModeArgs): PDOStatement
    {
        return $this->doQuery($query, $fetchMode, ...$fetchModeArgs);
    }
}
