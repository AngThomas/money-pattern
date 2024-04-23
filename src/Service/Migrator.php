<?php

namespace Mkt\MoneyPattern\Service;


use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\DependencyInjection\ContainerInterface;


class Migrator
{
    private function executeMigrations()
    {
        $application = new Application('migrator', '1.0');
        $application->setAutoExit(true);


        $input = new ArrayInput([
            'command' => 'doctrine:migrations:migrate',
            '--no-interaction' => true,
            //TODO: przesunąć src migrations do jakiejś stałej
            '--migrations-path' => 'src/migrations',
        ]);
        $output = new BufferedOutput();
        try {
            $application->run($input, $output);
        } catch(Exception $e) {
            //TODO: obsłużyć
        }

    }
}