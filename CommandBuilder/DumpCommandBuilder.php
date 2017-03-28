<?php

namespace CodeWave\MysqlDumperCommandBundle\CommandBuilder;

use CodeWave\MysqlDumperCommandBundle\FileSystem\FileNameBuilderInterface;

abstract class DumpCommandBuilder implements DumpCommandBuilderInterface
{
    protected $fileNameBuilder;
    private $compressionEngine;
    private $compressionLevel;

    public function __construct(FileNameBuilderInterface $fileNameBuilder, $compressionEngine, $compressionLevel)
    {
        $this->fileNameBuilder = $fileNameBuilder;
        $this->compressionEngine = $compressionEngine;
        $this->compressionLevel = $compressionLevel;
    }


    protected function getCompressionCommand()
    {
        switch($this->compressionEngine) {
            case 'bzip2':
                return sprintf('| bzip2 -%d', $this->compressionLevel);
            case 'gzip':
                return sprintf('| gzip -%d', $this->compressionLevel);
            case 'xz':
                return sprintf('| xz -%d', $this->compressionLevel);
            case 'none':
              return '';

        }
    }

    protected function getCompressionExtension()
    {
      switch($this->compressionEngine) {
          case 'bzip2':
              return '.bz2';

          case 'xz':
              return '.xz';

          case 'gzip':
              return '.gz';

          case 'none':
              return '';
      }
    }
}
