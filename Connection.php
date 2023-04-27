<?php

namespace Sruuua\Database\Database;

use Sruuua\Database\Database\Statement\Statement;
use Sruuua\Database\Kernel;
use \PDO;
use \PDOException;

final class Connection
{
    private ?PDO $connection = null;

    public function __construct(Kernel $kernel)
    {
        $this->connect($kernel->getEnv());
    }

    public function connect(array $ctx)
    {
        try {
            $this->connection = new PDO(
                "mysql:host=" . $ctx['DB_HOST'] . ";dbname=" . $ctx['DB_NAME'] . ";port=" . $ctx['DB_PORT'],
                $ctx['DB_USER'],
                $ctx['DB_PASSWORD'],
            );
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function prepare(string $req): Statement
    {
        return new Statement($this->connection->prepare($req));
    }

    /**
     * Return the PDO of connection
     */
    public function getConnection(): ?PDO
    {
        return $this->connection;
    }

    /**
     * Close the connection to database
     */
    public function disconnect(): self
    {
        $this->connection = null;

        return $this;
    }
}
