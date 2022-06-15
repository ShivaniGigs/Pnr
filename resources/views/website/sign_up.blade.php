
@extends('website.layout.app')
@section('title', 'PNR STATUS | Sign Up')

@section('content')
@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>
            {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
        </strong>
    </div>
@endif

{{-- content --}}

{{-- <div class="ui container">
    <div class="ui column grid">
        <div class="column">
            <div class="ui horizontal segments sign-up">
                <div class="ui segment pnr-status-bg">
                    <img src="../assets/images/pnr-status-bg.webp" alt="Pnr-status" title="PNR Status"/>
                </div>
                <div class="ui segment sign-up-box">
                    <div class="have-login">Already have an account?<a href="#">Log In</a></div>
                    <div class="sign-up-form">
                        <div class="sign-up-header">
                            <img src="../assets/images/sign-up-icon.svg" alt="sign-up"/>
                            <h1>Sign Up</h1>
                        </div>
                        <div class="sign-up-para">
                            <p>Users with can edit access to a file can add Auto layout</p>
                        </div>
                        <form>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="ui grid centered container">
    <div class="ui horizontal segments stackable two column grid p-0 pnr-status-whole-bg">
        <div class="row">
            <div class="eight wide tablet nine wide computer column sign-up px-0">
                <div class="pnr-status-bg">
                    <img src="../assets/images/pnr-status-bg.webp" alt="Pnr-status" title="PNR Status"/>
                </div>
                <div class="ui three column grid">
                    <div class="six wide column check-pnr-text">
                        <h2>Check your <br> <span class="pnr-status-text">PNR STATUS</span></h2>
                    </div>
                    <div class="four wide column check-pnr-arrow">
                        <img src="../assets/images/check-pnr-arrow.webp" alt="check-pnr-arrow">
                    </div>
                    <div class="six wide column get-the-app">
                        <h3>Get the app on</h3>
                        <img src="../assets/images/google-play-android.webp" alt="google-play-android">
                    </div>
                </div>
            </div>
            <div class="eight wide tablet seven wide computer column px-0">
                <div class="ui segment sign-up-box">
                    <div class="have-login">Already have an account?<a href="#">Log In</a></div>
                    <div class="ui segments sign-up-form">
                        <div class="sign-up-header">
                            <img src="../assets/images/sign-up-icon.svg" alt="sign-up"/>
                            <h1>Sign Up</h1>
                        </div>
                        <div class="sign-up-para">
                            <p>Users with can edit access to a file can add Auto layout</p>
                        </div>
                        <div class="ui clearing divider"></div>
                        <form>
                            <div class="ui form">
                                <div class="fields">
                                    <div class="eight wide field">
                                        <label>First Name <span class="error-red">*</span></label>
                                        <input type="text" placeholder="Enter first Name" >
                                    </div>
                                    <div class="eight wide field">
                                        <label>Last Name <span class="error-red">*</span></label>
                                        <input type="text" placeholder="Enter last name" >
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="eight wide field">
                                        <label>Mobile Number <span class="error-red">*</span></label>
                                        <input type="number" placeholder="Enter your number" >
                                    </div>
                                    <div class="eight wide field">
                                        <label>OTP (verification code) <span class="error-red">*</span></label>
                                        <div class="fields otp-fields">
                                            <div class="field">
                                                <input type="number" placeholder="-" >
                                            </div>
                                            <div class="field">
                                                <input type="number" placeholder="-" >
                                            </div>
                                            <div class="field">
                                                <input type="number" placeholder="-" >
                                            </div>
                                            <div class="field">
                                                <input type="number" placeholder="-" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui list otp-resend">
                                    <a class="item" href="#">Resend</a>
                                </div>
                                <div class="fields">
                                    <div class="eight wide field">
                                        <label>Email ID <span class="error-red">*</span></label>
                                        <input type="text" placeholder="example@mail.com" >
                                    </div>
                                    <div class="eight wide field">
                                        <label>Pincode <span class="error-red">*</span></label>
                                        <input type="number" placeholder="Enter pincode" >
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="eight wide field">
                                        <label>State <span class="error-red">*</span></label>
                                        <input type="text" placeholder="Enter state" >
                                    </div>
                                    <div class="eight wide field">
                                        <label>City <span class="error-red">*</span></label>
                                        <input type="text" placeholder="Enter city" >
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="sixteen wide field">
                                        <label>Create a password <span class="error-red">*</span></label>
                                        <input type="text" placeholder="atleast 8 characters" >
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="four wide field">
                                        <span class="password-strength-1"></span>
                                    </div>
                                    <div class="four wide field">
                                        <span class="password-strength-2"></span>
                                    </div>
                                    <div class="four wide field">
                                        <span class="password-strength-3"></span>
                                    </div>
                                    <div class="four wide field">
                                        <span class="password-strength-4"></span>
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="field pnr-checkbox">
                                        <div class="ui checkbox">
                                            <input type="checkbox" tabindex="0">
                                            <label>Lorem ipsum dolor amet, consectetur adipiscing elit.</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="fluid button primary-btn">Become a member</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<script src="{{asset('assets/js/pnrStatus.js')}}"></script>


<script>


  $('#pincode').on('keyup', function () {
      var pincode = $(this).val();

      if(pincode.length >= 6){
          pincode_to_city('pincode');
      }else{
          $('#city').val('');
          $("#city").attr('readonly',false);
         // $('#office_state').prop('selectedIndex',0).val();
      }
  });

 

  function pincode_to_city(id)
  {
      let pincode = $('#pincode').val();
      let url = '{{ route("find-city-by-pincode") }}?pincode='+pincode

      $.get(url, function (data, status) {

          if(data['status'] === true) {
              $("#city").val(data['city_name']);
              $("#state").val(data['state_name']);
              
              $("#city").attr('readonly',true);
              $("#state").attr('readonly',true);

          }
             else {
              $("#city").attr('readonly',false);
             $("#state").attr('readonly', false);
          }
      });
  }

 
 


  $(document).ready(function() {

    $('#email').on('keyup', function () {
      var error_email = '';
      var email = $('#email').val();
      var _token = $('input[name="_token"]').val();
      var filter =/^[A-Za-z0-9.]+@[a-z0-9.-]+$/;

      if(!filter.test(email)) {    
        $('#error_email').html('<label class="text-danger">Invalid Email</label><br/>');
        $('#email').addClass('has-error');
        $('#register').attr('disabled', 'disabled');
      } else {
        $.ajax({
          url:"{{ route('veryfiemail') }}",
          method:"POST",
          data:{email:email, _token:_token},
          success:function(result) {
          if(false == result.success){
            $('#error_email').html('<label class="text-danger">Enter Other  Email</label>');
              $('#email').addClass('has-error');
          } else {
            $('#error_email').html('<label class="text-success">Email Available</label><br/>');
              $('#email').removeClass('has-error');
          }
          
          }
        })
      }
    });
});


$('#mobile').on('keyup', function () {
      var error_mobile = '';
      var mobile = $('#mobile').val();
      var _token = $('input[name="_token"]').val();
      var filter = /^[6-9]\d{9}$/;
      if(!filter.test(mobile)) {    
        $('#error_mobile').html('<label class="text-danger">Invalid mobile</label><br/>');
        $('#mobile').addClass('has-error');
       
      } else {
        $.ajax({
          url:"{{ route('veryfiecontact') }}",
          method:"POST",
          data:{mobile:mobile, _token:_token},
          success:function(result) {
          if(false == result.success){
            $('#error_mobile').html('<label class="text-danger">Enter Other  mobile</label>');
              $('#mobile').addClass('has-error');
          } else {
            $('#error_mobile').html('<label class="text-success">mobile Available</label><br/>');
              $('#mobile').removeClass('has-error');
          }
          
          }
        })
      }
    });

  </script> 




{{-- <script>

function resentOtp(){
    var elem = document.getElementById('resend_otp_timmer');
    if(parseInt(localStorage.getItem("resend_otp_count")) < 2){
    document.getElementById('resend_otp_link').style.display = "none";
    document.getElementById('resend_otp_timmer').style.display = "inline-block";
    var timeLeft = 30;
    var timerId = setInterval(countdown, 1000);
    function countdown() {
        if (timeLeft == -1) {
            document.getElementById('resend_otp_link').style.display = "inline-block";
            document.getElementById('resend_otp_timmer').style.display = "none";
            clearTimeout(timerId);
        } else {
            elem.innerHTML = 'Resend OTP in ' + timeLeft;
            timeLeft--;
        }
    }
  }else{
            document.getElementById('resend_otp_link').style.display ="none";
            document.getElementById('resend_otp_timmer').style.display ="block";
            elem.innerHTML = 'You exceed maxmium request limit';
  }
}

    function resendOtpRequest(){
        var elem = document.getElementById('resend_otp_timmer');
        if(parseInt(localStorage.getItem("resend_otp_count")) < 2){

      let phoneNumber = document.getElementById('user_phone_number').value;
      let data = {
            "_token": "{{ csrf_token() }}",
            "phone": phoneNumber
        }
        $.ajax({
            type: "POST",
            url: "{{ route('resend-otp') }}",
            data: data,
            dataType: "json",
            success: function(data) {
                resentOtp();
                // console.log(localStorage.getItem("resend_otp_count"));
                if (localStorage.getItem("resend_otp_count") === null) {
                    localStorage.setItem("resend_otp_count", 1 );
                }else{
                    let localresend_otp_count = localStorage.getItem("resend_otp_count");
                    localStorage.setItem("resend_otp_count", parseInt(localresend_otp_count)+1 );
                }

                

                // let resetOtpCount = localStorage.getItem();
                // localStorage.setItem("otp_resend_count", resetOtpCount+1);
            },
            error: function(error) {
                console.log(error);
            }
        });

        }else{
            document.getElementById('resend_otp_timmer').style.display ="block";
            document.getElementById('resend_otp_link').style.display ="none";
            elem.innerHTML = 'You exceed maxmium request limit';
        }
    }

    // faqs accordion
    $(".collapse.show").each(function () {
        $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });
    $(".collapse").on("show.bs.collapse", function () {
        $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    })
    .on("hide.bs.collapse", function () {
        $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });

    // key features slider
    $('.key_features_slider').owlCarousel({
        stagePadding: 80,
        loop: true,
        margin: 20,
        autoplay: true,
        speed: 100,
        autoplaySpeed: 500,
        items: 3,
        responsive:{
            0:{
                stagePadding: 0,
                items:1
            },
            480:{
                stagePadding: 0,
                items:2
            },
            800:{
                stagePadding: 80,
                items:2
            },
            1260:{
                items:3
            }
        },
        onInitialized : function(){
            if($('.owl-item').first().hasClass('active'))
                $('.owl-prev').hide();
            else
                $('.owl-prev').show();
        } 
    })

    $('.below_difference_slider').owlCarousel({
        stagePadding: 80,
        loop: true,
        margin: 20,
        autoplay: true,
        speed: 100,
        autoplaySpeed: 500,
        items: 3,
        dots: false,
        responsive:{
            0:{
                stagePadding: 0,
                items:1
            },
            480:{
                stagePadding: 0,
                items:2
            },
            800:{
                stagePadding: 80,
                items:2
            },
            1260:{
                items:3
            }
        },
        onInitialized : function(){
            if($('.owl-item').first().hasClass('active'))
                $('.owl-prev').hide();
            else
                $('.owl-prev').show();
        } 
    })


    
    $(document).ready(function() {
        localStorage.setItem("resend_otp_count", 0);
        getLoanPrice($('#citydropdown').val())
        loanType($('#loantype').val());
        loanRequiredIn($('#loan_in').val())

      
        $('.confirm_otp_popup_number').keyup(function(event){
              let element =  event.target;
               let elementID = element.id;
             let currentID =  elementID.split("confirm_otp_popup_number_")[1];
             $("#confirm_otp_popup_number_"+currentID).attr('maxlength');
             if($("#confirm_otp_popup_number_"+currentID).val().length ==  $("#confirm_otp_popup_number_"+currentID).attr('maxlength')){
                let nextID = parseInt(currentID)+1;
                $("#confirm_otp_popup_number_"+nextID).select();
             }

            

        });

    });
</script> --}}
@stop
