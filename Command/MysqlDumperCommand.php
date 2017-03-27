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
        $connections = $this->getDatabaseConnections();

        foreach ($connections as $connection) {
            $commandBuilder = $this->getCommandBuilder($connection);

            $command = $commandBuilder->buildCommand($connection, $input->getOption('path'));

            $process = new Process($command);

            $process->setTimeout(3600);

            $status = $process->run();

            if ($status !== 0) {
                $output->writeln('Dump failed: '. explode('>>', $command)[1]);
            }

            $output->writeln(explode('>>', $command)[1]);
        }
    }

    private function getDatabaseConnections()
    {
        return $this->getContainer()->get('doctrine')->getConnections();
    }

    private function getCommandBuilder($connection)
    {
        $platform = $connection->getDatabasePlatform()->getName();

        $commandBuilder = $this->getContainer()->get("cdwv.mysql_dumper.dumper_command_builder.$platform");

        return $commandBuilder;
    }
}
