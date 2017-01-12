<?php

namespace CodeWave\MysqlDumperCommandBundle\Tests\Unit;

use CodeWave\MysqlDumperCommandBundle\CommandBuilder\MysqlDumpCommandBuilder;

class MysqlDumpCommandBuilderTest extends \PHPUnit_Framework_TestCase
{
    const DUMP_PATH = '/tmp/dumps';
    const DATABASE_NAME = 'test_database';
    const DATABASE_USER_NAME = 'Pawel';
    const DATABASE_PASSWORD = 'password';
    const DATABASE_DUMP_FILE = 'test_database';
    const DATABASE_PORT = 3211;

    /** @var  MysqlDumpCommandBuilder */
    private $commandBuilder;

    public function setUp()
    {
        $this->commandBuilder = new MysqlDumpCommandBuilder(
            $this->getFileNameBuilderMock()
        );
    }

    public function testSuccessCommandBuild()
    {
        $cmd = $this->commandBuilder->buildCommand($this->getConnectionMock(), self::DUMP_PATH);

        $this->assertStringStartsWith('mysqldump', $cmd);
        $this->assertStringEndsWith(self::DATABASE_DUMP_FILE . '.bz2', $cmd);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testExceptionWhenDatabaseNotConfigured()
    {
        $this->commandBuilder->buildCommand($this->getEmptyConnectionMock(), self::DUMP_PATH);
    }

    private function getFileNameBuilderMock()
    {
        $mock = $this->getMockBuilder('CodeWave\MysqlDumperCommandBundle\FileSystem\FileNameBuilder')->getMock();
        $mock->method('buildName')->willReturn(self::DATABASE_DUMP_FILE);
        return $mock;
    }

    private function getConnectionMock()
    {
        $mock = $this->getMockBuilder('Doctrine\DBAL\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('getUsername')->willReturn(self::DATABASE_USER_NAME);
        $mock->method('getPort')->willReturn(self::DATABASE_PORT);
        $mock->method('getDatabase')->willReturn(self::DATABASE_NAME);
        $mock->method('getPassword')->willReturn(self::DATABASE_PASSWORD);

        return $mock;
    }

    private function getEmptyConnectionMock()
    {
        $mock = $this->getMockBuilder('Doctrine\DBAL\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }

    public function tearDown()
    {
        $this->commandBuilder = null;
    }
}