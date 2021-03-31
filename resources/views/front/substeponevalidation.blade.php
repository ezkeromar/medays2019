    $('#filelabelinput').click(function () {
      $('#filelabelinputf').click();
    })
    $('#filelabelinputf').change(function () {
      $('#filelabelinput').text($(this).val().replace('C:\\fakepath\\', ''))
    })
    function hideallsteps (stepone = false) {
        if(stepone)
            $('.content__step--step1').hide()
        $('.content__step--step2').hide()
        $('.content__step--step3').hide()
        $('.content__step--formation').hide()
        $('.content__step--pec').hide()
        $('.content__step--sejour').hide()
        $('.content__step--transfert').hide()
    }
    function substeponevalidation () {
      var v = true
      if ($.trim($('input[name=first_name]').val()) == ""){
        v = false
        $('input[name=first_name]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($.trim($('input[name=last_name]').val()) == ""){
        v = false
        $('input[name=last_name]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($.trim($('input[name=civility]').val()) != "1" && $.trim($('input[name=civility]').val()) != "2"){
        v = false
        $('input[name=civility]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($.trim($('input[name=organization]').val()) == ""){
        v = false
        $('input[name=organization]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($.trim($('input[name=function]').val()) == ""){
        v = false
        $('input[name=function]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($('select[name=nationality]>option:selected').attr('value') == 'none') {
        v = false
        $('select[name=nationality]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      }
      if ($.trim($('input[name=birthday]').val()) == ""){
        v = false
        $('input[name=birthday]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
      } else {
        if(!moment($('input[name=birthday]').val(), 'DD/MM/YYYY',true).isValid()){
          v = false
          $('input[name=birthday]').parent().append('<p class="inscription__tip">{{__('front.'.$lang.'.requiredfieldt')}}</p>')
        }
      }
      return v
    }