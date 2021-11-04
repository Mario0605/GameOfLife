<?php
namespace Input;
use GameOfLife\Board;

class GliderInput extends Board
{
    function Glider()
    {
        $width = 10;
        $height = 10;

        $life = new Board($width, $height);
        $life->generateGleiter();

        //Mitte
            $x = round();
            $y =
        $startCoordinate =
        $coordinatesArray = [
                    [+1, 0], [+1, 0],
            [-1, 0], [-1, ], [0, -1],
            [0, +1], [+1, 0], [+1, 0]
        ];
        // Formel 10 / 2 = 5 -0,6 = 4,4 = ~ 4
        // [4,4] , [+1,0] , [+1,0]
        // [-1,0] , [-1,0] , [0,-1]
        // [0,+1] , [+1,0] , [+1,0]
    }
}