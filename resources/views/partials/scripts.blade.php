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
});

document.getElementById('add-ticket-type').addEventListener('click', function() {
    const container = document.getElementById('ticket-types-container');
    const ticketCount = container.children.length;
    const newTicketType = `
      <div class="ticket-type col-span-3 grid grid-cols-3 gap-6 mt-6">
        <div>
          <label class="block text-sm font-medium text-gray-700">Ticket Type</label>
          <input type="text" name="ticket_types[${ticketCount}][name]" placeholder="Ticket Type (e.g. General Admission)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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

</script>