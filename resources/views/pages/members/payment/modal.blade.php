<div id="purchase" class="hs-overlay hidden ti-modal">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
        <div class="ti-modal-content">

            <!-- 🔹 Modal Header -->
            <div class="ti-modal-header">
                <h6 class="ti-modal-title inline-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-message-chatbot">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                        <path d="M9.5 9h.01" />
                        <path d="M14.5 9h.01" />
                        <path d="M9.5 13a3.5 3.5 0 0 0 5 0" />
                    </svg>
                    <span class="mx-2" id="formTitle">Purchase Credit Hours</span>
                </h6>
                <button type="button" class="ti-modal-close-btn" data-hs-overlay="#purchase">
                    <span class="sr-only">Close</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M18 6l-12 12" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="ti-modal-body">

                <!-- Credit Selection Section -->
                <div id="creditSelector" class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 text-center">Purchase Credit Hours</h2>

                    <div class="flex flex-wrap gap-3 justify-center items-center">
                        <!-- Add more options -->
                        <button
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 border border-blue-300 hover:bg-blue-200 transition"
                            onclick="selectCredit(5)">
                            <i class="bi bi-clock"></i> 5 Hours - $25
                        </button>
                        <button
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 border border-blue-300 hover:bg-blue-200 transition"
                            onclick="selectCredit(10)">
                            <i class="bi bi-clock-history"></i> 10 Hours - $45
                        </button>
                        <button
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 border border-blue-300 hover:bg-blue-200 transition"
                            onclick="selectCredit(20)">
                            <i class="bi bi-hourglass-split"></i> 20 Hours - $80
                        </button>
                        <button
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 border border-blue-300 hover:bg-blue-200 transition"
                            onclick="selectCredit(50)">
                            <i class="bi bi-alarm-fill"></i> 50 Hours - $180
                        </button>
                        <button
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 border border-blue-300 hover:bg-blue-200 transition"
                            onclick="selectCredit(100)">
                            <i class="bi bi-hourglass-top"></i> 100 Hours - $340
                        </button>
                    </div>

                    <div class="pt-3 text-center">
                        <div class="flex items-center justify-center mb-3">
                            <hr class="w-1/4 border-t-1 border-gray-300 mr-2">
                            <p class="text-1xl font-normal text-gray-500"><i class="px-3 ps-3"> OR </i></p>
                            <hr class="w-1/4 border-t-1 border-gray-300 ml-2">
                        </div>
                        <h2 class="text-sm font-semibold text-gray-800 my-3"> Custom Hours</h2>

                        <input type="number" min="1" id="customCredit"
                            class="mt-1 w-1/2 mb-3 border rounded-lg px-3 py-2 mx-auto block text-center"
                            placeholder="e.g., 8">
                        <button
                            class="mt-3 inline-block py-2 px-6 mb-3 rounded-full bg-green-500 text-white hover:bg-green-600"
                            onclick="useCustomCredit()">Continue to Payment Method</button>
                    </div>
                </div>

                <!-- Payment Form -->
                <div class="w-full mx-auto p-6 bg-white rounded-2xl shadow-xl hidden" id="paymentForm">
                    <h2 class="text-xl font-bold text-center text-gray-800 mb-4">
                        
                        Pay for <span
                            id="creditAmountText"></span> <i class="bi bi-hourglass-split text-[20px]"></i> Hours</h2>

                    <div class="flex justify-center mb-4">
                        <button onclick="goBackToPurchase()" class="text-sm text-blue-600 hover:underline">
                            ← Back to Purchase Options
                        </button>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border shadow-sm">
                        <form onsubmit="event.preventDefault();">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                                    <div class="relative">
                                        <input type="text" id="cardNumber" maxlength="19"
                                            placeholder="4321 5678 9012 3456"
                                            class="w-full px-6 py-2 border rounded-lg pr-12 ti-form-input focus:z-10"
                                            required oninput="detectCardType(this.value)">
                                        <!-- Card icon on the right -->
                                        <div
                                            class="absolute inset-y-0 end-0 flex items-center pe-4 pointer-events-none z-20">
                                            <img id="cardIcon" src="" alt=""
                                                class="w-7 h-7 hidden object-contain" loading="lazy" />
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Cardholder Name</label>
                                    <input type="text" placeholder="Kimberly Ann Madelo"
                                        class="w-full px-4 py-2 border rounded-lg" required>
                                </div>

                                <div class="flex gap-4">
                                    <div class="w-1/2">
                                        <label class="block text-sm font-medium text-gray-700">Expiry</label>
                                        <input type="text" id="expiryDate" maxlength="5" placeholder="MM/YY"
                                            class="w-full px-4 py-2 border rounded-lg" required
                                            oninput="formatExpiryDate(this)">
                                    </div>
                                    <div class="w-1/2">
                                        <label class="block text-sm font-medium text-gray-700">CVV</label>
                                        <input type="text" maxlength="4" placeholder="900"
                                            class="w-full px-4 py-2 border rounded-lg" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="mt-6 w-full py-2 px-4 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-700 transition">
                                Submit Payment
                            </button>
                        </form>
                    </div>
                </div>

                <script>
                    let selectedCredit = 0;

                    function selectCredit(hours) {
                        selectedCredit = hours;
                        showPaymentForm();
                    }

                    function formatExpiryDate(input) {
                        let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
                        if (value.length >= 3) {
                            value = value.substring(0, 2) + '/' + value.substring(2, 4); // Add slash
                        }
                        input.value = value;
                    }

                    function useCustomCredit() {
                        const customVal = parseInt(document.getElementById('customCredit').value);
                        if (customVal && customVal > 0) {
                            selectedCredit = customVal;
                            showPaymentForm();
                        } else {
                            alert('Please enter a valid number of hours');
                        }
                    }

                    function showPaymentForm() {
                        document.getElementById('creditSelector').classList.add('hidden');
                        document.getElementById('paymentForm').classList.remove('hidden');
                        document.getElementById('creditAmountText').textContent = selectedCredit;
                    }

                    function goBackToPurchase() {
                        document.getElementById('paymentForm').classList.add('hidden');
                        document.getElementById('creditSelector').classList.remove('hidden');
                    }

                    function detectCardType(number) {

                        const icon = document.getElementById('cardIcon');
                        const card = number.replace(/\D/g, ''); // Remove non-numeric characters

                        // Detect the card type
                        let src = '';
                        if (/^4/.test(card)) {
                            src = '/v1/icons/visa.png'; // Visa icon
                        } else if (/^5[1-5]/.test(card)) {
                            src = '/v1/icons/card.png'; // MasterCard icon
                        } else if (/^3[47]/.test(card)) {
                            src = '/v1/icons/amex.png'; // Amex icon
                        } else if (/^6/.test(card)) {
                            src = '/v1/icons/discover.png'; // Discover icon
                        }

                        // Show the appropriate icon based on card type
                        if (src) {
                            icon.src = src;
                            icon.classList.remove('hidden');
                        } else {
                            icon.classList.add('hidden');
                        }

                        // Auto-format card number with spaces
                        let formattedValue = card.replace(/(\d{4})(?=\d)/g, '$1 '); // Add space after every 4 digits
                        document.getElementById('cardNumber').value = formattedValue;
                    }
                </script>
            </div>


            <!-- Payment Form (Initially Hidden) -->


        </div>
    </div>
</div>