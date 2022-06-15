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

// $.validator.addMethod('password',
//     function (value, elem) {
//         hasFocus = document.activeElement === elem;
//         if (hasFocus === false) {
//             var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
//             return re.test(value);
            
//         }
//         return true;
//     },
//     'Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character'
    
// );



let resendOTPInterval;
$(document).on('input', "input[name='mobile']", function () {
    let el = $(this);
    var mobile_regex = /^[6-9][0-9]{9}$/;
   
    if (el.val().length === 10 && el.valid() && el.val().match(mobile_regex)) {
        // el.prop('disabled', true);
       
        $('#temp').show();   
        sendOTP();
      
    }else{
        $('#temp').hide();   
    }
  
});

function startResendOTPInterval() {
    if (typeof resendOTPInterval !== 'undefined') {
        clearInterval(resendOTPInterval);
    }
    
    let sendOtp = $("#send-otp");
    let idleResendOTPWaitTime = 30; //seconds
    let time = idleResendOTPWaitTime;
    sendOtp.html(`OTP sent`);
    sendOtp.prop('disabled', true);
    setTimeout(function () {
        resendOTPInterval = setInterval(function () {
            sendOtp.html(`Resend in ${time} Sec`)
            time--;
            if (time < 1) {
                clearInterval(resendOTPInterval);
                sendOtp.prop('disabled', false);
                sendOtp.html('Resend OTP');
                $("input[name='mobile']").prop('disabled', false);
            }
        }, 1000);
    }, 3000);
}
$(document).on('click', "#send-otp", function () {
    let el = $(this);
    el.attr('OTP Sent');
    let mobile = $("input[name='mobile']");
    if (mobile.val() != '') {
        el.html('Resend OTP');
        sendOTP();
    } else {
        $("#mobile-err-msg").html('This field is required').show();
    }
});


function sendOTP() {
    startResendOTPInterval();
    // $('.loader').show();
    let url = $('#send-otp-url').val();
    let params = {
        mobile: $("input[name='mobile']").val(),
    };
    callApi(url, params).then((res) => {
        console.log(res);
        // $('.loader').hide();
         $("#mobile-err-msg").html(res.message).removeClass('text-danger').addClass('text-warning').show();
    }).catch((err) => {
       // $('.loader').hide();
      
        console.log(err.responseJSON.message);
        $("#mobile-err-msg").html(err.responseJSON.message).show(); 
    });
}


$(document).on('input', "input[name='otp']", function () {
    let el = $(this);
    if (el.val().length === 4 && el.valid()) {
      
        let url = $('#verify-otp-url').val();
        let params = {
            mobile: $("input[name='mobile']").val(),
            otp: $("input[name='otp']").val(),
            _token: $('#csrf_token').val(),
          
        };
        callApi(url, params).then((res) => {
            // console.log('res');
            $("#send-otp").hide();
            $("#otp-err-msg").css('color','green');
            $("#otp-err-msg").html(res.message).show();
           
           
            
        }).catch((err) => {
            // console.log(err);
            // return false;
            $('.loader').hide();
            $("#otp-err-msg").css('color','red');
            $("#otp-err-msg").text(JSON.parse(err.responseText).message).show();
           
           
        });
        
 
    }else{
        $('#otp-err-msg').hide();
        $('#send-otp').show(); 
    }
});



