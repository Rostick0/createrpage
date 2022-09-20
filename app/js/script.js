const inputsError = document.querySelectorAll('.input._error');

if (inputsError) {
    inputsError.forEach(function (input) {
        function removeErrorClass(event) {
            if (this.classList.contains('_error')) {
                this.classList.remove('_error');
            }

            this.removeEventListener('click', removeErrorClass)
        }

        input.addEventListener('click', removeErrorClass);
    });
}

// function costListActiveAnim(event) {

//     costList.classList.add('_active-anim');

//     return window.removeEventListener('scroll', costListActiveAnim);
// }

// window.addEventListener('scroll', costListActiveAnim);