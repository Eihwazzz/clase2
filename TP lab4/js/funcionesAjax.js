function PaginaJuegos(){
    $.post("index2.html", function(htmlexterno){
   	$("#body1").html(htmlexterno);
    	});
	}