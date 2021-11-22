<?php
namespace GameOfLife\Input;
use GameOfLife\Board;
use Ulrichsg\Getopt;
use GameOfLife\Base;

/**
 * The Class Random
 */
    class Random extends Base
    {
        /**
         * You can choose how full you want to fill the board
         */
        function fillBoard(Board $_board, Getopt $_options)
        {
            $fill = 50;
            if ($_options->getOption("randomFillLevel"))
            $fill = intval($_options->getOption("randomFillLevel"));
            for ($y = 0; $y < $_board->getHeight(); ++$y)
            {
                for ($x = 0; $x < $_board->getWidth(); ++$x)
                {
                    if ($_options->getOption("randomFillLevel"))
                    {
                        $_board->setCell($x, $y, rand(1, 100) < $fill);
                    } else if ($_options->getOption("input"))
                    {
                       $_board->setCell($x,$y,rand(0,1));
                    }
                }
            }
        }

        /**
         * Adds the option, to execute the Option Enter php gameoflife.php -i Random --randomFillLevel 25
         * 25% of the Board lifes
         */
        function addOptions(Getopt $_options)
        {
            $_options->addOptions([[Null, "randomFillLevel", Getopt::REQUIRED_ARGUMENT, "Sets the Fill Level of the Random Board"]]);
        }
    }