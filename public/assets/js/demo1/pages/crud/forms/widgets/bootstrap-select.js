// Class definition

var KTBootstrapSelect = function () {
    
    // Private functions
    var demos = function () {
        // minimum setup
        $('.kt-selectpicker').selectpicker();
        $('.countrySelect').select2({
            placeholder: 'Choix du pays'
        });
    }

    return {
        // public functions
        init: function() {
            demos(); 
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapSelect.init();
});