function transferstepvalidation () {
      var v = true
      if ($.trim($('input[name=transfer_arrival_date]').val()) == "") {
        v = false
        $('input[name=transfer_arrival_date]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($.trim($('input[name=transfer_arrival_time]').val()) == ""){
        v = false
        $('input[name=transfer_arrival_time]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      } else {
        var re = new RegExp("^([0-9][0-9]:[0-9][0-9])$");
        if(!re.test($('input[name=transfer_arrival_time]').val())) {
          v = false
          $('input[name=transfer_arrival_time]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.validtimeplease')}}</p>")
        }
      }
      if ($.trim($('input[name=arrival_flight_number]').val()) == "") {
        v = false
        $('input[name=arrival_flight_number]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($.trim($('input[name=arrival_airline_company]').val()) == ""){
        v = false
        $('input[name=arrival_airline_company]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($.trim($('input[name=arrival_airport]').val()) == "") {
        v = false
        $('input[name=arrival_airport]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($('select[name=arrival_recovery_point]>option:selected').attr('value') == 'none') {
        v = false
        $('input[name=arrival_recovery_point]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($('select[name=departure_deposit_point]>option:selected').attr('value') == 'none') {
        v = false
        $('input[name=departure_deposit_point]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($.trim($('input[name=departure_airport]').val()) == ""){
        v = false
        $('input[name=departure_airport]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($.trim($('input[name=transfer_departure_date]').val()) == ""){
        v = false
        $('input[name=transfer_departure_date]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($.trim($('input[name=transfer_departure_time]').val()) == ""){
        v = false
        $('input[name=transfer_departure_time]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      } else {
        var re = new RegExp("^([0-9][0-9]:[0-9][0-9])$");
        if(!re.test($('input[name=transfer_departure_time]').val())) {
          v = false
          $('input[name=transfer_departure_time]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.validtimeplease')}}</p>")
        }
      }
      if ($.trim($('input[name=departure_flight_number]').val()) == ""){
        v = false
        $('input[name=departure_flight_number]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($.trim($('input[name=departure_airline_company]').val()) == ""){
        v = false
        $('input[name=departure_airline_company]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      return v
    }