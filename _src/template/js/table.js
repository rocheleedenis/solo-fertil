$(document).ready(function(){
    function generic(){
        var a = parseFloat($('#iAluminio').val());
        var b = parseFloat($('#iMagnesio').val());
        var c = parseFloat($('#iPotassio').val());
        var d = parseFloat($('#iCalcio').val());

        var x = c*0.002558+d+a+b;
        var y = 100*a/x;

        if(Number.isNaN(x)){
            $('#iCtcEfetiva').val('');
            $('#iIndiceM').val('');
        }else{
            $('#iCtcEfetiva').val(x.toFixed(2));
            $('#iIndiceM').val(y.toFixed(2));
        }
    }

    function generic2(){
        var a = parseFloat($("#iSB").val());
        var b = parseFloat($("#iHAl").val());
        
        var x = a+b;
        var y = 100*a/(a+b);

        if(Number.isNaN(x)){
            $("#iCtcPH7").val('');
            $("#iV").val('');
        }else{
            $("#iCtcPH7").val(x.toFixed(2));
            $("#iV").val(y.toFixed(2));
        }
    }

    $("#iPotassio").keyup(function(){
    	generic();
    });
    $("#iPotassio").focus(function(){
        generic();
    });

    $("#iCalcio").keyup(function(){
    	generic();
    });
    $("#iCalcio").focus(function(){
        generic();
    });

    $("#iMagnesio").keyup(function(){
    	generic();
    });
    $("#iMagnesio").focus(function(){
        generic();
    });

    $("#iAluminio").keyup(function(){
    	generic();
    });
    $("#iAluminio").focus(function(){
        generic();
    });

    $("#iSB").keyup(function(){
        generic2();
    });
    $("#iSB").focus(function(){
        generic2();
    });

    $("#iHAl").keyup(function(){
    	generic2();
    });
     $("#iHAl").focus(function(){
        generic2();
    });

    $("#iLimpar").on("click", function(){
        $("#iPH").prop("value","");
        $("#iFosforo").prop("value","");
        $("#iPotassio").prop("value","");
        $("#iCalcio").prop("value","");
        $("#iMagnesio").prop("value","");
        $("#iAluminio").prop("value","");
        $("#iHAl").prop("value","");
        $("#iSB").prop("value","");
        $("#iMO").prop("value","");
        $("#iArgila").prop("value","");
        $("#iPrem").prop("value","");
        $("#iV").prop("value","");
        $("#iCtcEfetiva").prop("value","");
        $("#iCtcPH7").prop("value","");
        $("#iIndiceM").prop("value","");
    });
});

                    

