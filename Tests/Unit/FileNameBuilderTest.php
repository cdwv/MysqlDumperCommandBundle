<?php

namespace CodeWave\MysqlDumperCommandBundle\Tests\Unit;

use CodeWave\MysqlDumperCommandBundle\FileSystem\FileNameBuilder;

class FileNameBuilderTest extends \PHPUnit_Framework_TestCase
{
    const DATABASE_NAME = 'test_database_name';
    const DATE_TIME_TEST = '01-12-2017';
    /** @var \CodeWave\MysqlDumperCommandBundle\FileSystem\FileNameBuilder */
    private $fileNameBuilder;

    public function setUp()
    {
        $date = new \DateTime(self::DATE_TIME_TEST);
        $this->fileNameBuilder = new FileNameBuilder($date);
    }

    public function testFileNameBuild()
    {

        $fileName = $this->fileNameBuilder->buildName(self::DATABASE_NAME);

        $this->assertStringStartsWith(self::DATABASE_NAME, $fileName);
        $this->assertRegexp('/' . self::DATE_TIME_TEST . '/', $fileName);

    }

    public function tearDown()
    {
        $this->fileNameBuilder = null;
    }
}