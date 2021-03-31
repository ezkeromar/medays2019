function hotelstepvalidation () {
      var v = true
      if ($.trim($('input[name=arrival_date]').val()) == "") {
        v = false
        $('input[name=arrival_date]').parent().append("<p class='inscription__tip'>{{__('front.'.$lang.'.requiredfieldt')}}</p>")
      }
      if ($.trim($('input[name=departure_date]').val()) == ""){
        v = false
        $('input[name=departure_date]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      return v
    }