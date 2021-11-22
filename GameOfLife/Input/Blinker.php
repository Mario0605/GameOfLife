<?php
namespace GameOfLife\Input;
use GameOfLife\Board;
use Ulrichsg\Getopt;
use GameOfLife\Base;

/**
 * Class of the Binker
 */
class Blinker extends Base
{
    /**
     * You can choose how full you want to fill the board
     */
    function fillBoard(Board $_board, Getopt $_options)
    {
        $startCoordinateWidth = $_board->getWidth() / 2 - 0.6;
        $startCoordinateHeight = $_board->getHeight() / 2 - 0.6;

        $xa = round($startCoordinateWidth, 0);
        $ya = round($startCoordinateHeight, 0);

        if ($_options->getOption("blinkerPosition"))
        {
            $pos = explode(",", $_options->getOption("blinkerPosition"));
            $xa = $pos[0];
            $ya = $pos[1];
        }
        $_board->setCell($xa +1,$ya +0, true);
        $_board->setCell($xa +1,$ya +1, true);
        $_board->setCell($xa +1,$ya +2, true);
    }

    /**
     * Adds the option, to execute the Option Enter php gameoflife.php -i Blinker --blinkerPosition 4,4
     * The Cell X:4 Y:4 is the StartPoint of the Blinker.
     */
    function addOptions(Getopt $_options)
    {
        $_options->addOptions([[Null, "blinkerPosition", Getopt::REQUIRED_ARGUMENT, "Sets the Blinker on the Position"]]);
    }
}