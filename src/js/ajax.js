$( document ).ready(function() {
    var isField = false;
    var isReady = 0;
    ///////////////////////////////////////////////////////////////
    ////////////////////SEND DATA BLOCK////////////////////////////
    ///////////////////////////////////////////////////////////////
    $('#ajaxForm1').keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
      }
    });
    if($('#isFirstForm').val() == 1) {
        showForm('ajaxForm2');
        hideForm('ajaxForm1');
        showForm('form');
    }
    $("#btn").click(
        function(){
            if (isField == true){
                sendForm1('resultForm', 'ajaxForm1', 'members/Save');
            };
        }
    );
    $("#btn2").click(
        function(){
            sendForm2('resultForm', 'ajaxForm2', 'members/Update');
        }
    );
    $(function(){
        $("#image").change(
           function(){
               $("#load").html("<img src='images/loader.gif' alt='Loading...' style='margin-left: -5px;'>");
               $("#form").ajaxForm({
                    url:'members/photo',
                    success:function(response) {
                        var rez = jQuery.parseJSON(response);
                        if (rez['isError'] == true){
                            document.getElementById('global-error').innerHTML ="<p>"+rez['image']+"</p>" + "<p>"+rez['size']+"</p>";
                        }
                        if (rez['isError'] == false) {
                            document.getElementById('global-error').innerHTML =""; 
                            document.getElementById('load').innerHTML ="";                   
                        } 
                    }
               }).submit();
           });
    });
    ///////////////////////////////////////////////////////////////////
    ////////////////////CHECK ERRRORS BLOCK////////////////////////////
    ///////////////////////////////////////////////////////////////////
    //      1) Firstname Check
    $("#firstname").keypress(
        function(){
            firstname = $("#firstname").val();    
        }
    );
    //      2) Lastname Check
    $("#lastname").keypress(
        function(eventObject){
            var text = document.getElementById("lastname"),
                testText;
            var char = eventObject.which;
            text.onkeyup =  function testKey(){
                var testText = text.value;
                if ((char > 31 && char < 44)|| (char > 45 && char < 65) || (char > 90 && char < 97) || (char > 122 && char < 127)){
                    text.value = testText.substring(0, testText.length - 1) 
                }
            }    
        }
    );
    //      3) Birthday Check
    $("#birthday").keypress(
        function(eventObject){
            var text = document.getElementById("birthday"),
                testText;
            var char = eventObject.which;
            text.onkeyup =  function testKey(){
                var testText = text.value;
                if ((char > 31 && char < 46) || (char == 47) || (char > 57)){
                    text.value = testText.substring(0, testText.length - 1) 
                }
            }
        } 
    );
    $("#birthday").change(
        function(){
            var lenBr = 10;
            if( $('#birthday').val().length != lenBr ) {
                $("#birthday").val('');  
            } else{
                br = $("#birthday").val();
                date = br.split(".");
                var d = date[0] - 0;
                var m = date[1] - 0;
                var y = date[2] - 0;
                var daysInMonth = 31;
                if (m > 0 && m < 13 && y > 1990 && y < 2018) {
                    if (m == 2) {
                        daysInMonth = ((y % 400) == 0) ? 29 : ((y % 100) == 0) ? 28 : ((y % 4) == 0) ? 29 : 28;
                    }else 
                        if (m == 4 || m == 6 || m == 9 || m == 11) {
                            daysInMonth = 30;
                        }
                    var check = d <= daysInMonth;
                }
                if (check!=true){
                    $("#birthday").val('');    
                }
            }   
        } 
    ); 
    //      4) Country Check
    //      .................
    //      5)Phone Check
    $("#phone").change(function(){
        var minPhone = 14;
        if( $('#phone').val().length < minPhone ) {
            $('#phone').val('');
            return false;
        }
    }); 
    //      6) Email Check
    $("#email").keyup(
        function(){
            var re, email, isValid;
            re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
            email = $("#email").val();      
            isValid = re.test(email);
            if(!isValid){
                $('.error-email').text("Incorrect email address, please use the following format: test@site.com.");
                isField = false;
            };
            if(isValid){
                emailCheck();
            };            
        } 
    );
    //      7) Report Check
    $("#reportsubject").keypress(
        function(){
            report = $("#reportsubject").val();    
        }
    );
    ///////////////////////////////////////////////////////////////////
    function emailCheck(){
        jQuery.ajax({
            url:     'members/Valid', //url страницы
            type:     "POST", //метод отправки
            dataType: "html", //формат данных
            data: jQuery("#ajaxForm1").serialize(),
            success:function (response) {
                var rez = $.parseJSON(response);
                if(rez['isValid'] == false){
                    $("#email_check").toggleClass();
                    $('.error-email').removeClass('success-valid');
                    $("#email_check").addClass('form-group has-error has-danger');
                    $('.error-email').addClass('failed-valid');
                    $('.error-email').text(rez['msg']);
                }else{
                    $("#email_check").toggleClass();
                    $('.error-email').removeClass('failed-valid');
                    $("#email_check").addClass('form-group');
                    $('.error-email').addClass('success-valid');
                    $('.error-email').text(rez['msg']);
                    isField=true;
                }               
            }
        });    
    };

    function sendForm1(resultForm, ajaxForm, url) {
        jQuery.ajax({
            url:     url, //url страницы
            type:     "POST", //метод отправки
            dataType: "html", //формат данных
            data: jQuery("#"+ajaxForm).serialize(),  // Сеарилизуем объект
            success:function (response) {
                var rez = jQuery.parseJSON(response);
                if (rez['isError'] == true){
                    document.getElementById('global-error').innerHTML ="<p>"+rez['alnum']+"</p>"+"<p>"+rez['alpha']+"</p>"+"<p>"+rez['length']+"</p>"+"<p>"+rez['notEmpty']+"</p>"+"<p>"+rez['phone']+"</p>"+"<p>"+rez['email']+"</p>"+"<p>"+rez['date']+"</p>"+"<p>"+rez['between']+"</p>";      
                }
                if (rez['isError'] == false) {
                    document.getElementById('global-error').innerHTML ="";
                    hideForm('ajaxForm1');
                    showForm('ajaxForm2');
                    showForm('form');
                }
            }
        });
    }

    function sendForm2(resultForm, ajaxForm, url) {
        jQuery.ajax({
            url:     url, //url страницы
            type:     "POST", //метод отправки
            dataType: "html", //формат данных
            data: jQuery("#"+ajaxForm).serialize(),  // Сеарилизуем объект
            success:function (response) {
                var rez = jQuery.parseJSON(response);
                if (rez['isError'] == true){
                    document.getElementById('global-error').innerHTML ="<p>"+rez['alnum']+"</p>"+"<p>"+rez['intVal']+"</p>"+"<p>"+rez['length']+"</p>";       
                }
                if (rez['isError'] == false) {
                    document.getElementById('global-error').innerHTML ="";
                    hideForm('ajaxForm1');
                    hideForm('ajaxForm2');
                    hideForm('form');
                    showForm('ajaxForm3');
                }
            }
        });
    }

    function hideForm(ajaxForm){
        document.getElementById(ajaxForm).style.display = 'none';
    }

    function showForm(ajaxForm){
        document.getElementById(ajaxForm).style.display = 'block';
    }
});