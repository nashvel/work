<x-app-layout>
    <x-slot name="title">Manage Bids Sent</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Tools"}</x-slot>
    <x-slot name="active">Bids Sent</x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body ">
                    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" autocomplete="on">
                        @csrf

                        <div class="grid grid-cols-12 gap-4 p-5">
                            <!-- Company -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="company" class="form-label">Company <strong class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="company" id="company" required
                                        placeholder="Enter Company Name"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-building"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Project -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="project" class="form-label">Project <strong class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="project" id="project" required
                                        placeholder="Project Name"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-kanban"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="address" class="form-label">Address</label>
                                <div class="relative">
                                    <input type="text" name="address" id="address" placeholder="Enter Address"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="total_price" class="form-label">Total Price</label>
                                <div class="relative">
                                    <input type="number" name="total_price" id="total_price" step="0.01"
                                        placeholder="e.g. 170920"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-cash-coin"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- SF -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="sf" class="form-label">SF</label>
                                <div class="relative">
                                    <input type="number" name="sf" id="sf" step="0.01"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-aspect-ratio"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Vendio -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="vendio" class="form-label">Vendio</label>
                                <div class="relative">
                                    <input type="number" name="vendio" id="vendio" step="0.01"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-percent"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Bid -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="bid" class="form-label">Bid</label>
                                <div class="relative">
                                    <input type="text" name="bid" id="bid"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-file-earmark-bar-graph"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Devi -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="devi" class="form-label">Devi</label>
                                <div class="relative">
                                    <input type="text" name="devi" id="devi"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-compass"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Scope -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="scope" class="form-label">Scope</label>
                                <div class="relative">
                                    <input type="text" name="scope" id="scope"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-layers"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Sent Date -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="sent" class="form-label">Sent Date</label>
                                <div class="relative">
                                    <input type="date" name="sent" id="sent"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-calendar2-check"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Name -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="contact_name" class="form-label">Contact Name</label>
                                <div class="relative">
                                    <input type="text" name="contact_name" id="contact_name"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="relative">
                                    <input type="email" name="email" id="email"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="phone" class="form-label">Phone</label>
                                <div class="relative">
                                    <input type="tel" name="phone" id="phone"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-telephone-forward"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Award Date -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="award_date" class="form-label">Award Date</label>
                                <div class="relative">
                                    <input type="date" name="award_date" id="award_date"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-trophy"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Follow Up -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="follow_up" class="form-label">Follow Up</label>
                                <div class="relative">
                                    <input type="text" name="follow_up" id="follow_up"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-alarm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end gap-3">
                            <button type="reset" class="bg-gray-100 text-dark px-4 py-2 rounded-md hover:bg-gray-300 transition">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition flex items-center gap-1">
                                <i class="bi bi-check-circle"></i>
                                <span>Save Project</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
