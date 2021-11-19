<?php
namespace GameOfLife\Input;
use GameOfLife\Board;
use Ulrichsg\Getopt;
use GameOfLife\Base;

/**
 * @class Random
 *
 * The Class Random
 */
    class Random extends Base
    {
        /**
         * @function fillBoard
         *
         * You can choose how full you want to fill the board
         */
        function fillBoard(Board $_board, Getopt $_options)
        {
            $fill = 50;
            if ($_options->getOption("fillLevelR"))
            $fill = intval($_options->getOption("fillLevelR"));
            for ($y = 0; $y < $_board->getHeight(); ++$y)
            {
                for ($x = 0; $x < $_board->getWidth(); ++$x)
                {
                    if ($_options->getOption("fillLevelR"))
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
         * @function addOptions
         *
         * Adds the option
         */
        function addOptions(Getopt $_options)
        {
            $_options->addOptions([["f", "fillLevelR", Getopt::REQUIRED_ARGUMENT, "Sets the Fill Level of the Random Board"]]);
        }
    }