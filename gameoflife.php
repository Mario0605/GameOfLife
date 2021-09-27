<?php
use GameOfLife\Board;

/**
 * @param $className
 *
 * Loads the directory
 */
function autoload ($className)
{
    $classPath = str_replace ("\\", "/", $className);
    require_once (sprintf("%s/%s.php", __DIR__,$classPath));
}
spl_autoload_register("autoload");

/**
 * @var
 *
 * Specifies how many generation should appear
 */
$generationen = 40;

/**
 * @Class
 *
 * The Class Board creates a board with the specified width and height.
 */
$life = new Board(10, 10);

/**
 * Possible boards
 */
//$life->generateRandomBoard();
$life->generateGleiter();
//$life->generateblinker();

/**
 * for loop which outputs the generations until the above wave is reached
 */
for ($i=0; $i<$generationen; $i++)
{
    echo "Generation: $i \n";
    $life->printBoard();
    $life->calculateNextGeneration();
}


