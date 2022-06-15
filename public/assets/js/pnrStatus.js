var form = $("#pnr_form");

var validator = $('form').validate({
    ignore: 'input[type="button"],input[type="submit"]',
    rules: {
        name: {
            required: true,
            alpha: true
        },
        email: {
            email: true,
        },
        
        pincode:{
            required:true,
          
        },
        city:{
            required:true,
            alpha: true
        },
        mobile:{
            required:true,
            validateNumber:true,
          
        },
        otp:{
            required:true
        },
        password:{
            required:true,
          //  password:true

        },
        terms:{
            required:true
        }
    },
    errorElement: "div",
    errorPlacement: function(error, element) {
        if (element.is(":checkbox")) {
            error.appendTo(element.parent().parent().children('.col-11'));
        }
        else {
            error.insertAfter(element);
        }
    },
});



$.validator.addMethod(
    "alpha",
    function (value, elem) {
        var re = /^([a-zA-Z {} () @ | ? $]+)$/;
        return re.test(value);
    },
    "Only characters Allowed"
);

$.validator.addMethod('email',
    function (value, elem) {
        hasFocus = document.activeElement === elem;
        if (hasFocus === false) {
            var re = /^[A-Za-z0-9.]+@[a-z0-9.-]+$/;
            value = value.toLowerCase();
           
            return re.test(value);
        }
        return true;
    },
    'Please enter valid Email Id'
);

$.validator.addMethod('validateNumber',
    function (value, elem) {
        hasFocus = document.activeElement === elem;
        if (hasFocus === false) {
            var re = /^[6-9]\d{9}$/;
            return re.test(value);
            
        }
        return true;
    },
    'Please Enter Valid Mobile Number'
    
);

//message for error
// $('input[name=mobile]').on('input', function () {
//     var mobile_regex = /^[6-9][0-9]{9}$/;
//     if ($(this).val().match(mobile_regex)) {
//         $("#input-box-field").css("display", "block");
        
//     } else {
//         if($(this).val()!="")
//         {
//         $("#input-box-field").css("display", "none");
     
//         }
         
//     }
// });

$.validator.addMethod('password',
    function (value, elem) {
        hasFocus = document.activeElement === elem;
        if (hasFocus === false) {
            var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            return re.test(value);
            
        }
        return true;
    },
    'Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character'
    
);


