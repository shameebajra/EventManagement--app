<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const modal = document.getElementById('add-user-modal');
        const body = document.body;

        // Open modal on button click
        $(document).on('click', '.update-btn', function() {

                // alert(user_id);

            $('#add-user-modal').removeClass('hidden');
            body.classList.add('modal-open');

            // Fetch user data using AJAX
            $.ajax({
                type: "GET",
                url: "/vendor/profile",
                success: function(response) {
                  $('#company_name').val(response.user.name);
                  $('#email').val(response.user.email);
                  $('#phone_number').val(response.user.phone_number);
                  $('#address').val(response.user.vendor.address);
                  $('#logo').val(response.user.vendor.logo);


                }
            });
        });

        // Toggle buttons for opening modal
        $('[data-modal-toggle="add-user-modal"]').on('click', function() {
            modal.classList.toggle('hidden');
            body.classList.toggle('modal-open');
        });

        // Close buttons for closing modal
        $('[data-modal-close="add-user-modal"]').on('click', function() {
            modal.classList.add('hidden');
            body.classList.remove('modal-open');
        });

        // Optional: Close the modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
                body.classList.remove('modal-open');
            }
        });
    });
</script>
<script>

    // Clear and add ticket types when editing a form
    function resetTicketTypes() {
        const container = document.getElementById('ticket-types-container');
        container.innerHTML = ''; // Clear existing ticket types before adding new ones
    }

    // Add ticket type dynamically
    document.getElementById('add-ticket-type').addEventListener('click', function () {
        const container = document.getElementById('ticket-types-container');
        const ticketCount = container.children.length;

        const newTicketType = `
            <div class="ticket-type col-span-3 grid grid-cols-3 gap-6 mt-6" id="ticket-type-${ticketCount}">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ticket Type</label>
                    <select name="ticket_types[${ticketCount}][ticket_type]" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Ticket Type</option>
                        <option value="general">General Admission</option>
                        <option value="VIP">VIP</option>
                        <option value="early_bird">Early Bird</option>
                        <option value="student">Student</option>
                        <option value="group">Group</option>
                        <option value="family_pass">Family Pass</option>
                        <option value="sponsorship">Sponsorship</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ticket Price</label>
                    <input type="number" name="ticket_types[${ticketCount}][price]" placeholder="Price (e.g. 50.00)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="ticket_types[${ticketCount}][quantity]" placeholder="Quantity (e.g. 100)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="col-span-3 text-right">
                    <button type="button" class="mt-4 px-4 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded-md remove-ticket-type" data-ticket-id="ticket-type-${ticketCount}">
                        Remove
                    </button>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', newTicketType);
    });

    // Remove ticket type
    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('remove-ticket-type')) {
            const ticketId = event.target.getAttribute('data-ticket-id');
            document.getElementById(ticketId).remove();
        }
    });

    // Open modal and populate fields for editing
    function openModalForEdit(user) {
        // Reset ticket types container before loading the existing ticket types
        resetTicketTypes();

        // Populate form fields with user data
        document.getElementById('company-name').value = user.company_name || '';
        document.getElementById('email').value = user.email || '';
        document.getElementById('phone-number').value = user.phone_number || '';
        document.getElementById('address').value = user.address || '';

        // Load existing ticket types
        user.ticket_types.forEach((ticket, index) => {
            const container = document.getElementById('ticket-types-container');

            const newTicketType = `
                <div class="ticket-type col-span-3 grid grid-cols-3 gap-6 mt-6" id="ticket-type-${index}">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ticket Type</label>
                        <select name="ticket_types[${index}][ticket_type]" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="general" ${ticket.ticket_type === 'general' ? 'selected' : ''}>General Admission</option>
                            <option value="VIP" ${ticket.ticket_type === 'VIP' ? 'selected' : ''}>VIP</option>
                            <option value="early_bird" ${ticket.ticket_type === 'early_bird' ? 'selected' : ''}>Early Bird</option>
                            <option value="student" ${ticket.ticket_type === 'student' ? 'selected' : ''}>Student</option>
                            <option value="group" ${ticket.ticket_type === 'group' ? 'selected' : ''}>Group</option>
                            <option value="family_pass" ${ticket.ticket_type === 'family_pass' ? 'selected' : ''}>Family Pass</option>
                            <option value="sponsorship" ${ticket.ticket_type === 'sponsorship' ? 'selected' : ''}>Sponsorship</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ticket Price</label>
                        <input type="number" name="ticket_types[${index}][price]" value="${ticket.price}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="ticket_types[${index}][quantity]" value="${ticket.quantity}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="col-span-3 text-right">
                        <button type="button" class="mt-4 px-4 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded-md remove-ticket-type" data-ticket-id="ticket-type-${index}">
                            Remove
                        </button>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', newTicketType);
        });

        // Show the modal
        document.getElementById('add-user-modal').classList.remove('hidden');
    }

});




</script>

