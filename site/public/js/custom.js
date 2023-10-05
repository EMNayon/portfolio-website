// Owl Carousel Start..................

$(document).ready(function () {
    var one = $("#one");
    var two = $("#two");

    $("#customNextBtn").click(function () {
        one.trigger("next.owl.carousel");
    });
    $("#customPrevBtn").click(function () {
        one.trigger("prev.owl.carousel");
    });
    one.owlCarousel({
        autoplay: true,
        loop: true,
        dot: true,
        autoplayHoverPause: true,
        autoplaySpeed: 100,
        margin: 10,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 4,
            },
        },
    });

    two.owlCarousel({
        autoplay: true,
        loop: true,
        dot: true,
        autoplayHoverPause: true,
        autoplaySpeed: 100,
        margin: 10,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });
});

// Owl Carousel End..................

// contact send
$("#contactSendBtnId").click(function () {
    var name = $("#contactNameId").val();
    var mobile = $("#contactMobileId").val();
    var email = $("#contactEmailId").val();
    var sms = $("#contactSMSId").val();
    console.log(name);
    SendContact(name, mobile, email, sms);
});

function SendContact(contact_name, mobile_no, contact_email, contact_message) {
    if (contact_name.length == 0) {
        $("#contactSendBtnId").html('enter your name');
        setTimeout(function(){
            $("#contactSendBtnId").html('পাঠিয়ে দিন');
        },2000)
    } else if (mobile_no.length == 0) {
        $("#contactSendBtnId").html('enter your mobile number');
        setTimeout(function(){
            $("#contactSendBtnId").html('পাঠিয়ে দিন');
        },2000)
    } else if (contact_email.length == 0) {
        $("#contactSendBtnId").html('enter your email');
        setTimeout(function(){
            $("#contactSendBtnId").html('পাঠিয়ে দিন');
        },2000)
    } else {
        $("#contactSendBtnId").html('Sending....!');
        axios
            .post("/contactSend", {
                contact_name: contact_name,
                mobile_no: mobile_no,
                contact_email: contact_email,
                contact_message: contact_message,
            })
            .then(function (response) {
                if(response.status == 200){
                    if(response.data == 1){

                        $("#contactSendBtnId").html('Request Successfull!');
                        setTimeout(function(){
                            $("#contactSendBtnId").html('পাঠিয়ে দিন');
                        },2000)
                    }else {
                        $("#contactSendBtnId").html('Request Failed! Agian Try it!');
                        setTimeout(function(){
                            $("#contactSendBtnId").html('পাঠিয়ে দিন');
                        },2000)
                    }
                }
            })
            .catch(function (err) {
                $("#contactSendBtnId").html('Request Failed! Agian Try it!');
                setTimeout(function(){
                    $("#contactSendBtnId").html('পাঠিয়ে দিন');
                },2000)
            });
    }
}
