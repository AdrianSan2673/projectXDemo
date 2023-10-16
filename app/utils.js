var utils = {
	isEmail: function(email) {
        var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email) ? true : false;
    },

    showToast: function(title, icon){
    	const Toast = Swal.mixin({
	      toast: true,
	      position: 'top-end',
	      showConfirmButton: false,
	      timer: 8000
	    });

	    Toast.fire({
	        icon: icon,
	        title: title
	     });
	},
	dtTable: function (id, responsive = true) {
		var table = $(id).DataTable({
		  	"responsive": responsive,
			"autoWidth": false,
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
			"pageLength": 50,
			"order": [],
		  	"oLanguage": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ ",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
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
				},
				"buttons": {
					"copy": "Copiar",
					"colvis": "Visibilidad"
				}
			},
			"dom": 'lBfrtip',
	        "buttons": [
	            'copyHtml5',
				{
					extend: 'excel',
					text: '<i class="fas fa-file-excel"></i>',
					titleAttr: 'Exportar a excel',
					className: 'btn btn-success',
					customize: function(xlsx) {
						var sheet = xlsx.xl.worksheets['sheet1.xml'];
						let styles = xlsx.xl['styles.xml']; // Get current styles

						let last_fills_index = $('cellXfs fills', styles).length - 1;
						let last_xf_index = $('cellXfs xf', styles).length - 1;
						let fill_orange = '<fill><patternFill patternType="solid"><fgColor rgb="ffffb024" /><bgColor indexed="64" /></patternFill></fill>';
						let style_fill_orange = '<xf numFmtId="0" fontId="4" fillId="' + (last_fills_index + 1) + '" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>';

						styles.childNodes[0].childNodes[2].innerHTML += fill_orange; // childNodes[2] -> fills
						styles.childNodes[0].childNodes[5].innerHTML += style_fill_orange; // childNodes[5] -> cell xfs

						let sOrangeBackground = last_xf_index + 1;

						// Loop over the cells in column `K`
						$('row c*', sheet).each( function () {
							var color = $('is t', this).css('background-color');
							// Get the value
							if ( $('is t', this).text() == 'Cindy Paola Luna Delfín' ) {
								$(this).attr( 's',  '20');
							}
							if ( $('is t', this).text() == 'Janet Monserrat Gómez López' ) {
								$(this).attr( 's', '42' );
							}
							if ( $('is t', this).text() == 'Karina De Monserrat Cervantes Puente' ) {
								$(this).attr( 's', '35' );
							}

							if ( $('is t', this).text() == 'María Graciela López Rodríguez' ) {
								$(this).attr( 's', sOrangeBackground );
							}
						});
					}
				},
	            
	            {
					extend: 'pdfHtml5',
					//text: '<i class="fas fa-file-pdf"></i>',
					//titleAttr: 'Exportar a PDF',
					className: 'btn btn-danger',
					orientation: 'landscape',
					pageSize: 'LEGAL'	
				}
				
			],
			"stateSave": id.id == 'tb_facturacion' || id.id == 'tb_unpaid_bills' ? true : false,
			"bDestroy": id.id == 'tb_facturacion' || id.id == 'tb_unpaid_bills' ? true : false,
			initComplete: function () {
				/* if (candidates) {
					this.api().columns().every( function (e) {
						var column = this;
						if (e > 1 && e <= 5) {
							var select = $('<select class="form-control"><option value="">-</option></select>')
								.appendTo( $(column.header()))
								.on( 'change', function () {
									var val = $.fn.dataTable.util.escapeRegex(
										$(this).val()
									);
			
									column
										.search( val ? '^'+val+'$' : '', true, false )
										.draw();
								} );
							column.data().unique().sort().each( function ( d, j ) {
								select.append( '<option value="'+d+'">'+d+'</option>' )
							} );
						}
						
					} );
				} */
				
				/* if (servicios) {
					this.api().columns().every( function (e) {
						var column = this;
						if (e == 1 || (e >= 3 &&  e <= 5) || e == 7 || e == 10) {
							var select = $('<select class="form-control"><option value="">Sin filtro</option></select>')
								.appendTo( $(column.header()))
								.on( 'change', function () {
									var val = $.fn.dataTable.util.escapeRegex(
										$(this).val()
									);
			
									column
										.search( val ? '^'+val+'$' : '', true, false )
										.draw();
								} );
							column.data().unique().sort().each( function ( d, j ) {
								select.append( '<option value="'+d+'">'+d+'</option>' )
							} );
						}
						
					} );
				} */
			}
		})
		$(`#${id.id}_filter input`).wrap('<div class="input-group"></div>').after('<div class="input-group-append"><button type="button" class="btn btn-danger btn-search" title="Click to clear filter">Limpiar</button></div>').removeClass('form-control-sm').css('margin-left','0');
	
		$(`#${id.id} thead tr:eq(0) th`).each( function ( i ) {
			if (this.classList.contains('filterhead')) {
				var select = $('<select class="form-control" style="select2" style="width: 100% !important"><option value="">Sin filtro</option></select>')
				.appendTo( $(this).empty() )
				.on( 'change', function () {
				var val = $.fn.dataTable.util.escapeRegex(
					$(this).val()
				);
				table.column( i ).search(val ? '^'+val+'$' : '', true, false ).draw();
				} );
				table.column( i ).data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
				} );
			}
		} );

		document.querySelector(`#${id.id}_wrapper .btn-search`).addEventListener('click', e => {
			document.querySelector(`#${id.id}_filter input`).value = '';
			document.querySelectorAll(`#${id.id} select`).forEach(element => {
				element.value = '';
			});
			console.log('click');
			table.search('').columns().search('').draw();
		})

		if (id.id == 'tb_facturacion') {
			function showResult(){
				var countESE = table
					.column(7, {search: 'applied'})
					.data()
					.filter(function(value, index){
						return value == 'RAL + INV.LAB + ESE' || value == 'ESE' ? true : false;
					});
				document.querySelector('#no_ESE').textContent = countESE.count();

				var countINV = table
					.column(7, {search: 'applied'})
					.data()
					.filter(function(value, index){
						return value == 'RAL + INV.LAB' || value == 'INV. LABORAL' ? true : false;
					});
				document.querySelector('#no_INV').textContent = countINV.count();

				var countRAL = table
					.column(7, {search: 'applied'})
					.data()
					.filter(function(value, index){
						return value == 'RAL' ? true : false;
					});
				document.querySelector('#no_RAL').textContent = countRAL.count();

				var countFactura = table
					.column(12, {search: 'applied'})
					.data()
					.filter(function(value, index){
						return value.substr(0, 2) == 'F-' ? true : false;
				})
				document.querySelector('#no_facturadas').textContent = countFactura.count();

				var countOrden = table
					.column(12, {search: 'applied'})
					.data()
					.filter(function(value, index){
						return value.substr(0, 2) != 'F-' && value != '' ? true : false;
				})
				document.querySelector('#no_ordenes').textContent = countOrden.count();
			}
			document.querySelector(`#${id.id}_filter`).addEventListener('input', function(){
				window.setTimeout(showResult, 90);
			})

			document.querySelector(`#${id.id}`).addEventListener('change', function(){
				window.setTimeout(showResult, 90);
			})

			window.setTimeout(showResult, 90);
		}
	},	

	previewImage: function(image){
		image.onchange = function(e) {
			let reader = new FileReader();
		  
		  reader.onload = function(){
			let preview = document.getElementById('preview'),
				image = document.createElement('img');
		
			image.src = reader.result;
			
			preview.innerHTML = '';
			preview.append(image);
		  };
		 
		  reader.readAsDataURL(e.target.files[0]);
		}
	},

	getParameterByName: function(name){
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    	results = regex.exec(location.search);
    	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	},

	getStyle: function (el, cssprop) {
		if (el.currentStyle)
			return el.currentStyle[cssprop];	 // IE
		else if (document.defaultView && document.defaultView.getComputedStyle)
			return document.defaultView.getComputedStyle(el, "")[cssprop];	// Firefox
		else
			return el.style[cssprop]; //try and get inline style
	},
	
	applyEdit: function (tabID, editables) {
		var tab = document.getElementById(tabID);
		if (tab) {
			var rows = tab.getElementsByTagName("tr");
			for(var r = 0; r < rows.length; r++) {
				var tds = rows[r].getElementsByTagName("td");
				for (var c = 0; c < tds.length; c++) {
					if (editables.indexOf(c) > -1)
						tds[c].onclick = function () { utils.beginEdit(this); };
				}
			}
		}
	},
	
	beginEdit: function (td) {
		var oldColor, oldText, padTop, padBottom = "";
		if (td.firstChild && td.firstChild.tagName == "INPUT")
			return;
	
		oldText = td.innerHTML.trim();
		oldColor = utils.getStyle(td, "backgroundColor");
		padTop = utils.getStyle(td, "paddingTop");
		padBottom = utils.getStyle(td, "paddingBottom");
	
		var input = document.createElement("input");
		input.value = oldText;
	
		//// ------- input style -------
		var left = utils.getStyle(td, "paddingLeft").replace("px", "");
		var right = utils.getStyle(td, "paddingRight").replace("px", "");
		input.style.width = td.offsetWidth - left - right - (td.clientLeft * 2) - 2 + "px";
		input.style.height = td.offsetHeight - (td.clientTop * 2) - 2 + "px";
		input.style.border = "0px";
		input.style.fontFamily = "inherit";
		input.style.fontSize = "inherit";
		input.style.textAlign = "inherit";
		input.style.backgroundColor = "LightGoldenRodYellow";
	
		input.onblur = function () { utils.endEdit(this, oldColor, oldText, padTop, padBottom); };
	
		td.innerHTML = "";
		td.style.paddingTop = "0px";
		td.style.paddingBottom = "0px";
		td.style.backgroundColor = "LightGoldenRodYellow";
		td.insertBefore(input, td.firstChild);
		input.select();
	},
	endEdit: function (input, oldColor, oldText, padTop, padBottom) {
		var td = input.parentNode;
		td.removeChild(td.firstChild);	//remove input
		td.innerHTML = input.value;
		if (oldText != input.value.trim() ){
			td.style.color = "red";
			let Candidato = td.parentElement.children[14].textContent;
			let Cliente = td.parentElement.children[2].textContent;
			let ID_Cliente = td.parentElement.children[15].textContent;
			let Razon_Social = td.parentElement.children[3].textContent;
			let Factura = input.value.trim();
			let administracion = new Administracion();
      		administracion.update_folio_new(Candidato, Cliente, ID_Cliente, Razon_Social, Factura);
			let estadoClass = 'align-middle text-center ';
			if (Factura.substr(0, 2) == 'F-'){
				td.parentElement.children[8].className = estadoClass+'table-info';
				td.parentElement.children[8].textContent = 'Facturado';
			}else{
				td.parentElement.children[8].className = estadoClass+'bg-primary';
				td.parentElement.children[8].textContent = 'Finalizado';
			}
			let table = document.querySelector('#tb_facturacion');
    		utils.dtTable(table, true);
		}
		td.style.paddingTop = padTop;
		td.style.paddingBottom = padBottom;
		td.style.backgroundColor = oldColor;
	},
	destruir_datatable: function (id_table, tbody, cuerpo) {
		$(id_table).DataTable().destroy();
		document.querySelector(tbody).innerHTML = cuerpo;

		let table = document.querySelector(id_table);
		table.style.display = "table";
		utils.dtTable(table, true);
	}
}