
  <!-- Include FontAwesome for Icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <!-- Modal JavaScript -->
  <script>
    const bookNowBtn = document.getElementById('bookNowBtn');
    const bookingModal = document.getElementById('bookingModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const decreaseBtn = document.getElementById('decrease');
    const increaseBtn = document.getElementById('increase');
    const ticketCountEl = document.getElementById('ticketCount');
    const totalPriceEl = document.getElementById('totalPrice');

    let ticketCount = 1;
    const ticketPrice = 500;

    // Show modal
    bookNowBtn.addEventListener('click', () => {
      bookingModal.classList.remove('hidden');
    });

    // Close modal
    closeModalBtn.addEventListener('click', () => {
      bookingModal.classList.add('hidden');
    });

    // Increase ticket count
    increaseBtn.addEventListener('click', () => {
      ticketCount++;
      ticketCountEl.textContent = ticketCount;
      totalPriceEl.textContent = ticketCount * ticketPrice;
    });

    // Decrease ticket count
    decreaseBtn.addEventListener('click', () => {
      if (ticketCount > 1) {
        ticketCount--;
        ticketCountEl.textContent = ticketCount;
        totalPriceEl.textContent = ticketCount * ticketPrice;
      }
    });
  </script>

<footer class="bg-gray-800 text-white py-10">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Contact Info -->
      <div>
        <h3 class="text-lg font-bold mb-4">Contact Us</h3>
        <p class="mb-2">Email: contact@eventmanager.com</p>
        <p class="mb-2">Phone: +123-456-7890</p>
        <p>Address: 123 Event Street, City, Country</p>
      </div>



      <!-- Social Media -->
      <div>
        <h3 class="text-lg font-bold mb-4">Follow Us</h3>
        <div class="flex space-x-4">
          <a href="#" class="bg-blue-500 p-3 rounded-full"><img src="facebook-icon.png" alt="Facebook" class="w-5 h-5"></a>
          <a href="#" class="bg-blue-400 p-3 rounded-full"><img src="twitter-icon.png" alt="Twitter" class="w-5 h-5"></a>
          <a href="#" class="bg-pink-500 p-3 rounded-full"><img src="instagram-icon.png" alt="Instagram" class="w-5 h-5"></a>
          <a href="#" class="bg-red-500 p-3 rounded-full"><img src="youtube-icon.png" alt="YouTube" class="w-5 h-5"></a>
        </div>
      </div>
    </div>

    <div class="mt-10 border-t border-gray-700 pt-4 text-center">
      <p>&copy; 2024 Event Management System. All rights reserved.</p>
    </div>
</footer>
