<?php

namespace CodeWave\MysqlDumperCommandBundle\FileSystem;

class FileNameBuilder implements FileNameBuilderInterface
{
    /** @var \DateTime */
    private $dateTime;

    /** @var string */
    private $dateFormat;

    public function __construct($dateFormat, \DateTime $dateTime = null)
    {
        if($dateFormat) {
          $this->dateFormat = $dateFormat;
        }

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
