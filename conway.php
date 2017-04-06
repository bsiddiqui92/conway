<?php 
/*
 * Author: Bilal Siddiqui
 * Date: 04/06/2017
 * Description: Conway Game of Life
 * github:
 *
 *
 *	Conway’s Game of Life
 *
 *	Rules:
 *		The universe is a finite twodimensional
 *		grid of square cells (square matrix). Each cell has 2
 *		possible states, alive or dead. Every cell interacts with its neighbors, which are the cells that are
 *		horizontally, vertically, or diagonally adjacent. Therefore, a cell can have up to eight neighbors.
 * 		
 *  		At each step in time, the following transitions occur:
 *
 * 			1. Any live cell with fewer than two live neighbors dies, as if caused by underpopulation.
 * 			2. Any live cell with two or three live neighbors lives on to the next generation.
 *			3. Any live cell with more than three live neighbors dies, as if by overpopulation.
 *			4. Any dead cell with exactly three live neighbors becomes a live cell, as if by reproduction. */

namespace Conway; 
include './src/Game.php'; 
 

 /* Main program to run Conway game
  *
  * Main program is validating CLI inputs
  * & Preparting data to match the format 
  *   expected by our Class.
  * 
 */

$fileName = (isset($argv[1])) ? $argv[1] : null;

if (!$fileName)
	die('Missing Input file. Run program with help parameter for assistance.'.PHP_EOL); 

//handle help parameter
if ($argv[1] == 'help') 
	die('php datto.php <input file>'.PHP_EOL); 

//can't find file
if (file_exists($fileName)) 
	$file = fopen($fileName, "r") or die('Unable to Open File');
else
	die('File not found. Make sure your path is correct.'.PHP_EOL); 

$count = 0; //array row count

//create 2D Array from file
//Our object will expect data in this format
while ($row = fgets($file)) {
	$matrix[$count] = str_split(trim($row)); 
	$count++;  
}

fclose($file);


$myGame = new Game($matrix); 
$isValid = $myGame->validate(); 
//make sure all validation rules have been met
if($isValid){
	$myGame->run(); 
}
else {
	die('An input error occured. Please make sure you have a square matrix and rerun the program.'.PHP_EOL); 
}

?>