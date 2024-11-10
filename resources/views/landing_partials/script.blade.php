<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Show the modal when the book button is clicked
        $(document).on('click', '.bookbtn', function() {
            var event_id = $(this).val();
            $('#bookingModal').removeClass('hidden');

            // Set initial ticket quantity to 1 and total price to 0.00
            $('#ticketCount').text(1);
            $('#totalPrice').text('0.00');

            $.ajax({
                type: "GET",
                url: "/event/" + event_id,
                success: function(response) {
                    if (response.event) {
                        // Display event date and time
                        const date = new Date(response.event.date);
                        const time = response.event.time;

                        // Format date and time
                        const formattedDate = date.toLocaleDateString('en-US', {
                            weekday: 'long',
                            month: 'long',
                            day: 'numeric',
                        });
                        const formattedTime = new Date('1970-01-01T' + time).toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });

                        $('#eventDate').text(formattedDate);
                        $('#eventTime').text(formattedTime);

                        $('#userName').val(response.user.name);
                        $('#userPhoneNumber').val(response.user.phone_number);
                        $('#userEmail').val(response.user.email);

                        // Check and display ticket details
                        if (response.event.ticket_types && response.event.ticket_types.length > 0) {
                            let ticketOptions = '<option value="" disabled selected>Select a ticket</option>';
                            response.event.ticket_types.forEach(ticket => {
                                ticketOptions += `<option value="${ticket.price}" data-ticket-type="${ticket.ticket_type}" data-ticket-id="${ticket.id}" data-price="${ticket.price}">${ticket.ticket_type} - Rs. ${ticket.price}</option>`;
                            });
                            $('#ticketTypeSelect').html(ticketOptions);
                        } else {
                            $('#ticketTypeSelect').html('<option value="" disabled>No tickets available</option>');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });

        // Update total price when ticket type or count changes
        $('#ticketTypeSelect').on('change', function() {
            const selectedOption = $('#ticketTypeSelect option:selected');
            const selectedPrice = parseFloat(selectedOption.data('price'));
            const ticketCount = parseInt($('#ticketCount').text());
            $('#totalPrice').text((selectedPrice * ticketCount).toFixed(2));
        });

        // Increase ticket count
        $('#increase').on('click', function(event) {
            event.preventDefault(); // Prevent default button behavior
            let count = parseInt($('#ticketCount').text());
            if (!isNaN(count)) {
                count++; // Increment the count by 1
                $('#ticketCount').text(count);  // Update quantity display
                updateTotalPrice();
            }
        });

        // Decrease ticket count
        $('#decrease').on('click', function(event) {
            event.preventDefault(); // Prevent default button behavior
            let count = parseInt($('#ticketCount').text());
            if (count > 1) {  // Ensure quantity does not go below 1
                count--; // Decrement the count by 1
                $('#ticketCount').text(count);  // Update quantity display
                updateTotalPrice();
            }
        });

        // Close modal
        $('#closeModalBtn, #cancelBtn').on('click', function() {
            $('#bookingModal').addClass('hidden'); // Hide the modal
        });

        // Handle the booking form submission
        $('#bookBtn').on('click', function() {
            var button = $(this);
            button.prop('disabled', true);
            button.text('Booking...');

            const selectedOption = $('#ticketTypeSelect option:selected');
            const ticketId = selectedOption.data('ticket-id');
            const ticketType = selectedOption.data('ticket-type');
            const quantity = parseInt($('#ticketCount').text());
            const totalPrice = parseFloat($('#totalPrice').text());

            const formData = {
                ticket_id: ticketId,
                ticket_type: ticketType,
                quantity: quantity,
                total: totalPrice,
                userName: $('#userName').val(),
                userEmail: $('#userEmail').val(),
                userPhoneNumber: $('#userPhoneNumber').val(),
            };

            $.ajax({
                type: "POST",
                url: "{{ route('event.book') }}",
                data: formData,
                success: function(response) {
                    alert('Booking successful!');
                    $('#bookingModal').addClass('hidden'); // Hide modal after success
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                        let errorMsg = '';
                        $.each(errors, function(key, value) {
                            errorMsg += value[0] + '\n';
                        });
                        alert('There were errors:\n' + errorMsg);
                    } else {
                        alert('There was an error with your booking. Please try again.');
                    }
                },
                complete: function() {
                    button.prop('disabled', false);
                    button.text('Book');
                }
            });
        });

        // Update total price
        function updateTotalPrice() {
            const selectedOption = $('#ticketTypeSelect option:selected');
            const selectedPrice = parseFloat(selectedOption.data('price'));
            const ticketCount = parseInt($('#ticketCount').text());
            $('#totalPrice').text((selectedPrice * ticketCount).toFixed(2));
        }
    });
</script>
