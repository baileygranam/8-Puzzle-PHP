<?php

session_start();

if(isset($_COOKIE['reset']) && $_COOKIE['reset'] == true)
{
	setcookie('reset', '', time() + (86400 * 30), '/');
	session_destroy();
	session_unset();
}

new Puzzle();

class Puzzle
{
	private $table;
	private $dialog;
	private $emptyX;
	private $emptyY;

	/* Constructor */
    public function __construct()
    {
    	$this->table  = $_SESSION['table'];
    	$this->emptyX = $_SESSION['emptyX'];
    	$this->emptyY = $_SESSION['emptyY'];

    	if(!isset($_SESSION['table']))
    	{
    		$this->newPuzzle();
        	$_SESSION['dialog'] = "Select a piece to swap.";	
    	}
    	if(isset($_COOKIE['x']) && isset($_COOKIE['y']))
    	{
    		$this->swap($_COOKIE['x'], $_COOKIE['y']);
    		
    	}
    	print_r($_COOKIE);
    }

    private function newPuzzle()
    {
    	$_SESSION['table'] = array(
    		array(1,2,3),
    		array(8,"",4),
    		array(7,6,5));

    	$_SESSION['emptyX'] = 1;
    	$_SESSION['emptyY'] = 1;
    	header("../Views/");
    }

    public function swap($i, $j)
    {
    	if($this->validateSwap($i, $j))
    	{
    		$_SESSION['table'][$this->emptyX][$this->emptyY] = $_SESSION['table'][$i][$j];
    		$_SESSION['table'][$i][$j] = "";
	        $_SESSION['emptyX'] = $i;
	        $_SESSION['emptyY'] = $j;
	        $_SESSION['dialog'] = "Piece Moved!";
	    }
    	else
    	{
	        $_SESSION['dialog'] = "Error: You can not make this move.";
    	}
    	header("Location:../Views/index.php");
    }

    private function validateSwap($i, $j)
    {
    	if(
        ($i == ($this->emptyX+1) && $j == $this->emptyY) ||
        ($i == ($this->emptyX-1) && $j == $this->emptyY) ||
        ($i == $this->emptyX && $j == ($this->emptyY+1)) ||
        ($i == $this->emptyX && $j == ($this->emptyY-1)))
        {
        	return true;
        }
	    else
	    {
	        return false;
	    }
    }

    public function shuffle() 
    {
  		$z = 0;

	    for ($i = sizeof($nums) - 1; $i >= 0; $i--) 
	    {
	        $j = floor(rand() * ($i + 1));
	        $x = $nums[$i];
	        $nums[$i] = $nums[$j];
	        $nums[$j] = $x;
	    }

	    for($i=0; $i < 3; $i++)
	    {
	        for($j=0; $j < 3; $j++)
	        {
	            if($nums[$z] == "")
	            {
	               $emptyX = $i;
	               $emptyY = $j;
	            }

	            // table.rows[i].cells[j].innerHTML = nums[z];
	            $z++;
	        }
	    }
	}
}



