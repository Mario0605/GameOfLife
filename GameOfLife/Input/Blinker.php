<?php
namespace GameOfLife\Input;
use GameOfLife\Board;
use Ulrichsg\Getopt;
use GameOfLife\Base;

/**
 * @class Blinker
 *
 * Class of the Binker
 */
class Blinker extends Base
{
    /**
     * @function fillBoard
     *
     * You can choose how full you want to fill the board
     */
    function fillBoard(Board $_board, Getopt $_options)
    {
        $startCoordinateWidth = $_board->getWidth() / 2 - 0.6;
        $startCoordinateHeight = $_board->getHeight() / 2 - 0.6;

        $xa = round($startCoordinateWidth, 0);
        $ya = round($startCoordinateHeight, 0);

        if ($_options->getOption("positionB"))
        {
            $pos = explode(",", $_options->getOption("positionB"));
            $xa = $pos[0];
            $ya = $pos[1];
        }

        $_board->setCell($xa +1,$ya +0, true);
        $_board->setCell($xa +1,$ya +1, true);
        $_board->setCell($xa +1,$ya +2, true);
    }

    /**
     * @function addOptions
     *
     * Adds the option
     */
    function addOptions(Getopt $_options)
    {
        $_options->addOptions([["b", "positionB", Getopt::REQUIRED_ARGUMENT, "Sets the Blinker on the Position"]]);
    }
}