var inputid=0;
$(function(){
	
	$('#btn_m').click(function(){
		
		inputid++;
		var campo = ''
				+'<i class="icon-caret-right blue"></i> <b><i class="icon-time blue"></i> Horario: '+inputid+'</b>'
				+'<div class="row-fluid">'
					+'<div class="span5">'
						+'<div class="control-group"><label class="control-label" for="Opciones Dias">Seleccione dias:</label>'
							+'<div class="controls">'
								+'<div class="span12">'
									+'<select multiple="" class="chzn-select'+inputid+'" id="'+'select'+inputid+'" data-placeholder="Seleccione Días">'												
									+'</select>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'
				+'</div>'
				+'<div class="row-fluid">'				
					+'<div class="span5">'
						+'<div class="row-fluid">'
							+'<div class="span12">'
								+'<div class="control-group">'
									+'<label class="control-label" for="form-field-tags">Horarios</label>'
									+'<div class="controls">'													
										+'<input class="span5" type="text" id="form-field-tags'+inputid+'" placeholder="Digite hora..." />'													
									+'</div>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'					
				+'</div>'
				+'<div class="row-fluid">'
					+'<div class="span4">'
						+'<div class="row-fluid">'
							+'<div class="span12">'
								+'<div class="control-group">'
									+'<label class="control-label" for="form-field-tags">Lapso de Hora</label>'
									+'<div class="controls">'													
										+'<input type="text" />'													
									+'</div>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'
				+'</div>';
		$("#obj_contenedor").append(campo);					
		// console.log('inputid: '+inputid)
		//$('.chzn-select'+inputid+"").append("<option value='LUNES' />LUNES");						
		

		var myOptions = "<option value></option>";
		for(var i=0; i<semana.length; i++){
		    myOptions +=  '<option value="'+semana[i].id+'">'+semana[i].name+'</option>';
		}
		// uses new "chosen" actualiza con el nuevo señesct"
		$('.chzn-select'+inputid+"").html(myOptions).chosen().trigger("chosen:updated");					
		//we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
		var tag_input = $("#form-field-tags"+inputid);	
		//alert(tag_input.attr('id'))		
		var regexp = /[0-9]{1,2}[:]{1}[0-9][1,2]/;			
		if(! ( regexp.test(navigator.userAgent)) ){							
			tag_input.tag({placeholder:tag_input.attr('placeholder')});
			//alert('hola '+tag_input.val())
		}							
		else {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!							
			tag_input.after('<textarea class="span12" id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="5">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}
	})	
})
$('#btn_guardar_horario').click(function(){
	inputid=0;
	console.log('var inputid: '+inputid)
		// var contenedo=$('#obj_contenedor');
		// console.log(document.getElementById('obj_contenedor').firstChild)			
	for (var i = 1;;i++) {
		console.log('valori: '+i)
		var elem="select"+i+"";
		var elem1="#select"+i+"";
		var elem2="#form-field-tags"+i+"";					
		if (document.getElementById(elem)) {
			console.log(i)
			var valor1=""+$(elem1).val()

			valor1=valor1.replace(" ","")
			valor1=valor1.replace("[","")
			valor1=valor1.replace("]","")

			// co]nsole.log(valor1)
			var valor2=$(elem2).val()
			var id_servicio=$('#lbl_id_servicio').html();	
			var cadena=valor2.split(",");
			var horai=cadena[0];
			var horaf=cadena[1];
			horaf=horaf.replace(" ","");
			
		}else{
		 break;
		}
	};
	

});

function mostrar_horario(id){
	$.ajax({
        url: "php/tarifa.php",
        type: "POST",
        data:{mostrar_horario:'ok', id:id},			               
        success: function(data)
        {			
			//console.log(data)   
			$('#tabla_horario tbody').html(data);
        }			                	        
    });
};

function modificar_horario(id){
	bootbox.confirm("<h1>EN PROCESO<h1>", function(result) {
		if(result) {
			// $.ajax({
		 //        url: "php/tarifa.php",
		 //        type: "POST",
		 //        data:{id:id,h_eliminar:'ok'},			               
		 //        success: function(data)
		 //        {			
			// 		//console.log(data)   
			// 		$('#tabla_tarifa tbody').html(data);
			// 		$.gritter.add({						
			// 			title: '..Mensaje..!',						
			// 			text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron eliminados . <br>',						
			// 			//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
			// 			sticky: false,						
			// 			time: 2000
			// 		});			
			// 		mostrar_horario($('#lbl_id_servicio').html());
		 //        }			                	        
		 //    });
		}
	});		
}

function modificar_tarifa(id){
	$('#txt_id_tarifa_edicion').val(id);
	$('#modal-editar_tarifa').modal('show');
	$.ajax({
        url: "php/tarifa.php",
        type: "POST",
        data:{modificar_tarifax:'ok',id:id},			               
        dataType: "json",
        success: function(data)
        {			
			console.log(data)  
			$('#lbl_categoria_tarifa').editable({'setValue':data[0]});	
			$('#lbl_categoria_tarifa').html(data[0])
			$('#lbl_nombre_tarifa').html(data[1])
			$('#lbl_nombre_tarifa').editable({'setValue':data[1]});
			$('#lbl_precio').html(data[2])	
			$('#lbl_precio').editable({'setValue':data[2]});	

        }			                	        
    });
}
// eliminar refgistro tarifa
function h_eliminar(id){
	bootbox.confirm("<h1>Seguro desea eliminar<h1>", function(result) {
		if(result) {
			$.ajax({
		        url: "php/tarifa.php",
		        type: "POST",
		        data:{id:id,h_eliminar:'ok'},			               
		        success: function(data)
		        {			
					//console.log(data)   
					$('#tabla_tarifa tbody').html(data);
					$.gritter.add({						
						title: '..Mensaje..!',						
						text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron eliminados . <br>',						
						//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
						sticky: false,						
						time: 2000
					});			
					mostrar_horario($('#lbl_id_servicio').html());
		        }			                	        
		    });
		}
	});		
}