<?php
namespace Core\Engine\Database;
use SQLite3;

class MySQLite extends SQLite3 {
    function __construct() {
        $this->open("messages.db");
    }
}
