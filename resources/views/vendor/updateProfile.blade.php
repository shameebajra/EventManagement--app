<!-- Add User Modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 flex items-center justify-center h-modal sm:h-full" id="add-user-modal">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <div class="bg-white rounded-lg shadow relative">
            <!-- Modal Header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">Update Profile</h3>
                <button
                    type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-modal"
                    data-modal-close="add-user-modal" data-id="'.$item->id.'">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-6">
                <form action="{{ url('vendor/profile/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                            <input disabled type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" >
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="company-name" class="text-sm font-medium text-gray-900 block mb-2">Company Name</label>
                            <input type="text" name="company_name" id="company_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" >
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone-number" class="text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"  >
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="address" class="text-sm font-medium text-gray-900 block mb-2">Address</label>
                            <input type="text" name="address" id="address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"  >
                            @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6  sm:col-span-6">
                            <label for="logo" class="text-sm font-medium text-gray-900 block mb-2">Logo</label>
                            <input type="file" name="logo" id="logo" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" >
                            @error('logo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Update</button>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->

        </div>
    </div>
</div>


