<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.bookbtn', function() {
            var event_id = $(this).val();
            $('#bookingModal').removeClass('hidden'); 

            $.ajax({
                type: "GET",
                url: "/event/" + event_id,
                success: function(response) {
                    console.log(response); // Debugging log

                    if (response.event) {
                        // Display event date
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
                                ticketOptions += `
                                    <option value="${ticket.price}" data-ticket-type="${ticket.ticket_type}" data-ticket-id="${ticket.id}">
                                        ${ticket.ticket_type} - Rs. ${ticket.price}
                                    </option>
                                `;
                            });

                            $('#ticketTypeSelect').html(ticketOptions);
                        } else {
                            console.warn('No ticket data found');
                            $('#ticketTypeSelect').html('<option value="" disabled>No tickets available</option>');
                        }
                    } else {
                        console.warn('Event data not found');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });

        // Update total price when ticket type or count changes
        $('#ticketTypeSelect').on('change', function() {
            const selectedPrice = parseFloat($(this).val());
            const ticketCount = parseInt($('#ticketCount').text());
            $('#totalPrice').text((selectedPrice * ticketCount).toFixed(2));
        });

        $('#increase').on('click', function() {
            let count = parseInt($('#ticketCount').text());
            count++;
            $('#ticketCount').text(count);

            const selectedPrice = parseFloat($('#ticketTypeSelect').val());
            if (!isNaN(selectedPrice)) {
                $('#totalPrice').text((selectedPrice * count).toFixed(2));
            }
        });

        $('#decrease').on('click', function() {
            let count = parseInt($('#ticketCount').text());
            if (count > 1) {
                count--;
                $('#ticketCount').text(count);

                const selectedPrice = parseFloat($('#ticketTypeSelect').val());
                if (!isNaN(selectedPrice)) {
                    $('#totalPrice').text((selectedPrice * count).toFixed(2));
                }
            }
        });

        // Close button logic
        $('#closeModalBtn, #cancelBtn').on('click', function() {
            $('#bookingModal').addClass('hidden'); // Hide the modal
        });

        // Handle the booking form submission
        $('#bookBtn').on('click', function() {
            // Get form data
            const ticketType = $('#ticketTypeSelect option:selected').data('ticket-type'); 
            const quantity = parseInt($('#ticketCount').text());
            const totalPrice = parseFloat($('#totalPrice').text());

            // Create a form data object
            const formData = {
                ticket_id: $('#ticketTypeSelect').find(':selected').data('ticket-id'),
                quantity: quantity,
                total: totalPrice, 
                userName: $('#userName').val(), 
                userEmail: $('#userEmail').val(), 
                userPhoneNumber: $('#userPhoneNumber').val(), 
            };

            // AJAX request to submit the form
            $.ajax({
                type: "POST",
                url: "{{ route('event.book') }}", 
                data: formData,
                success: function(response) {
                    alert('Booking successful!'); 
                    $('#bookingModal').addClass('hidden'); 
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
                }
            });
        });
    });
</script>
