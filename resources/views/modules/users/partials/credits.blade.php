 <div class="grid grid-cols-12 gap-x-6">
     <div class="xxl:col-span-8 col-span-8">
         <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>Credit Information</strong>
         </h6>
         <span>You can modify the credit details here.</span>
         <hr class="mb-3 !mt-3">
         @if ($errors->any())
             <div
                 class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                 <div>
                     <strong class="text-danger">Whoops! Something went wrong:</strong>
                     <ul class="list-disc list-inside mt-2 mx-4">
                         @foreach ($errors->all() as $error)
                             <li class="text-dark"><i>{{ $error }}</i></li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         @endif

          @include('modules.users.partials.credits.logs')
     </div>
     <div class="xxl:col-span-4 col-span-4">
        <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>Credit Total</strong>
         </h6>
         <span>You can adjust credit here.</span>
         <hr class="mb-3 !mt-3">
         <div class="grid grid-cols-12 gap-x-6 mb-2">
             <div class="col-span-4">
                 <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('adjustment')"
                     class="ti-btn ti-btn-light !rounded-full label-ti-btn w-full">
                     <i class="bi bi-tools label-ti-btn-icon me-2"></i>
                     Credit
                 </button>
             </div>
             <div class="col-span-4">
                 <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('charge')"
                     class="ti-btn ti-btn-light !rounded-full btn-wave w-full waves-effect waves-light label-ti-btn">
                     <i class="bi bi-clock-history  label-ti-btn-icon "></i>
                     Charge
                 </button>
             </div>
             <div class="col-span-4">
                 <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('add')"
                     class="ti-btn ti-btn-light !rounded-full label-ti-btn w-full">
                     <i class="bi bi-window-plus label-ti-btn-icon  me-2"></i>
                     Add
                 </button>
             </div>
         </div>
          @include('modules.users.partials.credits.widget')
          <hr class="mb-3 !mt-3">
           
     </div>
 </div>
