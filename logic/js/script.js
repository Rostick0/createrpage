"use strict";var inputsError=document.querySelectorAll(".input._error");inputsError&&inputsError.forEach(function(r){r.addEventListener("click",function r(t){this.classList.contains("_error")&&this.classList.remove("_error"),this.removeEventListener("click",r)})});