<?php

namespace Src\Database\Eloquent;

use Src\Contracts\Database\Eloquent\Drivers\Driver;

use Src\Database\Eloquent\Mysql\Delete\Delete;
use Src\Database\Eloquent\Mysql\Insert\Insert;
use Src\Database\Eloquent\Mysql\Select\Select;
use Src\Database\Eloquent\Mysql\Update\Update;

use Src\Database\Eloquent\Mysql\Mysql;


class Model
{
    private string $Table = '';

    private Driver $Driver;

    //Set model tabel
    protected function setTable(string $Table): void
    {
        $this->Table = strtolower(explode('\\', $Table)[count(explode('\\', $Table)) - 1]);

        $this->Model();
    }

    private function Model()
    {
        switch (env("DB_CONNECTION"))
        {
            case ("mysql"):
                $this->Driver = new Mysql($this->Table);
        }
    }





    /**
     * Select fields from database
     *
     * @param  array $Fields Fields for select
     * @return Select
     */
    public function select(array $Fields = ['*']): Select
    {
        $Select = $this->Driver->Select($Fields);
        return $Select;
    }





    /**
     * Insert data to database
     *
     * @return Insert
     */
    public function insert(): Insert
    {
        $Insert = $this->Driver->Insert($this->Table);
        return $Insert;
    }





    /**
     * Update field in database
     *
     * @return Update
     */
    public function update(): Update
    {
        $Update = $this->Driver->Update($this->Table);
        return $Update;
    }





    /**
     * Delete field from database
     *
     * @return Delete
     */
    public function delete(): Delete
    {
        $Delete = $this->Driver->Delete($this->Table);
        return $Delete;
    }
}
