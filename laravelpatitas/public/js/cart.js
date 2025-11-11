document.addEventListener('DOMContentLoaded', function() {
    const cartRoot = document.querySelector('[data-confirm-remove]');
    const CART_CONFIRM_REMOVE = cartRoot ? cartRoot.getAttribute('data-confirm-remove') : '';

    document.querySelectorAll('.js-remove-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm(CART_CONFIRM_REMOVE)) {
                e.preventDefault();
            }
        });
    });
});

function setDeliveryAddress() {
    const textarea = document.getElementById('delivery_address');
    const input = document.getElementById('delivery_address_input');
    if (textarea && input) {
        input.value = textarea.value;
    }
}
