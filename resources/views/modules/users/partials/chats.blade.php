 <div class="grid grid-cols-12 gap-x-6">
     <div class="xxl:col-span-8 col-span-8">
         <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>Chats</strong>
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

     </div>
     <div class="xxl:col-span-4 col-span-4">
        <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>Tools</strong>
         </h6>
         <span>You can adjust credit here.</span>
         <hr class="mb-3 !mt-3">
         
     </div>
 </div>
