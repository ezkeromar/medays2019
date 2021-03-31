const uploadInput = document.getElementsByClassName("form__input--upload")[0];

document.getElementsByClassName("form__input--file")[0].onchange = function() {
  let pathName = this.value.split("\\");
  let name = pathName[pathName.length - 1];

  uploadInput.value = name;
};
