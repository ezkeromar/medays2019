    function preventpropag () {
      event.preventDefault();
      event.stopPropagation();
      event.stopImmediatePropagation();
      window.scrollTo(0,0);
    }
    function steptowvalidation(action, emailOK = false) {
      window.scrollTo(0,0);
      $('.inscription__tip').remove()
      var validated = true
      console.log($('select[name=country]>option:selected').attr('value'))
      if ($('select[name=country]>option:selected').attr('value') == 'none') {
        validated = false
        $('select[name=country]').parent().append("<p class='inscription__tip'><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>")
      }
      if ($.trim($('input[name=city]').val()) == ""){
        validated = false
        $('input[name=city]').parent().append('<p class="inscription__tip"><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>')
      }
      if ($.trim($('input[name=email]').val()) == ""){
        validated = false
        $('input[name=email]').parent().append('<p class="inscription__tip"><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>')
      }
      if ($.trim($('input[name=pro_phone]').val()) == ""){
        validated = false
        $('input[name=pro_phone]').parent().append('<p class="inscription__tip"><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>')
      }
      if ($.trim($('input[name=mobile_phone]').val()) == ""){
        validated = false
        $('input[name=mobile_phone]').parent().append('<p class="inscription__tip"><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>')
      }
      if ($.trim($('input[name=identity_type]').val()) != "1" && $.trim($('input[name=identity_type]').val()) != "2"){
        validated = false
        $('input[name=identity_type]').parent().append('<p class="inscription__tip"><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>')
      }
      if ($.trim($('input[name=num_identity]').val()) == ""){
        validated = false
        $('input[name=num_identity]').parent().append("<p class='inscription__tip'><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>")
      }
      if ($('input[name=presscarte]').length > 0 && $.trim($('input[name=presscarte]').val()) == ""){
        validated = false
        $('input[name=presscarte]').parent().append("<p class='inscription__tip'><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>")
      }
        if ($.trim($('input[name=email]').val()) != "" && emailOK == false){
        <?php if(!empty($participant->id)): ?>
          $.get( "/email/exists/"+$('#email').val()+"/<?php echo e($participant->id); ?>", {}, function( data ) {
        <?php else: ?>
          $.get( "/email/exists/"+$('#email').val(), {}, function( data ) {
        <?php endif; ?>
            if(data > 0) {
              validated = false
              $('input[name=email]').parent().append('<p class="inscription__tip"><?php echo e(__('front.'.$lang.'.emailnotvalid')); ?></p>')
            } else {
              console.log('Omar EZKER')
              console.log(action)
              $( '.'+action ).data( "emailOK", true );
              $( '.'+action ).triggerHandler( "click" );
            }
          });
        } else {
          return validated;
        }

    }<?php /**PATH C:\laragon\www\medyas\resources\views/front/substeptowvalidation.blade.php ENDPATH**/ ?>