<?php

session_start();

new Puzzle();

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
    	if(isset($_SESSION['table']) && isset($_SESSION['emptyX']) && isset($_SESSION['emptyY']))
    	{
    		/* Define class variables based on previous session values. */
	    	$this->table  = $_SESSION['table'];
	    	$this->emptyX = $_SESSION['emptyX'];
	    	$this->emptyY = $_SESSION['emptyY'];

	    	/* 
	    	   Check to see if cookie is set. If it is then we make an 
	    	   attempt to swap spots on the 8 puzzle. 
	    	*/
	    	if(isset($_COOKIE['x']) && isset($_COOKIE['y']))
	    	{
	    		$this->swap($_COOKIE['x'], $_COOKIE['y']);
	    		setcookie('x', '', time() + (86400 * 30), "/");
	    		setcookie('y', '', time() + (86400 * 30), "/");
	    	}
	    }
	    else /* If puzzle is not set in the sessions then create a new puzzle board. */
	    {
	    	$this->newPuzzle();
        	$_SESSION['dialog'] = "Select a piece to swap.";
	    }
		if(isset($_GET['action'])) /* Check to see if an action was chosen by the user. */
		{
		    if($_GET['action'] == 2) /* Reset puzzle. */
		    {
				session_destroy();
				session_unset();
		    }

		    if($_GET['action'] == 1) /* Scramble puzzle. */
		    {
		    	$this->scramble();
		    }
		}       
	header("Location:../Views/"); /* Redirect back to puzzle page. */
   	}

   	/* Method to create a new default puzzle. */
    private function newPuzzle()
    {
    	$_SESSION['table'] = array(
    		array(1,2,3),
    		array(8,"",4),
    		array(7,6,5));

    	$_SESSION['emptyX'] = 1;
    	$_SESSION['emptyY'] = 1;
    }

    /* Method to swap two adjacent squares.
     * @param $i, $j - coordinates to be swapped with current empty square. 
     */
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
    	$nums = [1,2,3,4,5,6,7,8,''];
  		$z = 0;

	    for ($i = 7; $i >= 0; $i--) 
	    {
	        $j = floor(rand(0,1) * ($i + 1));
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
	               $_SESSION['emptyX'] = $i;
	               $_SESSION['emptyY'] = $j;
	            }
	            $_SESSION['table'][$i][$j] = $nums[$z];
	            echo $_SESSION['table'][$i][$j];
	            $z++;
	        }
	    }
	    $_SESSION['dialog'] = "Scrambled!";
	}
}



