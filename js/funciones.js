
function verCorreo(){
	var table = document.getElementById("tableID");
	if (table != null) {
	    for (var i = 0; i < table.rows.length; i++) {
	        for (var j = 0; j < table.rows[i].cells.length; j++)
	        table.rows[i].cells[j].onclick = function () {
	            tableText(this);
	        };
	    }
    }
}

function tableText(tableCell) {
    alert(tableCell.innerHTML);
}