<?php
/**
 * @file
 * Contains the game controller.
 */

namespace Conway;

/**
 * Class Game
 *
 * Controller used for instantiating a new game.
 *
 * @package Life
 */
class Game {

  private $matrix = [];
  private $width; 
  private $length; 

  public function __construct(array $matrix) {
      $this->matrix = $matrix;
      $this->setDimensions(); //w/H of array
  }

  public function run() {

    for ($i=0; $i<$this->width; $i++) {
      for ($j=0; $j<$this->length; $j++) {  
        //determine number of live neighbors
        $alive = $this->aliveNeighbors($i, $j);
        
        //determine status 
        if ($this->matrix[$i][$j] == 1) {//current person is alive
          $status = $this->aliveRules($alive); 
        }
        else { //current person is dead
          $status = $this->deadRules($alive); 
        }

        //draw outputs based on results        
        $this->render($status, $i);  
      }
      print PHP_EOL; 
    }
  }

   /**
   * Get state of eight possible neighbors
   * Return number of live neighbors
   * Takes current positionin array as arguments
   */

  private function aliveNeighbors($x, $y) {

    $liveNeighbors = 0; 

    if (isset($this->matrix[$x-1][$y-1])) { //10:30
      if ($this->matrix[$x-1][$y-1] == 1) 
        $liveNeighbors++; 
    }
    if (isset($this->matrix[$x-1][$y])) { //12:00
      if ($this->matrix[$x-1][$y] == 1) 
        $liveNeighbors++;       
    }
    if (isset($this->matrix[$x-1][$y+1])) { //1:30
      if ($this->matrix[$x-1][$y+1] == 1) 
        $liveNeighbors++;       
    }
    if (isset($this->matrix[$x][$y+1])) { //3:00
      if ($this->matrix[$x][$y+1] == 1) 
        $liveNeighbors++;       
    }  
    if (isset($this->matrix[$x+1][$y+1])) {//4:30
      if ($this->matrix[$x+1][$y+1] == 1) 
        $liveNeighbors++; 
    }
    if (isset($this->matrix[$x+1][$y])) { //6:00
      if ($this->matrix[$x+1][$y] == 1) 
        $liveNeighbors++;       
    }
    if (isset($this->matrix[$x+1][$y-1])) { //7:30
       if ($this->matrix[$x+1][$y-1] == 1) 
        $liveNeighbors++;      
    }
    if (isset($this->matrix[$x][$y-1])) { //9:00
      if ($this->matrix[$x][$y-1] == 1) 
        $liveNeighbors++;       
    }

    return $liveNeighbors;  

  }

   /**
   * Determine status of current 'alive' element
   * Return number of live neighbors
   */

  private function aliveRules($alive) {

    if ($alive < 2) {
      return 0; 
    }
    else if ( ($alive == 2) || ($alive == 3) ) {
      return 1; 
    }
    else if ($alive > 3) {
      return 0; 
    }

  }

   /**
   * Determine status of current 'dead' element
   * Return number of live neighbors
   */

  private function deadRules($alive) {

    if ($alive == 3) {
      return 1; 
    }
    else {
      return 0; 
    }

  }

   /**
   * Draw rules for output 
   * Current rules dictate grid type layout
   */

  private function render($status) {

      print $status; 
  }

  private function setDimensions() {

    //begin by making the assumption of square matrix
    $this->width = $this->length = count($this->matrix); 

    //PHP has arrays of array as 2d array
    // we want to check here that the arrays are even 
    // as well
    foreach ($this->matrix as $value) {
      if (count($value) !== $this->length) { //check subarray
        $this->width = null; 
        return; 
      }
    }
  }

  /**
   * Validate input
   *
   * This class could be expansive (class of its own)
   * but  we won't do much validation here.
   * Just check that it is in fact a NxN Matrix
   * 
   */

  public function validate() {
    if ($this->width !== $this->length) {
      return false; 
    }
    else {
      return true; 
    }
  }





}