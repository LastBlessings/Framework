<?php

class X_Base
{
    private $file, $last_error, $query, $last_query, $last_insert_id;

    public function __construct($config_file)
    {
        $this->x_Base($config_file);
		  return;
    }

    public function __destruct()
    {
        unset($this->file, $this->last_error, $this->query, $this->last_query, $this->last_insert_id);
		  return;
    }

    public function X_Base($config_file)
    {

        $this->file = $config_file;
        $this->connectToDatabase();
		  return;
    }

    private function connectToDatabase()
    {
        include_once $this->file;

        $db = $db ['default'];

        mysql_connect($db ['host'], $db ['username'], $db ['password']);
        mysql_select_db($db ['database']);
		  return;
    }

    public function print_last_error()
    {
        echo $this->last_error;
		  return;
    }

    public function last_query()
    {
        return $this->last_query;
    }

    public function get($table)
    {

        $this->query = '';

        $table = mysql_real_escape_string($table);

        $this->query .= "SELECT * FROM `{$table}`;";

        return $this;
    }

    public function select($columns = '*')
    {

        $this->query = '';

        if ($columns === '*') {
            $cols = '*';
        } else {
            if (is_string($columns)) {
                $columns = explode(',', $columns);
            }

            if (is_array($columns)) {
                foreach ($columns as $c) {
                    $c = str_replace(' ', '', $c);
                    $cols .= "`{$c}`, ";
                }
            }
            $cols = substr($cols, 0, -2);
        }

        $this->query .= "SELECT {$cols}";
        return $this;
    }

    public function from($table)
    {
        $string = " FROM {$table}";

        $this->query .= $string;

        return $this;
    }

    public function where($params, $param2 = NULL)
    {
        $wheres = '';
        //(array('id' => '5',...))
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                $wheres .= "`{$key}` = '{$value}' AND ";
            }
            $wheres = substr($wheres, 0, -4);
        }
        //("id", "5")
        if (is_string($params) && ($param2 != NULL)) {
            $wheres = "{$params} = '{$param2}'";
        }
        // "id=5"
        if (is_string($params) && ($param2 == NULL)) {
            $wheres = $params;
        }

        $this->query .= " WHERE {$wheres}";

        return $this;
    }

    public function xxx($params)
    {
		return;
    }

    public function sql($query)
    {
        $this->query .= $query;
        return $this;
    }

    public function insert_into($table, $data)
    {
        $table = "`{$table}`";

        $fields = '';
        $values = '';
        foreach ($data as $key => $value) {
            $fields .= "`$key`,";
            $values .= "'$value',";
        }

        $fields = substr($fields, 0, -1);
        $values = substr($values, 0, -1);

        $this->query = "INSERT INTO `{$table}` (`{$fields}`) VALUES (`{$values}`)";

        return $this;
    }

    public function update($table, $data)
    {
        $table = "`$table`";

        $set = "";
        foreach ($data as $key => $value) {
            $set .= "`$key` = '$value',";
        }

        $set = substr($set, 0, -1);

        $this->query = "UPDATE $table SET $set";

        return $this;
    }

    public function last_insert_id()
    {
        return $this->last_insert_id;
    }

    public function delete_from($table)
    {

        $this->query = "DELETE FROM `$table`";

        return $this;
    }

    public function execute()
    {
        mysql_query($this->query);
        $this->last_insert_id = mysql_insert_id();
        $this->last_query = $this->query;
        $this->query = '';
        return;
    }

    public function fetch_object()
    {
        $query = mysql_query($this->query);

        $return = array();

        while ($result = @mysql_fetch_object($query)) {
            $return [] = $result;
        }

        $this->last_query = $this->query;
        $this->query = "";

        return $return;
    }

    public function stripslashes_deep(&$array)
    { //TODO:
        $return = array();
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $this->stripslashes_deep($v);
            } else {
                stripslashes($v);
            }
        }

		 return;
    }
}