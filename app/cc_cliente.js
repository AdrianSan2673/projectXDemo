function cc_clientes(id_cliente) {

    const contenedor = document.querySelectorAll('.form-group')[16];
    const inputElement = document.querySelector('[name="CC_Cliente"]');
    const nuevoSelect = document.createElement('select');
    nuevoSelect.className = 'form-control';
    nuevoSelect.setAttribute('name', 'CC_Cliente');
    nuevoSelect.required = true;


    let opciones = [{
        value: '',
        text: 'Selecciona centro de costo',
        disabled: true,
        selected: true
    }]


    if (id_cliente == 705) {
        opciones = [{
                value: 'veracruz',
                text: 'Veracruz'
            },
            {
                value: 'colima',
                text: 'Colima'
            },
            {
                value: 'Penjamo Guanajuato',
                text: 'Penjamo Guanajuato'
            },
            {
                value: 'guaymas',
                text: 'Guaymas'
            }
        ];
        //De aqui para abajo son CC de empresa dalto
    } else if (id_cliente == 760) { //Body Shop	
        opciones = [{
                value: 'Lopez Mateos - DBSLM',
                text: 'Lopez Mateos - DBSLM'
            },
            {
                value: 'Americas - DBSAM',
                text: 'Americas - DBSAM'
            },
            {
                value: 'Gonzalez Gallo - DBSGG',
                text: 'Gonzalez Gallo - DBSGG'
            },
            {
                value: 'Patria - DBSP',
                text: 'Patria - DBSP'
            },

        ];


    } else if (id_cliente == 757) { //BYD
        opciones = [{
            value: 'Plaza Patria - DBYC',
            text: 'Plaza Patria - DBYC'
        }];

    } else if (id_cliente == 756) { //Chirey
        opciones = [{
                value: 'Lopez Mateos - DCLO',
                text: 'Lopez Mateos - DCLO'
            },
            {
                value: 'Gonzalez Gallo - DCGG',
                text: 'Gonzalez Gallo - DCGG'
            },

        ];

    } else if (id_cliente == 762) { //CORPORACION
        opciones = [{
            value: 'Av. Vallarta - Corporativo',
            text: 'Av. Vallarta - Corporativo'
        }];

    } else if (id_cliente == 761) { //DES
        opciones = [{
            value: 'Lopez Mateos - DES',
            text: 'Lopez Mateos - DES'
        }];

    } else if (id_cliente == 759) { //Dimofi de mexico
        opciones = [{
            value: 'Patria - DIMOFI GDL',
            text: 'Patria - DIMOFI GDL'
        }];
    } else if (id_cliente == 754) { //Honda
        opciones = [{
                value: 'Lopez Mateos - DHEXC',
                text: 'Lopez Mateos - DHEXC'
            },
            {
                value: 'Colomos Contry - DHCC',
                text: 'Colomos Contry - DHCC'
            },
            {
                value: 'Centro Magno	- DHCM',
                text: 'Centro Magno	- DHCM'
            },
            {
                value: 'Acueducto - DHA',
                text: 'Acueducto - DHA'
            },

        ];

    } else if (id_cliente == 753) { //Hyundai
        opciones = [{
                value: 'Colomos Contry - DHYC',
                text: 'Colomos Contry - DHYC'
            }

        ];
    } else if (id_cliente == 714) { //KIA
        opciones = [{
                value: 'Lopez Mateos - DKLM',
                text: 'Lopez Mateos - DKLM'
            },
            {
                value: 'Colomos Contry - DKCC',
                text: 'Colomos Contry - DKCC'
            },
        ];
    } else if (id_cliente == 755) { //Omoda
        opciones = [{
                value: 'Lopez Mateos - DOLM',
                text: 'Lopez Mateos - DOLM'
            },
            {
                value: 'Colomos Contry - DOCC',
                text: 'Colomos Contry - DOCC'
            },
        ];
    } else if (id_cliente == 758) { //Seminuevos
        opciones = [{
            value: 'Lopez Mateos - DSNGDL',
            text: 'Lopez Mateos - DSNGDL'
        }];
    } else if (id_cliente == 752) { //Toyota
        opciones = [{
                value: 'Lopez Mateos - DTLM',
                text: 'Lopez Mateos - DTLM'
            },
            {
                value: 'Patria - DTP',
                text: 'Patria - DTP'
            }
        ];
    } else {
        opciones = [{
            value: '',
            text: 'Sin Centro de costos'
        }];
    }

    opciones.forEach(opcion => {
        const optionElement = document.createElement('option');
        optionElement.value = opcion.value;
        optionElement.textContent = opcion.text;
        if (opcion.disabled) optionElement.disabled = true;
        if (opcion.selected) optionElement.selected = true;
        nuevoSelect.appendChild(optionElement);
    });

    // Reemplazar el elemento input por el nuevo select
    contenedor.replaceChild(nuevoSelect, inputElement);
}

