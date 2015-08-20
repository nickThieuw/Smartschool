$(document).ready(function() {

$('#voornaam').on('input', function() {
        var input=$(this);
    var is_name=input.val();
    if(is_name){
        $('#voornaam').parent().removeClass("has-error").addClass("has-success");
        $('#voornaamControl').removeClass("glyphicon-thumbs-down").addClass("glyphicon-thumbs-up");
    }
    else{
         $('#voornaam').parent().removeClass("has-success").addClass("has-error");
        $('#voornaamControl').removeClass("glyphicon-thumbs-up").addClass("glyphicon-thumbs-down");
    }
    
$('#familienaam').on('input', function() {
        var input=$(this);
    var is_name=input.val();
    if(is_name){
        $('#familienaam').parent().removeClass("has-error").addClass("has-success");
        $("#familienaamControl").removeClass("glyphicon-thumbs-down").addClass("glyphicon-thumbs-up");
    }
    else{
        $('#familienaam').parent().removeClass("has-success").addClass("has-error");
       $("#familienaamControl").removeClass("glyphicon-thumbs-up").addClass("glyphicon-thumbs-down");
    }
});
  $("#familienaam").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
    if(e.which < 97 /* a */ || e.which > 122 /* z */) {
        $("#errmsg2").html("Alleen letters a.u.b.").show().fadeOut("slow");
               return false;     
    }
});
});
  $("#voornaam").keypress(function (e) {
    if(e.which < 97 /* a */ || e.which > 122 /* z */) {
        $("#errmsg1").html("Alleen letters a.u.b.").show().fadeOut("slow");
               return false;     
    }
});
});


