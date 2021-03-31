function DDMMYYYY(value, event) {
  let newValue = value.replace(/[^0-9]/g, "").replace(/(\..*)\./g, "$1");

  const dayOrMonth = index => index % 2 === 1 && index < 4;

  // on delete key.
  if (!event.data) {
    return value;
  }

  return newValue
    .split("")
    .map((v, i) => (dayOrMonth(i) ? v + "/" : v))
    .join("");
}
document.addEventListener("DOMContentLoaded", function() {
  tail.DateTime(".datepicker", {
    timeFormat: false,
    dateFormat: "dd/mm/YYYY",

    dateStart: 1573430400000,
    dateEnd: 1573948800000
  });
});
document.addEventListener("DOMContentLoaded", function() {
  tail.DateTime(".timepicker", { timeFormat: "HH:ii", dateFormat: false });
});
