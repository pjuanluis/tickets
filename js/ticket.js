$(document).ready(function(){
	load(1);
});

function load(page) {
	var q= $("#q").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/tickets.php?action=ajax&page='+page+'&q='+q,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');

			var tbody = $("#tickets tbody");
			if (tbody.children().length == 0) {
				$('#q').attr('disabled', true);
			}

		}
	})
}

function eliminar (id) {
	var q= $("#q").val();
	if (confirm("Realmente deseas eliminar el ticket?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/tickets.php",
			data: "id="+id,"q":q,
			beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#resultados").html(datos);
				load(1);
			}
		});
	}
}

function cleanSearch() {	
	var search = $('#q').val();

	if (search !== '' && search !== undefined) {
		$('#q').val('');
		$('#q').attr('disabled', false);
		load(1);
	}
}