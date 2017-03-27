<?php

namespace CodeWave\MysqlDumperCommandBundle\CommandBuilder;

use Doctrine\DBAL\Connection;
use CodeWave\MysqlDumperCommandBundle\FileSystem\FileNameBuilderInterface;

class PgsqlDumpCommandBuilder implements DumpCommandBuilderInterface
{
    private $fileNameBuilder;

    public function __construct(FileNameBuilderInterface $fileNameBuilder)
    {
        $this->fileNameBuilder = $fileNameBuilder;
    }

    public function buildCommand(Connection $connection, $path)
    {
        if (!$connection->getDatabase()) {
            throw new \RuntimeException('No database!');
        }

        if (!$path) {
            $path = '.';
        }

        $fileName = $this->fileNameBuilder->buildName($connection->getDatabase());
        $fullPath = $path . '/' . $fileName;

        $command = 'pg_dump';

        if ($connection->getUsername()) {
            $command .= ' -U ' . $connection->getUsername();
        }

        if ($connection->getPort()) {
            $command .= ' -p=' . $connection->getPort();
        }


        if ($connection->getHost()) {
            $command .= ' -h ' . $connection->getHost();
        }

        $command .= ' -d ' . $connection->getDatabase();

        $command .= ' -v ';

        if ($connection->getPassword()) {
            $command = 'PGPASSWORD="' . $connection->getPassword() . '" ' . $command;
        }

        $command .= ' | bzip2 >> ' . $fullPath . '.bz2';

        return $command;
    }
}
