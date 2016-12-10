$(document).ready(function() {
	if ( !$("#distritoid").val() ) {
		$("#distritoid").prop('disabled', true);
		$("#provinciaid").prop('disabled', true);
	}

	var url = $("#url").val() ? $("#url").val() : '';

	$("#dptoid").change(function() {
		var distritos = $("#distritoid");
		distritos.find('option').remove();
		distritos.append('<option value="0">-Seleccione-</option>')
		var provincias = $("#provinciaid");
		var departamentos = $(this)
		if($(this).val() != '' && $(this).val() != 0) {
			$.ajax({
				data: { id : departamentos.val() },
				url:   url + '/ajaxProvincias',
				type:  'POST',
				dataType: 'json',
				beforeSend: function () {
					departamentos.prop('disabled', true);
				},
				success:  function (r) {
					departamentos.prop('disabled', false);
					provincias.find('option').remove();
					$(r).each(function(i, v) {
						provincias.append('<option value="' + v.id + '">' + v.nombre + '</option>');
					})
					provincias.prop('disabled', false);
				}
			});
		}
		else {
			provincias.find('option').remove();
			provincias.prop('disabled', true);
		}
	});

	$("#provinciaid").change(function() {
		var distritos = $("#distritoid");
		var provincias = $(this)
		if($(this).val() != '' && $(this).val() != 0) {
			$.ajax({
				data: { id : provincias.val() },
				url:   url + '/ajaxDistritos',
				type:  'POST',
				dataType: 'json',
				beforeSend: function () {
					provincias.prop('disabled', true);
				},
				success:  function (r) {
					provincias.prop('disabled', false);
					distritos.find('option').remove();
					$(r).each(function(i, v) {
						distritos.append('<option value="' + v.id + '">' + v.nombre + '</option>');
					})
					distritos.prop('disabled', false);
				}
			});
		}
		else {
			distritos.find('option').remove();
			distritos.prop('disabled', true);
		}
	});
})