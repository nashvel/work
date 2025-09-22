 <span class="bi bi-info-circle mx-1"></span>
 Company Information
 <hr class="mt-3 mb-3">

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

 {{-- @include('pages.admin.clients.details.clients') --}}
