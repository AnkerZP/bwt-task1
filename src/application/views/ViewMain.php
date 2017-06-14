<div id="map"></div>
<!--Form 1-->
<div class="container">
    <div id="global-error" class="global-error"></div>
</div>
<div class="container">
    <input type="hidden" id="isFirstForm" value="<?= (int)$first ?>" />
    <form data-toggle="validator" role="form" action="" method="POST" class="ajaxForm1" id="ajaxForm1" style="display:block">
        <legend>To participate in the conference, please fill out the form</legend>
        <?php echo '<a href="/Members">All Members('.$data.')</a>';?>
        <hr>
        <!--Firstname-->
        <div class="form-group">
            <label for="firstname">Firstname *</label>
            <input type="text" maxlength="50" id="firstname" class="form-control" name="firstname" placeholder="Type firstname, ex. 'Dmitry'" data-error="Field is empty, please fill it with information." required>
            <div class="help-block with-errors"></div>
        </div>
        <!--Lastname-->
        <div class="form-group">
            <label for="lastname">Lastname *</label>
            <input type="text" maxlength="50" id="lastname" class="form-control" name="lastname" placeholder="Type lastname, ex. 'Draevskiy'" data-error="Field is empty, please fill it with information." required>
            <div class="help-block with-errors"></div>
        </div>
        <!--Birtday-->
        <div class="form-group">
            <label for="birthday">Birthday *</label>
            <input type='text' maxlength="10" id="birthday" name="birthday" class="form-control datepicker-here" placeholder="06.05.1996"  data-error="Field is empty, please fill it with information."required>
            <div class="help-block with-errors"></div>
        </div>
        <!--Country-->
        <div class="form-group">
            <label for="country">Country *</label>
            <select class="form-control bfh-countries" maxlength="30" data-country="US" name="country" data-error="Field is empty, please fill it with information." required></select>
            <div class="help-block with-errors"></div>
        </div>
        <!--Phone-->
        <div class="form-group">
            <label for="phone">Phone *</label>
            <div class="input-group">
                <span class="input-group-addon">+</span>
                <input type="text" class="form-control input-medium bfh-phone" placeholder="1 (555) 555-5555" name="phone" id='phone' data-format="d(ddd)ddd-dddd" data-error="Field is empty, please fill it with information." required>
            </div>
            <div id='phone-rez'></div>
            <div class="help-block with-errors"></div>
        </div>
		<!--Email-->
        <div class="form-group" id="email_check">
            <label for="email" class="control-label">Email *</label>
            <input type="text" class="form-control" maxlength="50" name="email" id="email" placeholder="Type email, ex. 'example@gmail.com'" data-error="Field is empty, please fill it with information." required>
            <div class="help-block with-errors"></div>
            <div class="error-email"></div>
        </div>
        <!--Report Subject-->
        <div class="form-group">
            <label for="reportsubject">Report Subject *</label>
            <input type="text" id="reportsubject" class="form-control" maxlength="50" name="reportsubject" placeholder="Type report subject, ex. 'BrainFuck - esoteric programming language'" data-error="Field is empty, please fill it with information." required>
            <div class="help-block with-errors"></div>
        </div>
        <!--Button-->
        <div class="form-group">
            <div class="button-right">
                <button type="button" class="btn btn-success" value="saveData" id="btn">Next</button>
            </div>
        </div>
    </form>
</div>
<!--Form 2-->
<div class="container">
    <form action = "" method="post" enctype="multipart/form-data" id="form" style="display:none">
        <legend>To participate in the conference, please fill out the form</legend>
        <div class="form-group" id="resultForm2" style="display:none"></div>
        Выбрать файл: <input type="file" name="image" id="image">
        <div id="load"></div>
    </form>
    <form data-toggle="validator" role="form" action="" method="POST" id="ajaxForm2" style="display:none">
        <!--For Hidden ID-->
        <div class="form-group" id="resultForm" style="display:none"></div>
        <!--Company-->
        <div class="form-group">
            <label for="company">Company</label>
            <input type="company" class="form-control" id="company" placeholder="Type Company, ex. 'Microsoft'" name="company">
        </div>
        <!--Position-->
        <div class="form-group">
            <label for="position">Position</label>
            <input type="position" class="form-control" id="position" placeholder="Type Position, ex. 'Director'" name="position">
        </div>
        <!--About Me-->
        <div class="form-group">
            <label for="aboutme">About Me</label>
            <textarea class="form-control" placeholder="Type something interesting about yourself" id="about" name="about"></textarea>
        </div>
        <!--Button-->
        <div class="form-group">
            <div class="button-right">
                <button type="button" class="btn btn-success" id="btn2">Next</button>
            </div>
        </div>
    </form>
</div>
<!--Form 3-->
<div class="container">
    <form role="form" action="" method="POST" id="ajaxForm3" style="display:none;text-align: center">
        <p><b>Registration is successfuly complete! Thank you!</b></p>
        <?php include_once 'application/config/share.php' ?>
        <?php $text?>
        <a href="https://twitter.com/share" class="twitter-share-button" data-url=<?php echo $link?> data-text=<?php echo '"'.$text.'"'?> data-size="large">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <div class="g-plus" data-action="share" data-width="300" data-height="24" data-href=<?php echo $link?> data-text=<?php $text?>></div>
        <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2F127.0.0.1&layout=button&size=large&mobile_iframe=true&width=113&height=28&appId" width="113" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    </form>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript">
    $( document ).ready(function() {
        $('#birthday').datepicker({
            // Можно выбрать тольо даты, идущие за сегодняшним днем, включая сегодня
            language: 'ru',
            maxDate: new Date()
        })
    });
</script>
<script>
      function initMap() {
        var uluru = {lat: 34.1011636, lng: -118.3437168};           //lat: 34.1011635, lng: -118.3459049
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          title: '7060 Hollywood Blvd, Los Angeles, CA'
        });
      }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoa0Z2ih7myb_ucbQq7wy7vB7-k4pQQiY&callback=initMap">
</script>