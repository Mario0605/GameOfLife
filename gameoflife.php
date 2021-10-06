<?php
use GameOfLife\Board;
use Ulrichsg\Getopt;
require_once "Getopt.php";

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

$options = new Getopt(array(
    array('r', 'startRandom', Getopt::NO_ARGUMENT,"Starts the game with a random field"),
    array('g', 'startGlider', Getopt::NO_ARGUMENT,"Starts the game with a Glider field"),
    array('w', 'width', Getopt::REQUIRED_ARGUMENT, "Allows to set the width of the Board"),
    array('h', 'height', Getopt::REQUIRED_ARGUMENT, "Allows to set the height of the Board"),
    array('s', 'maxSteps', Getopt::NO_ARGUMENT, "Show the max Generation"),
    array('v', 'version', Getopt::NO_ARGUMENT, "Show the Version"),
    array('h', 'help', Getopt::NO_ARGUMENT, "Set the Help menu")
));
$options->parse();

if ($options->getOption("version"))
{
   echo "Version: 1.0\n";
   die;

}

if ($options->getOption("help"))
{
    $options->showHelp();
    die;
}

$width = 10;
$height = 10;

if ($options->getOption("width"))
{
    $width = $options->getOption("width");
}

if ($options->getOption("height"))
{
    $height = $options->getOption("height");
}

/**
 * @Class
 *
 * The Class Board creates a board with the specified width and height.
 */
$life = new Board($width, $height);

if ($options->getOption("startRandom"))
{
    $life->generateRandomBoard();
}

if ($options->getOption("startGlider"))
{
    $life->generateGleiter();
}

/**
 * @var
 *
 * Specifies how many generation should appear
 */
$maxSteps = 100;
if ($options->getOption("maxSteps"))
{
    echo $maxSteps;
}

/**
 * Possible boards
 */
//$life->generateRandomBoard();
//$life->generateGleiter();
$life->generateBlinker();

/**
 * for loop which outputs the generations until the above wave is reached
 */
for ($i=0; $i<$maxSteps; $i++)
{
    echo "Generation: $i \n";
    $life->printBoard();
    $life->calculateNextGeneration();
    if ($life->shouldFinish())
    {
        break;
    }
}