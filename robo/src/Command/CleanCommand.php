<?php

namespace App\Command;

use App\Controller\RobotController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleanCommand extends Command
{
    protected function configure()
    {
        $this->setName('clean')
            ->addArgument('floor', InputArgument::REQUIRED, 'Floor type')
            ->addArgument('area', InputArgument::REQUIRED, 'Area')
            ->setDescription('Clean Apartment')
            ->setHelp('This command asks robot to clean Apartments.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $floorType = $input->getArgument('floor');
        $area = $input->getArgument('area');

        $output->writeln('<--START-->');
        $robotController = new RobotController();
        $robotController->clean($floorType, $area, $output);
        $output->writeln('<--END-->');
    }
}
