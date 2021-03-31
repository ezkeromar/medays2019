    
<?php $__env->startSection('content'); ?>
    <main class="content">
    <div id="errorswrapper"></div>
    <form id="formfrontpartsub" class="form" method="POST" action="/steptow/store" enctype="multipart/form-data">
    <?php if(!empty($id)): ?>
      <input type="hidden" value="<?php echo e($id); ?>" name="participant_id" />
    <?php endif; ?>
    <input type="hidden" value="" name="previousestep" />
    <?php echo $__env->make('front.substepone', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.substeptow', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(empty($type_id) || app('request')->input('type') == 7 || app('request')->input('type') == 1): ?>
      <?php echo $__env->make('front.motivationstep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(!empty($participant)): ?>
      <?php echo $__env->make('front.flightstep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('front.transferstep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('front.hotelstep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('front.formationstep', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/moment.min.js"></script>
<script>
  $(document).ready(function() {
    $('input[name=formation_name]:checked').click(function () {
      $(this).removeAttr('checked')
      $(this).attr('value', false)
    })
    if ($.trim($('input[name=birthday]').val()) != ""){
      $('#birthdate').attr('value', moment($('#birthdate').val(), 'YYYY-MM-DD').format("DD/MM/YYYY"))
    }
    $("input[name=birthday]").inputmask("datetime", {
        inputFormat: "dd/mm/yyyy",
        outputFormat: "dd/mm/yyyy",
        inputEventOnly: true,
        placeholder: "<?php echo e(__('front.'.$lang.'.dateformat')); ?>"
    });
    <?php echo $__env->make('front.substeponevalidation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.substeptowvalidation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.flightstepvalidation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.hotelvalidation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.transfervalidation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    hideallsteps()
    $('.gosteptow').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      var validated = true
      validated = substeponevalidation()
      if (validated) {
        $('.content__step--step1').hide()
        $('.content__step--step2').show()
        $('input[name=previousestep]').attr('value', 'content__step--step1')
      }
    })
    $('.gostepthreestore').click(function(event) {
      preventpropag()
      if($(this).data('emailOK')) {
        var v = steptowvalidation('gostepthreestore', true)
      } else {
        var v = steptowvalidation('gostepthreestore')
      }
      if(v) {
        $('#formfrontpartsub').submit();
        $(this).attr('disabled','disabled')
      }
    })
    $('.gostepthree').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      if($(this).data('emailOK')) {
        var v = steptowvalidation('gostepthree', true)
      } else {
        var v = steptowvalidation('gostepthree')
      }
      if (v == true) {
        $('.content__step--step2').hide()
        $('.content__step--step3').show()
        $('input[name=previousestep]').attr('value', 'content__step--step2')
      }
    })
    $('.gotoformation').click(function (event) {
      preventpropag()
      var v = true
      if($(this).data('emailOK')) {
        v = steptowvalidation('gotoformation', true)
      } else {
        v = steptowvalidation('gotoformation')
      }
      if (v == true) {
        $('.content__step--step2').hide()
        $('.content__step--formation').show()
        $('input[name=previousestep]').attr('value', 'content__step--step2')
      }
    })
    $('.goback').click(function (event) {
      preventpropag()
      hideallsteps(true)
      var tempbackstep = $('input[name=previousestep]').val()
      $('.'+tempbackstep).show()
    })
    $('.gotoformationfrommotiv').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      var v = true
      if ($.trim($('input[name=motivation]').val()) == ""){
        v = false
        $('input[name=motivation]').parent().append("<p class='inscription__tip'><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>")
      }
      if (v) {
        $('.content__step--step3').hide()
        $('.content__step--formation').show()
        $('input[name=previousestep]').attr('value', 'content__step--step3')
      }
    })
    $('.gotopec').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      var v = true
      if($(this).data('emailOK')) {
        v = steptowvalidation('gotopec', true)
      } else {
        v = steptowvalidation('gotopec')
      }
      if (v) {
        $('.content__step--step2').hide()
        $('.content__step--pec').show()
        $('input[name=previousestep]').attr('value', 'content__step--step2')
      }
    })
    $('.gototransfer').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      var v = true
      if($(this).data('emailOK')) {
        v = steptowvalidation('gototransfer', true)
      } else {
        v = steptowvalidation('gototransfer')
      }
      if (v) {
        $('.content__step--step2').hide()
        $('.content__step--transfert').show()
        $('input[name=previousestep]').attr('value', 'content__step--step2')
      }
    })
    $('.gotosejour').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      var v = true
      if($(this).data('emailOK')) {
        v = steptowvalidation('gotosejour', true)
      } else {
        v = steptowvalidation('gotosejour')
      }
      if (v) {
        $('.content__step--step2').hide()
        $('.content__step--sejour').show()
        $('input[name=previousestep]').attr('value', 'content__step--step2')
      }
    })
    $('.submitformfrommotiv').click(function (event) {
      preventpropag()
      var v = true
      if ($.trim($('input[name=motivation]').val()) == ""){
        v = false
        $('input[name=motivation]').parent().append("<p class='inscription__tip'><?php echo e(__('front.'.$lang.'.requiredfieldt')); ?></p>")
      }
      if (v) {
        $('#formfrontpartsub').submit()
        $(this).attr('disabled','disabled')
      }
    })
    $('.dgototransfer').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      var v = true
      if($(this).data('pstep') == 'content__step--pec') {
        v = flightstepvalidation()
      }
      if($(this).data('pstep') == 'content__step--sejour') {
        v = hotelstepvalidation()
      }
      if($(this).data('pstep') == 'content__step--transfert') {
        v = transferstepvalidation()
      }
      if (v) {
        $('.'+$(this).data('pstep')).hide()
        $('.content__step--transfert').show()
        $('input[name=previousestep]').attr('value', $(this).data('pstep'))
      }
    })
    $('.dgotosejour').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      var v = true
      if($(this).data('pstep') == 'content__step--pec') {
        v = flightstepvalidation()
      }
      if($(this).data('pstep') == 'content__step--sejour') {
        v = hotelstepvalidation()
      }
      if($(this).data('pstep') == 'content__step--transfert') {
        v = transferstepvalidation()
      }
      if (v) {
        $('.'+$(this).data('pstep')).hide()
        $('.content__step--sejour').show()
        $('input[name=previousestep]').attr('value', $(this).data('pstep'))
      }
    })
    $(".dsubmit").click(function () {
      preventpropag()
      $('.inscription__tip').remove()
      var v = true
      if($(this).data('pstep') == 'content__step--pec') {
        v = flightstepvalidation()
      }
      if($(this).data('pstep') == 'content__step--sejour') {
        v = hotelstepvalidation()
      }
      if($(this).data('pstep') == 'content__step--transfert') {
        v = transferstepvalidation()
      }
      if (v) {
        $('#formfrontpartsub').submit()
        $(this).attr('disabled','disabled')
      }
    })
    $('.dgotoformation').click(function (event) {
      preventpropag()
      $('.inscription__tip').remove()
      var v = true
      if($(this).data('pstep') == 'content__step--pec') {
        v = flightstepvalidation()
      }
      if($(this).data('pstep') == 'content__step--sejour') {
        v = hotelstepvalidation()
      }
      if($(this).data('pstep') == 'content__step--transfert') {
        v = transferstepvalidation()
      }
      if (v) {
        $('.'+$(this).data('pstep')).hide()
        $('.content__step--formation').show()
        $('input[name=previousestep]').attr('value', $(this).data('pstep'))
      }
    })
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('registerFront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/front/steptow.blade.php ENDPATH**/ ?>