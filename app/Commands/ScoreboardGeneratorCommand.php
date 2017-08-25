<?php

namespace App\Commands;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;


class ScoreboardGeneratorCommand extends Command
{
    protected function configure()
    {
      $this->setName('scoreboard:generator')
          ->setDescription('Creates A Professional Sports League Scoreboard.')
          ->setHelp('This command creates a professional sports league scoreboard...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $choice = new ChoiceQuestion(
            'Please select the league',
            [
              'MLB' => 'Major League Baseball',
              'NFL' => 'Nation Football League'
            ],
            'MLB'
        );

        $league = $helper->ask($input, $output, $choice);

        $question = new Question("Please enter the date\n", null);

        $date = $helper->ask($input, $output, $question);

        $class = sprintf('\App\Libraries\%s', $league);

        print_r(call_user_func_array([$class, "scoreboard"], [$date]));

        $output->writeln('You have just selected: ' . $league);
    }
}