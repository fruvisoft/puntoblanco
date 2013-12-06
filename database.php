<?php

    function get_connection()
    {
        $username = 'root';
        $password = '';
        $hostname = 'localhost';
        $port = '3306';
        $db = "puntoblanco";
    
        if (getenv("VCAP_SERVICES")) // APPFOG
        {
            $services_json = json_decode(getenv("VCAP_SERVICES"),true);
            $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
            $username = $mysql_config["username"];
            $password = $mysql_config["password"];
            $hostname = $mysql_config["hostname"];
            $port = $mysql_config["port"];
            $db = $mysql_config["name"];
        }
        
        $connection = mysql_connect("$hostname:$port", $username, $password);
        mysql_select_db($db, $connection);
        
        return $connection;
    }
    
    function get_user($username)
    {
        $connection = get_connection();
        
        $query = sprintf("SELECT CodPer, ClaPer, CargoPer FROM personal
            WHERE CodPer = '%s'",
            mysql_real_escape_string($username));

        $result = mysql_query($query);
        
        if (!$result)
        {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        
        if (mysql_num_rows($result) != 1)
        {
            return false;
        }
        
        $user = mysql_fetch_assoc($result);
        
        mysql_free_result($result);
        
        mysql_close($connection);
        
        return $user;
    }
    
    function get_tables()
    {
        $connection = get_connection();
        
        $query = "SELECT NumMesa, EstMesa FROM mesa WHERE 1 = 1";
            
        $result = mysql_query($query);
        
        if (!$result)
        {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        
        $tables = array();
        
        while ($table = mysql_fetch_assoc($result))
            array_push($tables, $table);
        
        mysql_free_result($result);
        
        mysql_close($connection);
        
        return $tables;
    }
    
    function get_comanda($table)
    {
        $connection = get_connection();
        
        $query = sprintf("SELECT NumCom, CodPer FROM comanda
            WHERE NumMesa = '%s'",
            mysql_real_escape_string($table));
            
        $result = mysql_query($query);
        
        if (!$result)
        {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        
        if (mysql_num_rows($result) != 1)
        {
            return false;
        }
        
        $comanda = mysql_fetch_assoc($result);
        
        mysql_free_result($result);
        
        mysql_close($connection);
        
        return $comanda;
    }
    
    function get_order($table)
    {
        $comanda = get_comanda($table);
        
        if (!$comanda)
            return false;
        
        $connection = get_connection();
        
        $query = sprintf("SELECT NomPro, Cant, PrecioPro
            FROM `detallecomanda`
            JOIN `producto` ON `detallecomanda`.`CodPro` = `producto`.`CodPro`
            WHERE `detallecomanda`.`NumCom` = '%s'",
            mysql_real_escape_string($comanda['NumCom']));
            
        $result = mysql_query($query);
        
        $order = array();
        
        while ($producto = mysql_fetch_assoc($result))
            array_push($order, $producto);
        
        mysql_free_result($result);
        
        mysql_close($connection);
        
        return $order;
    }
    
    function get_groups()
    {
        $connection = get_connection();
        
        $query = "SELECT CodGru, NomGru FROM grupoproducto WHERE 1 = 1";
            
        $result = mysql_query($query);
        
        if (!$result)
        {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        
        $groups = array();
        
        while ($group = mysql_fetch_assoc($result))
            array_push($groups, $group);
        
        mysql_free_result($result);
        
        mysql_close($connection);
        
        return $groups;
    }

    function get_plates_by_group($group)
    {
        $connection = get_connection();
        
        $query = sprintf("SELECT CodPro, NomPro, PrecioPro FROM producto
            WHERE CodGru = '%s'",
            mysql_real_escape_string($group));
            
        $result = mysql_query($query);
        
        if (!$result)
        {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        
        $plates = array();
        
        while ($plate = mysql_fetch_assoc($result))
            array_push($plates, $plate);
        
        mysql_free_result($result);
        
        mysql_close($connection);
        
        return $plates;
    }
    
    function add_order($table, $order)
    {
        // TO DO
    }
