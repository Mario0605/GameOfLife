<?php
namespace GameOfLife;

class Board
{
    /**
     * @var array
     *
     * Double nested array, Represents the board (game board)
     */
    private $board = [[]];

    /**
     * Indicates the width of the board at the end
     */
    private $width;

    /**
     * Indicates the height of the board at the end
     */
    private $height;

    /**
     * Contains all previous boards in an array
     * @var array
     */
    private $previousGenerations;

    /**
     * @param $_width
     * @param $_height
     *
     * You can then enter the size and width in the file
     */
    public function __construct($_width, $_height)
    {
        $this->width = $_width;
        $this->height = $_height;
    }

    /**
     * Generates a random board (random content)
     */
    public function generateRandomBoard()
    {
        for ($y = 0; $y < $this->height; ++$y) {
            $row = [];
            for ($x = 0; $x < $this->width; ++$x) {
                $row[$x] = round(rand(0, 1));
            }
            $this->board[$y] = $row;
        }
    }

    /**
     * Generates a glider in the board
     */
    public function generateGleiter()
    {
        for ($y = 0; $y < $this->height; ++$y)
        {
            $row = [];
            for ($x = 0; $x < $this->width; ++$x) {
                $row[$x] = 0;
            }
            $this->board[$y] = $row;
        }
        $this->board[1][0]=1;
        $this->board[2][1]=1;
        $this->board[2][2]=1;
        $this->board[1][2]=1;
        $this->board[0][2]=1;
    }

    /**
     * Generates a Turn signal in the board
     */
    public function generateBlinker()
    {
        for ($y = 0; $y < $this->height; ++$y) {
            $row = [];
            for ($x = 0; $x < $this->width; ++$x) {
                $row[$x] = 0;
            }
            $this->board[$y] = $row;
        }
        $this->board[1][0]=1;
        $this->board[1][1]=1;
        $this->board[1][2]=1;
    }

    /**
     * @param $x
     * @param $y
     * @return int
     *
     * x and y are the coordinates of the cells
     * Count the Living Neighbors
     */
    function countLivingNeighbours($x, $y): int
    {
        $coordinatesArray = [
            [-1, -1], [-1, 0], [-1, 1],
            [0, -1], [0, 1],
            [1, -1], [1, 0], [1, 1]
        ];
        $count = 0;

        foreach ($coordinatesArray as $coordinate) {
            if (isset($this->board[$x + $coordinate[0]][$y + $coordinate[1]])
                && $this->board[$x + $coordinate[0]][$y + $coordinate[1]] == 1) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * @var array
     *
     * Creates the next generation. New Board is the new generation board. And then the rules are still used
     */
    function calculateNextGeneration()
    {
        $newBoard = [];

        foreach ($this->board as $widthId => $width) {
            $newBoard[$widthId] = [];
            foreach ($width as $heightId => $height) {
                $count = $this->countLivingNeighbours($widthId, $heightId);

                $newValue=null;
                if ($height == 1) {
                    // The cell is alive.
                    if ($count < 2 || $count > 3) {
                        // Any live cell with less than two or more than three neighbours dies.
                        $newValue = 0;
                    } else {
                        // Any live cell with exactly two or three neighbours lives.
                        $newValue = 1;
                    }
                } else {
                    if ($count == 3) {
                        // Any dead cell with three neighbours lives.
                        $newValue = 1;
                    }
                }
                $newBoard[$widthId][$heightId] = $newValue;
            }
        }
        // Sezt an letzer stelle ein neues array
        $this->previousGenerations[] = $this->board;
        $this->board = $newBoard;
    }

    /**
     *Executes the board and puts - and * instead of 0 and 1
     */
    function printBoard()
    {
        for ($y = 0; $y < $this->height; ++$y) {
            for ($x = 0; $x < $this->width; ++$x) {
                $character = "-";
                if ($this->board[$y][$x] == 1) $character = "*";
                echo " $character ";
            }
            echo "\n";
        }
    }

    /**
     * Checks if the generations repeat.
     */
    function shouldFinish(): float
    {
        $previousBoard = $this->previousGenerations[count($this->previousGenerations) -1];
        $currentBoard = $this->board;
        if ($previousBoard == $currentBoard)
        {
            //Wie liefern functionen antworten
            return true;
        }
            elseif (count($this->previousGenerations) > 1)
        {
            $previousPreviousBoard = $this->previousGenerations[count($this->previousGenerations) -2];
            if ($previousPreviousBoard ==  $currentBoard)
                {
                    return true;
                }
        }
            return false;
    }
}