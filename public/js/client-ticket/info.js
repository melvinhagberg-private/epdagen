let types = document.querySelectorAll('.type');
let form_type = $("input[name='form-type']");
    form_type.value = 'privat';
let submit_button = $("button[type='submit']");
let inputs = document.querySelectorAll('input, select');

let emptyExists = false;

inputs.forEach(input => {
    input.addEventListener('change', () => {
        emptyExists = false;
        inputs.forEach(target => {
            if (target.value === '' || target.value === 'none') {
                emptyExists = true;
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
            break;
        case 'foretag':
            total = parseInt(numTickets * 500) + ' kr exkl. moms';
    }
    
    if (numTickets >= 1) {
        $('#total').css('display', 'block');
    } else {
        $('#total').hide();
    }
    
    $('#total').text(total);
}

