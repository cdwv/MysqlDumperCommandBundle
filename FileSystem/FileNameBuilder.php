<?php

namespace CodeWave\MysqlDumperCommandBundle\FileSystem;

class FileNameBuilder implements FileNameBuilderInterface
{
    /** @var \DateTime */
    private $dateTime;

    public function __construct(\DateTime $dateTime = null)
    {
        if ($dateTime) {
            $this->dateTime = $dateTime;
        } else {
            $this->dateTime = new \DateTime();
        }
    }

    public function buildName($databaseName)
    {
        return $databaseName . '_' . $this->dateTime->format('d-m-Y_h-i') . '_dump.sql';
    }
}