let types = document.querySelectorAll('.type');
let form_type = $("input[name='form-type']");
let submit_button = $("button[type='submit']");
let inputs = document.querySelectorAll('input, select');

let emptyExists = false;

inputs.forEach(input => {
    input.addEventListener('change', () => {
        emptyExists = false;
        inputs.forEach(target => {
            if ($(target).attr('name') !== 'Företag') {
                if (target.value === '' || target.value === 'none') {
                    emptyExists = true;
                }
            }
        });
        if (!emptyExists) { submit_button.removeAttr('disabled'); }
    });
});

types.forEach(type => {
    type.addEventListener('click', (function index() {
        form_type.value = this.dataset.type;
        
        changeTotal(1, this.dataset.type);
        
        if (document.querySelector('.type-active')) {
            document.querySelector('.type-active').classList.remove('type-active');
        }

        this.classList.add('type-active');
        submit_button.disabled = false;
    }));
});

$('#numTickets').on('change', function() {
    changeTotal(0, $(this).val());
});

let numTickets;
let total;

function changeTotal(type, value) {
    if (type == 0) { numTickets = value; }
    
    switch (form_type.value) {
        case 'privat':
            total = parseInt(numTickets * 350) + ' kr inkl. moms';
            $('#foretag-group').hide();
            $('.payment-method .methods .faktura').hide();
            break;

        case 'foretag':
            total = parseInt(numTickets * 500) + ' kr exkl. moms';
            $('#foretag-group').show();
            $('.payment-method .methods .faktura').show();
    }
    
    if (numTickets >= 1) {
        $('#total').css('display', 'block');
    } else {
        $('#total').hide();
    }
    
    $('#total').text(total);
}

// let formTypeVal = document.querySelector(`input[name='form-type']`).value;
// let typeClassIsSet = false;

// console.log(formTypeVal);

// if (formTypeVal !== 'foretag') {
//     formTypeVal = 'privat';
// }

// types.forEach(function(type) {
//     if (type.dataset.type === formTypeVal) {
//         type.classList.add('type-active');
//         typeClassIsSet = true;
//     }
// });

