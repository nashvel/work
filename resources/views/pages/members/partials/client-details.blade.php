<table class="ti-custom-table ti-custom-table-head !border border-defaultborder dark:border-defaultborder/10">

    <!-- First Name -->
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
            First Name: <strong class="text-danger">*</strong>
        </td>
        <td colspan="5" class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="text" name="first_name" id="first-name" placeholder="Enter First Name"
                    value="{{ old('first_name', $client->first_name) }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </td>
    </tr>

    <!-- Last Name -->
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
            Last Name: <strong class="text-danger">*</strong>
        </td>
        <td colspan="5" class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="text" name="last_name" id="last-name" placeholder="Enter Last Name"
                    value="{{ old('last_name', $client->last_name) }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </td>
    </tr>

    <!-- Company and Position -->
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
            Company Name: <strong class="text-danger">*</strong>
        </td>
        <td colspan="3" class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="text" name="company" id="company" placeholder="Company" readonly va
                    value="{{ old('company', '-') }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-building"></i>
                </div>
            </div>
        </td>
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
            Position: <strong class="text-danger">*</strong>
        </td>
        <td colspan="2" class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="text" name="position" id="position" placeholder="Position"
                    value="{{ old('position', $client->position) }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-briefcase"></i>
                </div>
            </div>
        </td>
    </tr>

    <!-- Type and Lead Source -->
    {{-- <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">Type: <strong class="text-danger">*</strong></td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <select name="type" id="type" class="form-select p-2 px-4 w-full">
                    <option value="" disabled {{ old('type', $client->type) ? '' : 'selected' }}>-</option>
                    @foreach(['Supplier', 'Distributor', 'General Contractor', 'Subcontractor', 'Other', 'Architect', 'Owner'] as $type)
                        <option value="{{ $type }}" {{ old('type', $client->type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
        </td>
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">Lead Source: <strong class="text-danger">*</strong></td>
        <td colspan="3" class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <select name="lead_source" id="lead_source" class="form-select p-2 px-4 w-full">
                    <option value="" disabled {{ old('lead_source', $client->lead_source) ? '' : 'selected' }}>-</option>
                    @foreach([
                        'Plan Panther Subscription',
                        'No Plan Panther Subscription',
                        'Potential Plan Panther Subscription'
                    ] as $source)
                        <option value="{{ $source }}" {{ old('lead_source', $client->lead_source) === $source ? 'selected' : '' }}>
                            {{ $source }}
                        </option>
                    @endforeach
                </select>
            </div>
        </td>
    </tr> --}}

    <!-- City, State, Zip -->
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">City: <strong class="text-danger">*</strong></td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="text" name="city" id="city" placeholder="Enter City"
                    value="{{ old('city', $client->city) }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-geo-alt"></i>
                </div>
            </div>
        </td>
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">State: <strong class="text-danger">*</strong></td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="text" name="state" id="state" placeholder="Enter State"
                    value="{{ old('state', $client->state) }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-map"></i>
                </div>
            </div>
        </td>
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">Zip Code: <strong class="text-danger">*</strong></td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="text" name="zip" id="zip" placeholder="Code"
                    value="{{ old('zip', $client->zip) }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-123"></i>
                </div>
            </div>
        </td>
    </tr>

    <!-- Phone and Email -->
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">Phone: <strong class="text-danger">*</strong></td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="tel" name="phone" id="contact-phone" placeholder="Enter Phone Number"
                    value="{{ old('phone', $client->phone) }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-telephone"></i>
                </div>
            </div>
        </td>
        <td class="text-end border-2 border-defaultborder dark:border-defaultborder/10">Email Address: <strong class="text-danger">*</strong></td>
        <td colspan="3" class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
            <div class="relative p-1">
                <input type="email" name="email" id="contact-mail" placeholder="Enter Email Address"
                    value="{{ old('email', $client->email) }}"
                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
        </td>
    </tr>
</table>
