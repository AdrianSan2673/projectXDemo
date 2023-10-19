<div class="content-wrapper">
    <div class="container mt-5">
        <div class="content pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-5">Introducir datos de pago</h5>
                                <div class="text-center">
                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <b>Repasa tu pedido</b>
                                <p>Plantilla <?=str_replace('Resume', '', $_SESSION['data']->template)?> de CV</p>
                                <p>Acceso de 14 días</p>
                            </div>
                            <div class="card-footer row">
                                <div class="col-6">
                                    <b>Total a pagar:</b>
                                </div>
                                <div class="col-6 text-right">
                                    <b>MXN 20.00</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=<?= key_paypal ?>&currency=MXN&components=buttons,marks,messages"></script>
<script>
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
            return actions.order.create({

                application_context: {
                    shipping_preference: "NO_SHIPPING"
                },
                payer: {
                    email_address: '<?= $_SESSION['data']->email ?>',
                    name: {
                        given_name: '<?= $_SESSION['data']->first_name ?>',
                        surname: '<?= $_SESSION['data']->surname ?>'
                    },
                    address: {
                        country_code: "MX"
                    }
                },
                purchase_units: [{
                    amount: {
                        value: '20.00' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                    }
                }]
            });
        },
        onError: function(err) {
            console.log(err);
            Swal.fire({
                icon: 'error',
                title: 'ERROR',
                text: 'Ocurrio un error con las transacción, no se ha hecho ningun cargo.',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        },

        // Finalize the transaction after payer approval
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                if (details.status == 'COMPLETED') {
                    let id_transaction = details.purchase_units[0].payments.captures[0].id;
                    let fullPayment = '20.00';
                    Swal.fire(
                        'Espera',
                        'Por favor, espera unos segundos para la confirmacion del pago.',
                        'info'
                    )
                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '../Candidato/pay');
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send("fullpayment=" + fullpayment + '&paypalId=' + paypalId + '&paypalEmail=' + paypalEmail);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            let r = this.responseText;
                            console.log(r);
                            try {
                                let json_app = JSON.parse(r);
                                if (json_app.status == 0) {
                                    utils.showToast('Omitiste algún dato', 'error');
                                } else if (json_app.status == 1) {
                                    //utils.showToast('Pagado correctamente.', 'success');
                                    Swal.fire({
                                        imageUrl: base_url + 'dist/img/RRHHIngenia-Website2020_LogoHeader.svg',
                                        title: 'Pago completado',
                                        text: 'Su pago fue completado con éxito.',
                                        showClass: {
                                            popup: 'animate__animated animate__fadeInDown'
                                        },
                                        hideClass: {
                                            popup: 'animate__animated animate__fadeOutUp'
                                        }
                                    })

                                    setTimeout(() => {
                                        window.location.href = '../candidato/purchase'
                                    }, 3000);
                                } else if (json_app.status == 2) {
                                    utils.showToast('Servicio cancelado', 'success');
                                } else if (json_app.status == 3) {
                                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                                } else {
                                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                                }
                            } catch (error) {
                                utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                            }
                        }
                    }
                } else {
                    
                }
            });
        }
    }).render('#paypal-button-container');
</script>