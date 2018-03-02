<?php

class Puzzle
{
	/* Variables */
	private $table;
	private $emptyX;
	private $emptyY;

	/* Constructor */
    public function __construct()
    {
    	/* Check to see if table, emptyX, and emptyY are set. */
    	if($this->isPuzzleSet())
    	{
    		/* Define class variables based on stored session values. */
	    	$this->table  = $_SESSION['table'];
	    	$this->emptyX = $_SESSION['emptyX'];
	    	$this->emptyY = $_SESSION['emptyY'];

			/* Check to see if cookie is set. If it is then we try to swap spots. */ 
		    if($this->isCookieSet())
		    {
		    	$this->swap($_COOKIE['x'], $_COOKIE['y']);
		    }  
		    /* Check to see if an action was chosen by the user. */
			if(isset($_POST['action'])) 
			{
				/* Reset puzzle. */
			    if($_POST['action'] == 'Reset')
			    {
					$this->newPuzzle();
			    }
			    /* Scramble puzzle. */
			    else if($_POST['action'] == 'Scramble')
			    {
			    	$this->scramble();
			    }
			}     
	    }
	    /* If puzzle is not set in the sessions then create a new puzzle board. */
	    else
	    {
	    	$this->newPuzzle();
	    }
   	}

   	/* Method to create a new default puzzle. */
    private function newPuzzle()
    {
    	/* Create the table in the solved state. */
    	$_SESSION['table'] = array(
    		array(1,2,3),
    		array(8,"",4),
    		array(7,6,5));

    	/* Store the location of the empty square on the table. */
    	$_SESSION['emptyX'] = 1;
    	$_SESSION['emptyY'] = 1;

    	/* Store the user dialog. */
    	$_SESSION['dialog'] = "Select a piece to swap.";
    }

    /* Method to swap two adjacent squares.
     * @param $i, $j - coordinates to be swapped with current empty square. 
     */
    public function swap($i, $j)
    {
    	/* Check to see if the attempted swap is valid. */
    	if($this->validateSwap($i, $j))
    	{
    		/* Swap empty square with selected square. */
    		$_SESSION['table'][$this->emptyX][$this->emptyY] = $_SESSION['table'][$i][$j];
    		$_SESSION['table'][$i][$j] = "";

    		/* Update the (x,y) location of the empty square. */
	        $_SESSION['emptyX'] = $i;
	        $_SESSION['emptyY'] = $j;

	        /* Set the dialog. */
	        $_SESSION['dialog'] = "Piece Moved!";
	    }
    	else
    	{
    		/* Set the dialog. */
	        $_SESSION['dialog'] = "Error: You can not make this move.";
    	}
    	/* Clear the cookies. */
    	$this->clearCookies();
    }

    /* Method to validate the legitimacy of a swap. */
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

    /* Method to randomly scramble the 8 puzzle. */
    public function scramble() 
    {
    	/* Array of values to scramble. */
    	$nums = [1,2,3,4,5,6,7,8,''];

    	/* Shuffle the array. */
    	shuffle($nums);

    	/* Intiialize k value. */
  		$k = 0;

  		/* Loop through each row. */
	    for($i=0; $i < 3; $i++)
	    {
	    	/* Loop through each column. */
	        for($j=0; $j < 3; $j++)
	        {
	        	/* If we come across the empty space then store the location .*/
	            if($nums[$k] == "")
	            {
	               $_SESSION['emptyX'] = $i;
	               $_SESSION['emptyY'] = $j;
	            }

	            /* Assign each value in $nums to the correct table location. */
	            $_SESSION['table'][$i][$j] = $nums[$k];
	            
	            /* Increment k. */
	            $k++;
	        }
	    }

	    /* Set user dialog. */
	    $_SESSION['dialog'] = "Scrambled!";
	}

	/**
	* Method to check to see if the puzzle is set/stored in the current session.
	* @return True if set, false if not set.
	*/
	private function isPuzzleSet()
	{
		return (isset($_SESSION['table']) && isset($_SESSION['emptyX']) && isset($_SESSION['emptyY']));
	}

	/**
	* Method to check to see if the (x,y) pair is set in the cookie. This
	* means the user selected a square to swap.
	* @return True if set, false if not set.
	*/
	private function isCookieSet()
	{
		return (isset($_COOKIE['x']) && isset($_COOKIE['y']));
	}

	/**
	* Method to clear the cookies of the (x,y) pair that was set.
	*/
	private function clearCookies()
	{
		setcookie('x', '', time() + (86400 * 30), "/");
	    setcookie('y', '', time() + (86400 * 30), "/");
	}
}



