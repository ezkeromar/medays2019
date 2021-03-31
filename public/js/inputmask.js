var timeInputs = document.querySelectorAll(".timepicker");

Inputmask({ regex: "([01]?[0-9]|2[0-3]):[0-5][0-9]" }).mask(timeInputs);
