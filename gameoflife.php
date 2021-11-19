<?php
use GameOfLife\Board;
use Ulrichsg\Getopt;
use GameOfLife\Base;

require_once "Getopt.php";

/**
 * @param $className
 *
 * Loads the directory
 */
function autoload ($className)
{
    $classPath = sprintf("%s/%s.php",__DIR__,str_replace ("\\", "/", $className)) ;
    if (is_readable($classPath))require_once ($classPath);
}
spl_autoload_register("autoload");

$options = new Getopt(array(
    array("i", 'input', Getopt::REQUIRED_ARGUMENT,"Starts the game with a random field"),
    array('w', 'width', Getopt::REQUIRED_ARGUMENT, "Allows to set the width of the Board"),
    array('t', 'height', Getopt::REQUIRED_ARGUMENT, "Allows to set the height of the Board"),
    array('m', 'maxSteps', Getopt::REQUIRED_ARGUMENT, "Show the max Generation"),
    array('v', 'version', Getopt::NO_ARGUMENT, "Show the Version"),
    array('h', 'help', Getopt::NO_ARGUMENT, "Set the Help menu")
));

$files = glob("GameOfLife/Input/*.php");

foreach ($files as $file)
{
    $baseName = basename($file, ".php");
    $className = "GameOfLife\\Input\\".$baseName;

    if($className == Base::class) continue;

    if(class_exists($className))
    {

        $input = new $className;
        if($input instanceof Base)
        {
            $input->addOptions($options);
        }
    }
}

$options->parse();
/**
 * Standard height and width
 */
$width = 10;
$height = 10;

/**
 * @Class
 *
 * The Class Board creates a board with the specified width and height.
 */
$life = new Board ($width, $height);

/**
 * Shows the Help
 */
if ($options->getOption("help"))
{
    $options->showHelp();
    die;
}

if ($options->getOption("width"))
{
    $width = $options->getOption("width");
}

/**
 * Enter the height
 */
if ($options->getOption("height"))
{
    $height = $options->getOption("height");
}

/**
 * @var
 *
 * Specifies how many generation should appear
 */
$maxSteps = 70;
if ($options->getOption("maxSteps"))
{
    $maxSteps = $options->getOption("maxSteps");
}

/**
 * Show the Version
 */
if ($options->getOption("version"))
{
    echo "Version: 3.0\n";
    die;
}

$newInput = $options->getOption("input");
$className = "GameOfLife\Input\\$newInput";

if (class_exists($className))
{
    $input = new $className;
    if ($input instanceof Base)
    {
        $input->fillBoard($life, $options);
    }
}

/**
 * for loop which outputs the generations until the above wave is reached
 */
for ($i = 0; $i < $maxSteps; $i++)
{
    echo "Generation: $i \n";
    $life->printBoard();
    $life->calculateNextGeneration();
    if ($life->shouldFinish())
    {
        break;
    }
}