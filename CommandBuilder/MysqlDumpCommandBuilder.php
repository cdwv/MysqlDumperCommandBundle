<?php

namespace CodeWave\MysqlDumperCommandBundle\CommandBuilder;

use Doctrine\DBAL\Connection;
use CodeWave\MysqlDumperCommandBundle\FileSystem\FileNameBuilderInterface;

class MysqlDumpCommandBuilder implements DumpCommandBuilderInterface
{
    private $fileNameBuilder;

    public function __construct(FileNameBuilderInterface $fileNameBuilder)
    {
        $this->fileNameBuilder = $fileNameBuilder;
    }

    public function buildCommand(Connection $connection, $path)
    {
        if (!$path) {
            $path = ' ';
        }

        $fileName = $this->fileNameBuilder->buildName($connection->getDatabase());
        $fullPath = $path . '/' . $fileName;

        $command = 'mysqldump ';

        if ($connection->getUsername()) {
            $command = $command . ' -u ' . $connection->getUsername();
        }

        if ($connection->getPort()) {
            $command = $command . ' --port=' . $connection->getPort();
        }

        if (!$connection->getDatabase()) {
            throw new \RuntimeException('No database!');
        }

        $command = $command . ' --single-transaction ' . $connection->getDatabase();

        if ($connection->getPassword()) {
            $command = $command . ' -p' . $connection->getPassword();
        }

        $command = $command . ' >> ' . $fullPath;

        return $command;
    }
}