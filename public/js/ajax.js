$("#my_form").submit(function(event) {
    event.preventDefault(); //prevent default action
    var post_url = $(this).attr("action"); //get form action url
    var request_method = $(this).attr("method"); //get form GET/POST method
    var form_data = $(this).serialize(); //Encode form elements for submission

	$("#error").hide();
    
	$.ajax({
        url: post_url,
        type: request_method,
        data: form_data,
        beforeSend: function() {
			$("#error").hide();
            $("#loader").show();
            $(".download").hide();
            $(':input[type="submit"]').prop('disabled', true);
        },
        success: function(response) {
            obj = JSON.parse(response);
            $('.download a').attr('href', obj.path);
            $(".download").show();
            $(':input[type="submit"]').prop('disabled', false);
        },
        complete: function(data) {
            $("#loader").hide();
        },
        error: function(response) {
            $(':input[type="submit"]').prop('disabled', false);
			var error = JSON.parse(response.responseText);
            $('#error').text(error['errors']['url']);
            $('#error').text(error['errors']['g-recaptcha-response']);
            $("#error").show();
        }
    });
});

var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var totalSeconds = 0;
setInterval(setTime, 1000);

function setTime() {
    ++totalSeconds;
    secondsLabel.innerHTML = pad(totalSeconds % 60);
    minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}

function pad(val) {
    var valString = val + "";
    if (valString.length < 2) {
        return "0" + valString;
    } else {
        return valString;
    }
}