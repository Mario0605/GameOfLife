<?php
namespace GameOfLife\Input;
use Ulrichsg\Getopt;
use GameOfLife\Board;
use GameOfLife\Base;

/**
 * The Class Glider
 */
class Glider extends Base
{
    /**
     * You can choose how full you want to fill the board
     */
    function fillBoard(Board $_board, Getopt $_options) : void
    {
        $startCoordinateWidth = $_board->getWidth() / 2 - 0.6;
        $startCoordinateHeight = $_board->getHeight() / 2 - 0.6;

        $xa = round($startCoordinateWidth, 0);
        $ya = round($startCoordinateHeight, 0);

        if ($_options->getOption("gliderPosition"))
        {
            $pos = explode(",", $_options->getOption("gliderPosition"));
            $xa = $pos[0];
            $ya = $pos[1];
        }
            $_board->setCell($xa + 1, $ya + 0, true);
            $_board->setCell($xa + 2, $ya + 1, true);
            $_board->setCell($xa + 2, $ya + 2, true);
            $_board->setCell($xa + 1, $ya + 2, true);
            $_board->setCell($xa + 0, $ya + 2, true);
        }

    /**
     * Adds the option, to execute the Option Enter php gameoflife.php -i Glider --gliderPosition 4,4
     * The Cell X:4 Y:4 is the StartPoint of the Glider.
     */
    function addOptions(Getopt $_options)
    {
        $_options->addOptions([[Null, "gliderPosition", Getopt::REQUIRED_ARGUMENT, "Sets the glider on the Position"]]);
    }
}