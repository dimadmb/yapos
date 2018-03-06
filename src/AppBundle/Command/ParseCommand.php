<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('parse')
            ->setDescription('Парсинг яндекса по ключевым словам')
            ->addArgument('domain', InputArgument::OPTIONAL, 'id домена')
            //->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domain_id = $input->getArgument('domain');
		
		$response = $this->getContainer()->get('parse')->parse($domain_id);


        $output->writeln($response);
    }

}
