<?php

namespace CodeWave\MysqlDumperCommandBundle\FileSystem;

class FileNameBuilder implements FileNameBuilderInterface
{
    /** @var \DateTime */
    private $dateTime;

    /** @var string */
    private $dateFormat = 'd-m-Y_h-i';

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
        return sprintf("%s_%s_dump.sql", $databaseName, $this->dateTime->format($this->dateFormat));
    }
}
