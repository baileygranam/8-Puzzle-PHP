/* Get the document table. */
var table = document.getElementById("tableID");

/* Check to see if user has selected a piece to be swapped. */
window.onload = function() 
{
	if (table != null) 
	{
        for (var i = 0; i < table.rows.length; i++) 
        {
            for (var j = 0; j < table.rows[i].cells.length; j++) 
            {
                table.rows[i].cells[j].onclick = function () 
                {
                    setCookie(this.parentNode.rowIndex, this.cellIndex);
                };
            }
        }
    }
}

/* Method to set the cookie for the x,y coordinates of the 
 * piece that has been selected to be swapped.
 */
function setCookie(x, y)
{
    document.cookie = "x=" + x  + '; path=/;';
    document.cookie = "y=" + y  + '; path=/;';
    window.location = "../Models/Puzzle.php";
}
