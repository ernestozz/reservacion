$(function(){
    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';    


    $(".chzn-select").chosen();

    $('#select_categoria').change(function(){
        var acu=$(this).val();
        $('#lbl_subtotal').html('00.00');
        // estableciendo nombre
        $.ajax({
            url:'app.php',
            type:'POST',
            data:{mostrar_tarifa_servicios:':)',id:acu},
            success:function(data){
                $('#obj_tarifas_nombre').html(data);
            }
        });
        // estableciendo cantidad
        $.ajax({
            url:'app.php',
            type:'POST',
            dataType:'json',
            data:{mostrar_tarifa_servicios3:':)',id:acu},
            success:function(data){
                var acumulador='';
                var sumador='';
                for (var i = 0; i < data.length; i=i+3) {
                    var iden='';
                    $.ajax({
                        url:'app.php',
                        type:'POST',
                        async:false,
                        dataType:'json',
                        data:{mostrar_reservacion_tarifa:':)',id_reservacion:data[i+2], id_tarifa:data[i+0]},
                        success:function(response){
                            iden=response;
                        }
                    });
                    acumulador+='<li id="'+data[0+i]+'">'+iden[0]+'</li>';
                    sumador+='<li id="tot_'+data[0+i]+'">'+iden[1]+'</li>';
                    subtotal(data[i+2]+','+iden[1]);
                }

                $('#obj_tarifas_personas').html(acumulador);
            }
        });
    });


    $('#btn_buscar_cliente').click(function(){
        $('#modal-cliente').modal('show');
    });
    var table=$('#tbt_clientes').dataTable( {
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:  ",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
    // llenando por procesos
    $.ajax({
        url:'app.php',
        type:'POST',
        dataType:'json',
        data:{llenar_clientes:':)'},
        success:function(data){
            for (var i=0; i<(data.length); i=i+5) {
                $('#tbt_clientes').dataTable().fnAddData([
                  data[i+0],
                  data[i+1],
                  data[i+2],
                  data[i+3],
                  data[i+4]
                ]);
            }
        }
    });


});
    function renovar() {
        $('#tabla_horas tbody tr td label input').removeClass('animated bounceOut');
        $('#tabla_horas tbody tr td label input').removeAttr('checked');
    }
    function renovar1() {
        $('#txt_tarifa1').removeClass('animated wobble');
        $('#txt_tarifa2').removeClass('animated wobble');
    }
    function seleccion_cliente(id){
        $.ajax({
            url:'app.php',
            type:'POST',
            dataType:'json',
            data:{llenar_clientes_datos:':)',id:id},
            success:function(data){
                $('#lbl_ced').html(data[0])
                $('#lbl_nom').html(data[1])
                $('#lbl_tel').html(data[2])
                $('#lbl_dir').html(data[3])
                $('#lbl_cor').html(data[4])
                $('#lbl_id_cliente').html(id);
            }
        });
        $.ajax({
            url:'app.php',
            type:'POST',
            // dataType:'json',
            data:{mostrar_cliente_reservaciones:':)',id:id},
            success:function(data){
                $('#obj_reservaciones').html(data);
            }
        });
        $('#modal-cliente').modal('hide');
    }
    function miseri(){
        return $('#txt_id_reservacion').val();
    }
    function accion_reservacion(event){
        $('#modal-encuesta').modal('show');
        var valor=event.target.value;
        var tar = event.target;
        $(tar).attr('checked','');
        var id = $(tar).attr('id');
        var id=id.split(',');
        $('#txt_id_reservacion').val(id[0]);
        //editables on first profile page
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
                                    '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';
        //editables
        console.log(id[0]);
        $('#lbl_niños').editable({
            type: 'spinner',
            name : 'age',
            spinner : {
                min : 0, max:99, step:1
            },
            pk:    miseri(),
            name:  'niños',
            url:   'app.php'
        });
        $('#lbl_mujeres').editable({
             type: 'spinner',
            name : 'age',
            spinner : {
                min : 0, max:99, step:1
            },
            pk:    miseri(),
            name:  'mujeres',
            url:   'app.php'
        });
        $('#lbl_rango_edades').editable({
             type: 'spinner',
            name : 'age',
            spinner : {
                min : 0, max:99, step:1
            },
            pk:    miseri(),
            name:  'rango',
            url:   'app.php'
        });
        // $.ajax({
        //     url:'app.php',
        //     type:'POST',
        //     // dataType:'json',
        //     data:{mostrar_servicios_reservacion:':)',id:id[0], id_s:id[1]},
        //     success:function(data){
        //         $('#select_categoria').html(data);
        //         $('#select_categoria').trigger('liszt:updated');
        //     }
        // });
    }
    function ejemplo(event){
        var valor=event.target.value;
        var tar = event.target;
        var id_elemento=$(tar).attr('id');
        var elemento=document.getElementById(id_elemento);
        var extraccion=id_elemento.split(',');
        var id_tar=extraccion[0].replace('lbl_','');
        var ident=0;
        $.ajax({
            url:'app.php',
            type:'POST',
            async:false,
            dataType:'json',
            data:{mostrar_reservacion_tarifa:':)',id_reservacion:extraccion[1], id_tarifa:id_tar},
            success:function(response){
                iden=response[0];
            }
        });
        $(elemento).editable({
            name:'actualiar_tafira_reservacion',
            type: 'spinner',
            value:iden,
            pk: {id_tarifa:id_elemento,id_reserva:2,c:3},
            spinner : { min : 0, max:99, step:1  },
            url:'app.php',
            validate: function(value) {
              if($.trim(value) == '')
                return false;
            },
            success:function(response, newValue){
                response=response.split('lbl_')
                var valor=$('#pre_'+response[1]).text();
                var valor=parseFloat(valor);
                var cantidad=newValue;
                var total=$('#tot_'+response[1]).text((valor*cantidad).toFixed(2));
                var subtotal_=0;
                $('#obj_tarifas_total li').each(function(n,v){
                    subtotal_=subtotal_+parseFloat($(this).text());
                });
                $('#lbl_subtotal').html(subtotal_.toFixed(2));
                var iva_=iva_dc(response[2]);
                var impuesto_=0;
                if (iva_!='0') {
                    impuesto_=subtotal_*iva_/100;
                    $('#lbl_iva_dc_opt').html('IVA: '+iva_);
                }

                $('#lbl_iva').html(impuesto_.toFixed(2));
                $('#lbl_total').html('<h5 class="bigger center" >'+(impuesto_+subtotal_).toFixed(2)+'</h5>');

                if (response[0]==0) {
                    $.gritter.add({
                        title: '<h1 class="icon-ok" style="color: #336699;">Información Actualizada</h1>',
                        text: '',
                        time: 4000
                    });
                };
                if (response[0]!=0) {
                    $.gritter.add({
                        title: '<h1 class="icon-ok" style="color: #336699;">Comunicar admin</h1>',
                        text: 'Proceso fuera de db-56',
                        time: 4000
                    });
                }
            }
        });
    }
    function subtotal(valor){
        var iden=valor.split(',');
        var subnuevo=iden[1];
        var valor=parseFloat(subnuevo);
        var subtotal=$('#lbl_subtotal').html();
        var subtotal=parseFloat(subtotal);
        var total=subtotal+valor;
        var impuesto_iva=iva_dc(iden[0]);
        var iva=(parseFloat(impuesto_iva)*total)/100;
        $('#lbl_subtotal').html(total.toFixed(2));
        $('#lbl_iva').html(iva.toFixed(2));
        $('#lbl_iva_dc_opt').html('IVA: '+impuesto_iva);
        $('#lbl_total').html('<h5 class="bigger center" >'+(iva+total).toFixed(2)+'</h5>');
    }
    function iva_dc(id){
        var resultado;
        $.ajax({
            url:'app.php',
            type:'POST',
            async:false,
            data:{impuesto:'ok',id:id},
            success:function(response){
                resultado=response;
            }
        });
        return resultado;
    }



$('#form-validar').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        txt_niños: {
            required: true,
            digit:true
        },
        txt_mujeres: {
            required: true,
            digit:true
        },
        sel_rango: {
            required: true
        }
    },
    messages: {
        txt_niños: {
            required: 'Información requerida',
            digit:'Solo numeros'
        },
        txt_mujeres: {
            required: 'Información requerida',
            digit:'Solo numeros'
        },
        sele_rango: {
            required: 'Información requerida'
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit
        $('.alert-error', $('.login-form')).show();
    },
    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },
    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('info');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        alert('hola mundo')
    },
    invalidHandler: function (form) {
        alert('fallast')
    }
});
