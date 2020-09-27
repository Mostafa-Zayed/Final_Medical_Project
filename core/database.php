<?php
// Create Connection
$connection = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
/**
 * 
 */
function get_data(string $table_name, string $where = '', string $columns = '*', $limit = ''): array
{
    global $connection;
    $columns = strip_tags($columns);
    $table_name = strip_tags($table_name);
    if ($columns !== '*') {
        $columns = get_columns_name($table_name, $columns);
    }
    $where = strip_tags($where);
    if (! empty($limit)) {
        $limit = (int) $limit;
        $sql = sprintf("SELECT %s FROM `%s` %s LIMIT %d", $columns, $table_name, $where, $limit);
    } else {
        $sql = sprintf("SELECT %s FROM `%s` %s", $columns, $table_name, $where);
    }
    //return $sql;
    $result = @mysqli_query($connection, $sql);
    if (!$result) {
        return array();
    }
    $data = @mysqli_fetch_all($result,MYSQLI_ASSOC);
    @mysqli_free_result($result);
    return $data;
}

/**
 * 
 */
function get_data_by_id(string $table_name, int $id, $columns = '*'): array
{
    $id = (int) $id;
    if ($id == 0) {
        return array();
    }
    $id = "where ".get_columns_name($table_name,$columns)." = $id";
    return get_data($table_name, $id, $columns);    
}

function get_data_by_column(){}
/**
 * 
 */
function insert_into_table(string $table_name, array $data): bool
{
    global $connection;
    $table_name = @mysqli_real_escape_string($connection, strip_tags($table_name));
    $columns = '';
    $values = '';
    foreach ($data as $key => $value) {
        $columns .= "`$key`,";
        $values .= "'$value',";
    }
    $columns = rtrim($columns, ',');
    $values = rtrim($values, ',');
    $sql = sprintf("INSERT INTO `%s` (%s) VALUES (%s)", $table_name, $columns, $values);
    $result = mysqli_query($connection, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/**
 * 
 */
function delete_by_id(string $table_name, int $id): bool
{
    global $connection;
    $id = (int) $id;
    if ($id == 0) {
        return false;
    }
    $table_name = @mysqli_real_escape_string($connection, strip_tags($table_name));
    $data = get_data_by_id($table_name, $id,'id');
    @mysqli_free_result($data);
    if (empty($data)) {
        return false;
    }
    $column_name = get_column_name($table_name);
    $sql = sprintf("DELETE FROM `%s` WHERE `%s_id` = %d", $table_name, $column_name, $id);
    $result = mysqli_query($connection, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/**
 * 
 */
function get_column_name(string $table_name): string
{
    $last_3char = substr($table_name, -3);
    $last_char = substr($table_name, -1);
    if ($last_3char === 'ies') {
        $column_name = rtrim($table_name, 'ies');
        $column_name .=  'y';
        return $column_name;
    } elseif ($last_char === 's') {
        $column_name = rtrim($table_name, 's');
        return $column_name;
    }
    
}

/**
 * 
 */
function get_columns_name(string $table_name, string $columns): string
{
    $data = '';
    $columns = explode(',', $columns);
    foreach ($columns as $column) {
        $data .= "`".get_column_name($table_name)."_$column`,";
    }
    $data = trim($data, ',');
    return $data;
}




function medical_get_all(string $table): array
{
    global $connection;
    $data = array();
    $table = strip_tags($table);
    $sql = "SELECT * FROM `{$table}`";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        array_push($data,$row);
    }
    return $data;
}


function get_one(string $table, string $where): array
{
    global $connection;
    $sql = "SELECT * FROM `{$table}` where {$where} LIMIT 1";
    $result = mysqli_query($connection, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return [];
    }  
}

function medical_update(string $table, array $data, string $where): bool
{
    global $connection;
    $parts = '';
    foreach ($data as $key => $value){
        $parts .= "`".$key."` = '$value' ,";
    }
    $parts = rtrim($parts, ',');
    $sql = "UPDATE `{$table}` SET  $parts WHERE {$where}";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function medical_delete_one(string $table, $where): bool
{
    global $connection;
    $sql = "DELETE FROM `{$table}` WHERE {$where}";
    return mysqli_query($connection, $sql);
}

function get_table_count(string $table)
{
    global $connection;
    $sql = "SELECT COUNT(*) AS rows_count FROM `{$table}`";
    $result = mysqli_query($connection, $sql);
    return mysqli_fetch_assoc($result)['rows_count'];
}

function get_table_count_where(string $table, string $where)
{
    global $connection;
    $sql = "SELECT COUNT(*) AS rows_count FROM `{$table}` WHERE $where";
    return $sql;
    $result = mysqli_query($connection, $sql);
    return mysqli_fetch_assoc($result)['rows_count'];
}

function get_data_join(array $tables_name, $where)
{
   global $connection;
   $count = count($tables_name);
   $sql = "SELECT * FROM ";
   for($i = 0; $i < $count; $i++) {
       $sql .= "`$tables_name[$i]` ";
       if ($i < $count -1 ) {
           $sql .= " INNER JOIN ";
       }
   }
   $sql .= "ON $where ";
   //echo $sql;
   $result = @mysqli_query($connection, $sql);
    if (!$result) {
        return array();
    }
    $data = @mysqli_fetch_all($result,MYSQLI_ASSOC);
    @mysqli_free_result($result);
    return $data;
}
?>