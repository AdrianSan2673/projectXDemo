$(document).ready(function(){
    $("#contact_submit").on("click", e =>{

        let name = $("#name").val();
        let enterprise = $("#enterprise").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let subject = $("#subject").val();
        let message = $("#message").val();

        let data = {
            name: name,
            enterprise: enterprise,
            email: email,
            phone: phone,
            subject: subject,
            message: message
        };

        if(name.length > 0 && enterprise.length > 0 && email.length > 0 && phone.length > 0 && subject.length > 0 && message.length > 0){
            $.ajax({
                type: "POST",
                url: "./send",
                data: data
            })
            e.preventDefault();
            showSuccess('top', 'center', "Gracias por sus comentarios, nos comunicaremos con usted lo más pronto posible");
            $("#contact_form").trigger('reset');
        }
    });

    function showSuccess (from, align, message){
        type = ['success'];
        
        $.notify({
            message: message
    
        },{
            type: type,
            timer: 2000,
            placement: {
                from: from,
                align: align
            }
        });
    }
});