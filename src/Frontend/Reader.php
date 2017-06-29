<?php

declare(strict_types=1);

namespace Hywan\DatabaseToPlantUML\Frontend;

use Hoa\Database\Dal;
use Hoa\Database\DalStatement;
use PDO;

class Reader
{
    protected $_databaseConnection = null;

    public function __construct()
    {
        $this->_databaseConnection = Dal::getInstance(
            'main',
            'pdo',
            'mysql:host=localhost',
            'root',
            ''
        );
    }

    public function read(string $databaseName): Database
    {
        return new Database($this->_databaseConnection, $databaseName);
    }
}