<?php
namespace Infrastructure\Persistence;

use Medoo\Medoo;
use PDO;

class SqliteDatabase implements DatabaseInterface {
      
    public function getInstance() {
        return new Medoo([
            'database_type' => 'sqlite',
            'database_file' => __DIR__ . '/../../../_database/EATERIES.db',
            'error' => PDO::ERRMODE_WARNING
        ]);
    } 
}