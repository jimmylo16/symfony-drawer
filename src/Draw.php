<?php

namespace DrawingTool;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;


use DrawingTool\Components\Canvas;

class Draw extends Command
{
    private $canvas;

    protected function configure()
    {
        $this->setName('DrawingTool')
            ->setDescription('This is a drawingTool')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('filename', InputArgument::REQUIRED, 'Path to the input file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getArgument('filename');
        $commands = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $this->canvas = new Canvas(0, 0);

        $firstIteration  = true;
        foreach ($commands as $command) {
            $parts = explode(' ', $command);
            $action = strtoupper(trim($parts[0]));
            if ( $firstIteration) {
                if ($action != "C") {
                    throw new \LogicException('Please add a canvas');
                }
                $firstIteration = false;
            }
          
            $this->processAction($action,$parts);
        }
        $outputFilePath = 'output.txt';
        file_put_contents($outputFilePath, $this->canvas->render());
        return Command::SUCCESS;
    }

    private function processAction(string $action,$parts)
    {
        switch ($action) {
            case 'C':
                echo "Creating canvas with dimensions $parts[1] x $parts[2]\n";
                $this->canvas->setDimensions((int)$parts[1], (int)$parts[2]);
                break;
            case 'L':
                $this->canvas->drawLine((int)$parts[1], (int)$parts[2], (int)$parts[3], (int)$parts[4]);
                break;
            case 'R':
                $this->canvas->drawRectangle((int)$parts[1], (int)$parts[2], (int)$parts[3], (int)$parts[4]);
                break;
            case 'B':
                $this->canvas->fillArea((int)$parts[1], (int)$parts[2], $parts[3]);
                break;
            default:
                throw new \LogicException('Invalid command');
                break;
        }
    }
}