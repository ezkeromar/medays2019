function flightstepvalidation () {
      var v = true
      if ($.trim($('input[name=desired_arrival_date]').val()) == "") {
        v = false
        $('input[name=desired_arrival_date]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($('select[name=desired_arrival_hour]>option:selected').attr('value') == 'none') {
        v = false
        $('select[name=desired_arrival_hour]>option:selected').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($.trim($('input[name=pec_arrival_airport]').val()) == ""){
        v = false
        $('input[name=pec_arrival_airport]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($.trim($('input[name=pec_departure_airport]').val()) == ""){
        v = false
        $('input[name=pec_departure_airport]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($.trim($('input[name=desired_departure_date]').val()) == ""){
        v = false
        $('input[name=desired_departure_date]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($('select[name=desired_departure_hour]>option:selected').attr('value') == 'none') {
        v = false
        $('select[name=desired_departure_hour]>option:selected').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($('select[name=pec_departure_airport]>option:selected').attr('value') == 'none') {
        v = false
        $('select[name=pec_departure_airport]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      return v
    }