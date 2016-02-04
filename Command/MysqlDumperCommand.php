<?php

namespace CodeWave\MysqlDumperCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;

class MysqlDumperCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('cdwv:database:dump')
            ->setDescription('Dump database')
            ->addOption(
                'path',
                null,
                InputOption::VALUE_OPTIONAL,
                'Where save backup?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $databasePassword = $this->getContainer()->getParameter('database_password');
        $databaseUser = $this->getContainer()->getParameter('database_user');
        $databaseName = $this->getContainer()->getParameter('database_name');
        $databasePort = $this->getContainer()->getParameter('database_port');

        $path = $input->getOption('path');
        if (!$path) {
            $path = '.';
        }
        $fileName = $this->createFileName($databaseName);
        $fullPath = $path . '/' . $fileName;

        $command = 'mysqldump -u '. $databaseUser . ' -p' . $databasePassword . ' --port='.$databasePort . ' '. $databaseName . ' >> ' . $fullPath;

        $process = new Process($command);
        $process->run();

        $output->write($fileName);
    }

    private function createFileName($databaseName)
    {
        $date = new \DateTime();
        return  $databaseName . '_' . $date->format('d-m-Y_h-i') . '_dump.sql';
    }
}