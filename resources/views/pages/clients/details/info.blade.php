@php
    $lead = App\Models\Lead::where('id', $id)->first();
@endphp
<div class="flex items-center mb-4 gap-2 flex-wrap">
    <img src="{{ asset('storage/' . $lead->photo) }}" style="height: 100px" alt="">
    <div class="ms-auto align-self-start">
        <div class="ti-dropdown hs-dropdown">
            <a aria-label="anchor" href="javascript:void(0);"
                class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary ti-dropdown-toggle hs-dropdown-toggle">
                <i class="fe fe-more-vertical"></i>
            </a>
            <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                <li><a class="ti-dropdown-item" href="javascript:void(0);" onclick="edit({{ $lead }})"
                        data-hs-overlay="#create-contact"><i
                            class="ri-edit-line align-middle me-1 inline-block"></i>Edit Details</a>
                </li>
                <li>
                    <a class="ti-dropdown-item" href="javascript:void(0);" onclick="edit({{ $lead }})"
                        data-hs-overlay="#create-contact">
                        <i class="ri-lock-unlock-line align-middle me-1 inline-block"></i>
                        Change Password
                    </a>
                </li>
                <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                            class="ri-delete-bin-line me-1 align-middle inline-block"></i>Move to Trash</a>
                </li>
            </ul>
        </div>
    </div>
</div>


<hr class="mt-5 mb-5">

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Whoops! Something went wrong.</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <hr>
@endif

<table class="ti-custom-table ti-custom-table-head !border  border-defaultborder dark:border-defaultborder/10">
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td width="180" class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
            Company
            Name : </td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10 font-bold">
            <i class="bi bi-person mx-2"></i> {{ $lead->company_name }}
        </td>
    </tr>
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td width="180" class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
            Company
            Owner : </td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
            <i class="bi bi-building mx-2"></i> {{ $lead->contact_name }}
        </td>
    </tr>
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td width="180" class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
            Contact
            Number : </td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
            <i class="bi bi-telephone mx-2"></i> {{ $lead->phone }}
        </td>
    </tr>
    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
        <td width="180" class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
            Email
            Address : </td>
        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
            <i class="bi bi-envelope-at mx-2"></i> {{ $lead->email }}
        </td>
    </tr>
</table>
<hr class="mt-6 mb-6">

@include('pages.clients.details.clients')
