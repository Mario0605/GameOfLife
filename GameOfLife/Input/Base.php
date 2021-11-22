<?php
namespace GameOfLife;
use Ulrichsg\Getopt;
use GameOfLife\Input\Glider;

/**
 * @class Base
 *
 * Class of the Base
 */
abstract class Base
{
    /**
     * @function addOptions
     *
     * You can add Options
     */
    function addOptions(Getopt $_options){}

    /**
     * @function fillBoard
     *
     * Is abstract, fill the Board
     */
    abstract function fillBoard(Board $_board, Getopt $_options);
}