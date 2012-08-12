<?php

// call from shell with
// php app/console wg:gitlab:raise-issue <project-id> <issue-title> [--description="<description>"] [--user=<username>] [--milestone=<milestone>] [--labels=label1,label2,label3]

namespace WG\GitlabBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand,
    Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;

use WG\GitlabBundle\Entity\User;

class RaiseIssueCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName( 'wg:gitlab:raise-issue' )
             ->setDescription( 'Raises an issue on Gitlab' )
             ->addArgument( 'project', InputArgument::REQUIRED, 'Project to raise issue for' )
             ->addArgument( 'title', InputArgument::REQUIRED, 'Issue title' )
             ->addOption( 'description', 'd', InputOption::VALUE_REQUIRED, 'Issue description' )
             ->addOption( 'user', 'u', InputOption::VALUE_REQUIRED, 'Assign issue to this person' )
             ->addOption( 'milestone', 'm', InputOption::VALUE_REQUIRED, 'Assign issue to this milestone' )
             ->addOption( 'labels', 'l', InputOption::VALUE_REQUIRED, 'Tag issue with comma-separated list of labels' );
    }

    public function execute( InputInterface $input, OutputInterface $output )
    {
        $output->writeln( '<comment>Connecting to Gitlab API...</comment>' );
        // ...
        // TODO
        // ...
        $output->writeln( '<info>Issue has been raised.</info>' );
    }
}
