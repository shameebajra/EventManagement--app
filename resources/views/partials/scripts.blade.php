
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const modal = document.getElementById('add-user-modal');
      const toggleButtons = document.querySelectorAll('[data-modal-toggle="add-user-modal"]');
      const closeButtons = document.querySelectorAll('[data-modal-close="add-user-modal"]');
      const body = document.body;

      // Open modal on toggle button click
      toggleButtons.forEach(button => {
          button.addEventListener('click', function () {
              modal.classList.toggle('hidden');
              body.classList.toggle('modal-open');
          });
      });

      // Close modal on close button click
      closeButtons.forEach(button => {
          button.addEventListener('click', function () {
              modal.classList.add('hidden');
              body.classList.remove('modal-open');
          });
      });

      // Optional: Close the modal when clicking outside the modal content
      window.addEventListener('click', function (event) {
          if (event.target === modal) {
              modal.classList.add('hidden');
              body.classList.remove('modal-open');
          }
      });

     // Add ticket type dynamically
      document.getElementById('add-ticket-type').addEventListener('click', function () {
          const container = document.getElementById('ticket-types-container');
          const ticketCount = container.children.length;

          const newTicketType = `
              <div class="ticket-type col-span-3 grid grid-cols-3 gap-6 mt-6">
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
              </div>
          `;

          container.insertAdjacentHTML('beforeend', newTicketType);
      });

  });

  // Function to open modal and populate fields with user data
  function openModal(user) {
      // Populate input fields with user data
      document.getElementById('company-name').value = user.company_name || '';
      document.getElementById('email').value = user.email || '';
      document.getElementById('phone-number').value = user.phone_number || '';
      document.getElementById('address').value = user.address || '';

      // Show the modal
      document.getElementById('add-user-modal').classList.remove('hidden');
  }

  //display error or success message for 5second
  document.addEventListener('DOMContentLoaded', function () {
  const flashMessage = document.getElementById('flash-message');
  if (flashMessage) {
    // Wait for 5 seconds (5000ms)
    setTimeout(() => {
      // Apply CSS transition for a smooth fade-out
      flashMessage.style.transition = 'opacity 0.5s ease-out';
      flashMessage.style.opacity = '0';

      // Remove the message from the DOM after fade-out (500ms)
      setTimeout(() => flashMessage.remove(), 500);
    }, 3000); // 3-second delay
  }
});


// for map
        document.addEventListener('DOMContentLoaded', function () {
            // Ensure Leaflet has been loaded correctly
            if (typeof L === 'undefined') {
                console.error('Leaflet failed to load.');
                return;
            }

            // Initialize the map and set it to Kathmandu, Nepal
            var map = L.map('map').setView([27.7172, 85.3240], 13);

            // Load the OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add the Locate Control to the map
            L.control.locate({
                position: 'topright',
                strings: {
                    title: "Show me where I am"  // Custom tooltip text
                },
                drawCircle: true,  // Optional: show a circle around the location
                keepCurrentZoomLevel: true
            }).addTo(map);

            // Optional: Add a marker with popup
            L.marker([27.7172, 85.3240]).addTo(map)
                .bindPopup('Kathmandu, Nepal')
                .openPopup();
        });

        //get data for view model
        $(document).on('click','.userView',function(){
            var _this = $(this).parents('tr');
            $('#v_company-name').val(_this.find('.id').text());
            $('#v_email').val(_this.find('.id').text());
            $('#v_phone-number').val(_this.find('.id').text());
            $('#v_address').val(_this.find('.id').text());
            $('#v_logo').val(_this.find('.id').text());

        });
</script>



