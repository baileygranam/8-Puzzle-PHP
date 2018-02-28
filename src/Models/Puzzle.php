<?php

class Puzzle
{
	private $puzzle;
	private $dialog;
	private $emptyX;
	private $emptyY;
	private $nums = [1,2,3,4,5,6,7,8,""];

	/* Constructor */
    public function __construct()
    {
        $dialog = "Select a piece to swap.";
    }

    public function swap()
    {
    	if(validateSwap($i, $j))
    	{
	        table.rows[empty_x].cells[empty_y].innerHTML = table.rows[i].cells[j].innerHTML;
	        table.rows[i].cells[j].innerHTML = "";
	        $emptyX = $i;
	        $emptyY = $j;
	        $dialog = "Piece Moved!";
	    }
    	else
    	{
	        $dialog = "Error: You can not make this move.";
    	}
    }

    private function validateSwap(i, j)
    {
    	if(
        ($i == ($emptyX+1) && $j == $emptyY) ||
        ($i == ($emptyX-1) && $j == $emptyY) ||
        ($i == $emptyX && $j == ($emptyY+1)) ||
        ($i == $emptyX && $j == ($emptyY-1)))
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
    	$j, $x, $i;
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

	            table.rows[i].cells[j].innerHTML = nums[z];
	            $z++;
	        }
	    }
	}
}



