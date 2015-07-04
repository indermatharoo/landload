<script type="text/javascript">
    function rmdiv(elm) {
        var curElm = $(elm);
        curElm.parent().remove();
    }

    function addPrice() {
        var html = '';
        html += '<div class="col-lg-12  form-group clearfix padding-0">'
        html += '<div class="col-lg-3 col-sm-3">'
        html += '<input type="text" placeholder="price title" class="form-control" name="title[]">'
        html += '</div>'
        html += '<div class="col-lg-3 col-sm-3">'
        html += '<div class="input-group">'
        html += '<span class="input-group-addon">$</span>'
        html += '<input type="text" class="form-control" name="price[]">'
        html += '</div>'
        html += '</div>'
        html += '<div class="col-lg-4 col-sm-3">'
        html += '<div class="input-group">'
        html += '<span class="input-group-addon">Available tickets</span>'
        html += '<input type="number" class="form-control" name="available[]" >'
        html += '</div>'
        html += '</div>'
        html += '<div col-sm-3>'
        html += '<button type="button" class="btn btn-danger pull-right btn-fix-width" onclick="rmdiv(this)">Remove</button>'
        html += '</div>'
        html += '</div>'

        $('.price_div').append(html);
    }

    function regisForm() {
        var nameReg = /^[A-Za-z]+$/;
        var numberReg = /^[0-9]+$/;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var EventType = $('#event_type').val();
        var EventDate = $('#event_date').val();
        var EventTitle = $('#event_title').val();
        var EventVanue = $('#location').val();
        var EventPriceTitle = $('#event_price_title').val();
        var EventPrice = $('#event_price').val();
        var EventPriceTicket = $('#event_price_ticket').val();
//        var telephone = $('#telephone').val();
//        var zipcode = $('#zipcode').val();
//        var email = $('#email').val();

        var inputVal = new Array(EventType, EventDate, EventTitle, EventVanue, EventPriceTitle, EventPrice, EventPriceTicket);
        var inputMessage = new Array("Event Type", "Event Date", "Event Title", "Event Vanue", "Price Title", "Price", "Tickets");
        $('.error').hide();
        if (inputVal[0] == "") {
            $('#event_typeLabel').after('<span class="error"> Please enter ' + inputMessage[0] + '</span>');
            return false
        }
        if (inputVal[1] == "") {
            $('#event_dateLabel').after('<span class="error"> Please enter ' + inputMessage[1] + '</span>');
            return false
        }
        if (inputVal[2] == "") {
            $('#event_titleLabel').after('<span class="error"> Please enter ' + inputMessage[2] + '</span>');
            return false
        }
        if (inputVal[3] == "") {
            $('#event_venueLable').after('<span class="error"> Please enter ' + inputMessage[3] + '</span>');
            return false
        }

        if (inputVal[4] == "") {
            $('#event_priceTitleLabel').after('<span class="error"> Please enter ' + inputMessage[4] + '</span>');
            return false
        }

        if (inputVal[5] == "") {
            $('#event_priceLabel').after('<span class="error"> Please enter ' + inputMessage[5] + '</span>');
            return false
        }
        if (inputVal[6] == "") {
            $('#event_priceTicketLabel').after('<span class="error"> Please enter ' + inputMessage[6] + '</span>');
            return false
        }
//        if (inputVal[2] == "") {
//            $('#telephoneLabel').after('<span class="error"> Please enter your ' + inputMessage[2] + '</span>');
//            return false
//        }
//        else if (!numberReg.test(telephone)) {
//            $('#telephoneLabel').after('<span class="error"> Numbers only</span>');
//            return false
//        }
//        if (inputVal[3] == "") {
//            $('#zipcodeLabel').after('<span class="error"> Please enter your ' + inputMessage[3] + '</span>');
//            return false
//        }
//           if (inputVal[4] == "") {
//            $('#emailLabel').after('<span class="error"> Please enter your ' + inputMessage[4] + '</span>');
//            return false
//        }
//        else if (!emailReg.test(email)) {
//            $('#emailLabel').after('<span class="error"> Please enter a valid email address</span>');
//            return false
//        }


    }

    $(function () {
        $('input[name="eventdate"]').daterangepicker({
            timePicker: true,
            format: 'DD-MM-YYYY h:mm',
            timePickerIncrement: 5,
            timePicker12Hour: false,
            timePickerSeconds: false
        });

        $('.add_price').click(function () {
            addPrice();
        });
        $('.event_add').click(function () {
            regisForm();
            if (regisForm() != false) {
                $('.EventAddForm').submit();
            }
        });
//        $('#event_type').change(function () {
//            var type = $(this).find(":selected").text();
//            if (type === 'Classes') {
//                $('.event-category').show();
//            } else {
//                $('.event-category').hide();
//            }
//        });
//        window.onload = function () {
//            var cid = $('.event-category').attr('ecid');
//            if (cid == 0) {
//                $('.event-category').hide();
//            }
//        };
    });
    texteditor('.texteditor');
</script>
