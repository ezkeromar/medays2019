$( document ).ready(function() {
    $('.kt-form--disable :input').prop('disabled', true);
    $('.kt-form-action--disable').hide();

    $('.kt-form--enable').on('click', function() {
        $('.kt-form--disable :input').prop('disabled', false);
        $('.kt-form-action--disable').show();
        $(this).hide();
    });

    $('.kt-form-disable--cta').on('click', function() {
        $('.kt-form--disable :input').prop('disabled', true);
        $('.kt-form-action--disable').hide();
        $('.kt-form--enable').show();
    });

    $('.pec_prestation').on('change', function() {
        if( $(this).prop("checked") == true ) {
            $('.kt-billet-avion').removeClass('kt-hidden');
        }
        else {
            $('.kt-billet-avion').addClass('kt-hidden');
        }
    });

    if ($('.kt-types-form').length) {
        if($('.kt-types-form').find(':selected').data('niveau')) {
            $('.kt-niveau').removeClass('kt-hidden');
            return true;
        }
        $('.kt-types-form').on('change', function() {
            if($(this).find(':selected').data('niveau')) {
                $('.kt-niveau').removeClass('kt-hidden');
                return true;
            }

            $('.kt-niveau').addClass('kt-hidden');
        });
    }
});