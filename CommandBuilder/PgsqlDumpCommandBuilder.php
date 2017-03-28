<?php

namespace CodeWave\MysqlDumperCommandBundle\CommandBuilder;

use Doctrine\DBAL\Connection;

class PgsqlDumpCommandBuilder extends DumpCommandBuilder
{
    public function buildCommand(Connection $connection, $path)
    {
        if (!$connection->getDatabase()) {
            throw new \RuntimeException('No database!');
        }

        $fileName = $this->fileNameBuilder->buildName($connection->getDatabase());

        $fullPath = sprintf('%s/%s', $path, $fileName);

        $userNamePart = $connection->getUsername() ? sprintf('-U %s', $connection->getUsername()) : '';

        $portPart = $connection->getPort() ? sprintf('-p=%s', $connection->getPort()) : '';

        $hostPart = $connection->getHost() ? sprintf('-h %s', $connection->getHost()) : '';

        $databasePart = sprintf('-d %s', $connection->getDatabase());

        $environmentPart = $connection->getPassword() ? sprintf('PGPASSWORD="%s"',
            $connection->getPassword()) : '';

        $command = sprintf('%s pg_dump -v %s %s %s %s',
          $environmentPart,
          $userNamePart,
          $portPart,
          $hostPart,
          $databasePart);

        $command .= $this->getCompressionCommand();

        $command .= ' > ' . $fullPath;

        $command .= $this->getCompressionExtension();

        return $command;
    }
}
