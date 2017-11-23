$(function(){
    $('#AjaxRequest').submit(function(){
        var form = $(this).serialize();//transforma em string e valor
        //var formArray = $(this).serializeArray();transforma em objetos
        var request = $.ajax({
            method:"POST",
            url:"post.php",
            data: form,
            dataType: "json"
        });

        /* Pegar campos doformulário um por um
        var request = $.ajax({
            method:"POST",
            url:"post.php",
            data:{
                name: $(':input[name=name]').val(),
                email:$(':input[name=email]').val(),
                tel:$(':input[name=tel]').val()
            }
        });
        */

        request.done(function(e){
            //console.log(e);
            $('#msg').html(e.msg);
            //for (var k in e) {
            //    $(':input[name='+k+']').val(e[k]);
            //}
            if (e.status){
                $('#AjaxRequest').each(function(){
                    this.reset();
                });
            }
        });
        request.fail(function(e){
            console.log("fail");
            console.log(e);
        });
        request.always(function(e){
            console.log("always");
            console.log(e);
        });

        return false;
    });
});