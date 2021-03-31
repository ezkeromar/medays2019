// Class definition

let minDateDeparture = ""
let minTransfertDateDeparture = ""
let minDesiredDateDeparture = ""

var KTBootstrapDatepicker = function () {

    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }

    // Private functions
    var demos = function () {
        // minimum setup
        $('#kt_datepicker_1, #kt_datepicker_1_validate').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        // minimum setup for modal demo
        $('#kt_datepicker_1_modal').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        // input group layout 
        $('#kt_datepicker_2, #kt_datepicker_2_validate').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        // input group layout for modal demo
        $('#kt_datepicker_2_modal').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        // enable clear button 
        $('#kt_datepicker_3, #kt_datepicker_3_validate').datepicker({
            rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: arrows
        });

        // enable clear button for modal demo
        $('#kt_datepicker_3_modal').datepicker({
            rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: arrows
        });

        // orientation 
        $('#kt_datepicker_4_1').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "top left",
            todayHighlight: true,
            templates: arrows
        });

        $('#kt_datepicker_4_2').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "top right",
            todayHighlight: true,
            templates: arrows
        });

        $('#kt_datepicker_4_3').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "bottom left",
            todayHighlight: true,
            templates: arrows
        });

        $('#kt_datepicker_4_4').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "bottom right",
            todayHighlight: true,
            templates: arrows
        });

        // range picker
        $('#kt_datepicker_5').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            templates: arrows
        });

        // inline picker
        $('#kt_datepicker_6').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            templates: arrows
        });
    }

    return {
        // public functions
        init: function () {
            demos();
        }
    };
}();
function checkDepartureDate($arrival, $departure) {
    var arrival = $($arrival)
    var departure = $($departure)
    var date2 = arrival.datepicker('getDate');
    var date1 = departure.datepicker('getDate');
    if (date2 >= date1) {
        date2.setDate(date2.getDate() + 1);
        departure.datepicker('setDate', date2);
        departure.datepicker("option", { minDate: date2 });
        return date2
    }
    return null
}
function changeNumberNight() {
    const date1 = moment($('.arrival_date').val(), "DD/MM/YYYY");
    const date2 = moment($('.departure_date').val(), "DD/MM/YYYY");
    const diffDays = date2.diff(date1, 'days');
    $('#nights_count').val(diffDays);
}
jQuery(document).ready(function () {
    KTBootstrapDatepicker.init();

    // changeNumberNight();

    //Hebergement dates
    if ($(".arrival_date").length && $('.departure_date').length) {
        $(".arrival_date").datepicker({
            format: 'dd/mm/yyyy',
            startDate: '09/11/2019',
            minDate: '09/11/2019',
            endDate:'17/11/2019',
            maxViewMode:0,
            stepMonths: 0,
            maxDate: '17/11/2019'
        }).on('change', function (e) {
            minDateDeparture = checkDepartureDate('.arrival_date', '.departure_date');
        });
        $('.departure_date').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '10/11/2019',
            minDate: '10/11/2019',
            maxViewMode:0,
            endDate:'18/11/2019',
            stepMonths: 0,
            maxDate: '18/11/2019'
        }).on('hide', function (e) {
            var dt1 = $('.arrival_date').datepicker('getDate');
            var dt2 = $('.departure_date').datepicker('getDate');
            if (dt2 <= dt1 && minDateDeparture) {
                $('.departure_date').datepicker('setDate', minDateDeparture);
            }
        });
    }
    if ($(".transfert_arrival").length && $('.transfert_departure').length) {
        //transferts dates
        $(".transfert_arrival").datepicker({
            format: 'dd/mm/yyyy',
            startDate: '09/11/2019',
            minDate: '09/11/2019',
            maxViewMode:0,
            endDate:'17/11/2019',
            stepMonths: 0,
            maxDate: '17/11/2019'
        }).on('change', function (e) {
            minTransfertDateDeparture = checkDepartureDate('.transfert_arrival', '.transfert_departure');
        });
        $('.transfert_departure').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '10/11/2019',
            minDate: '10/11/2019',
            maxViewMode:0,
            endDate:'18/11/2019',
            stepMonths: 0,
            maxDate: '18/11/2019'
        }).on('hide', function (e) {
            var dt1 = $('.transfert_arrival').datepicker('getDate');
            var dt2 = $('.transfert_departure').datepicker('getDate');
            if (dt2 <= dt1 && minTransfertDateDeparture) {
                $('.transfert_departure').datepicker('setDate', minTransfertDateDeparture);
            }
        });
    }
    if ($(".desired_arrival").length && $('.desired_departure').length) {
        //desired dates
        $(".desired_arrival").datepicker({
            format: 'dd/mm/yyyy',
            startDate: '09/11/2019',
            minDate: '09/11/2019',
            maxViewMode:0,
            endDate:'17/11/2019',
            stepMonths: 0,
            maxDate: '17/11/2019'
        }).on('change', function (e) {
            minDesiredDateDeparture = checkDepartureDate('.desired_arrival', '.desired_departure');
        });
        $('.desired_departure').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '10/11/2019',
            minDate: '10/11/2019',
            maxViewMode:0,
            endDate:'18/11/2019',
            stepMonths: 0,
            maxDate: '18/11/2019'
        }).on('hide', function (e) {
            var dt1 = $('.desired_arrival').datepicker('getDate');
            var dt2 = $('.desired_departure').datepicker('getDate');
            if (dt2 <= dt1 && minDesiredDateDeparture) {
                $('.desired_departure').datepicker('setDate', minDesiredDateDeparture);
            }
        });
    }
    $('.timepicker01').timepicker({
        showMeridian: false,
        defaultTime: false
    });

});