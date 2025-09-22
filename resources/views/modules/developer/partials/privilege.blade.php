 <div class="grid grid-cols-12 gap-x-6">
     <div class="xxl:col-span-8 col-span-8">
         <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>Payments</strong>
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
         <form
             action="{{ route('developer.route.store') }}"  method="POST" class="space-y-4">
             @csrf

             <!-- Name -->
             <div>
                 <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                 <input type="text" name="name" id="name" value="{{ old('name') }}"
                     class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                 @error('name')
                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                 @enderror
             </div>

             <!-- Path -->
             <div>
                 <label for="path" class="block text-sm font-medium text-gray-700">Path</label>
                 <input type="text" name="path" id="path" value="{{ old('path') }}"
                     placeholder="/dashboard, /orders, /developer/routes"
                     class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                 @error('path')
                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                 @enderror
             </div>

             <!-- Title -->
             <div>
                 <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                 <input type="text" name="title" id="title" value="{{ old('title') }}"
                     class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                 @error('title')
                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                 @enderror
             </div>

             <!-- Description -->
             <div>
                 <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                 <textarea name="description" id="description" rows="3"
                     class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                 @error('description')
                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                 @enderror
             </div>

             <!-- Icon -->
             <div>
                 <label for="icon" class="block text-sm font-medium text-gray-700">Icon</label>
                 <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                     placeholder="e.g., bi bi-house"
                     class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                 @error('icon')
                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                 @enderror
             </div>

             <!-- Sort Order -->
             <div>
                 <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                 <input type="number" name="sort_order" id="sort_order"
                     value="{{ old('sort_order') }}"
                     class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                 @error('sort_order')
                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                 @enderror
             </div>

             <!-- Is Active -->
             <div class="flex items-center">
                 {{-- ensures a value is sent even when unchecked --}}
                 <input type="hidden" name="is_active" value="0">
                 <input type="checkbox" name="is_active" id="is_active" value="1"
                     {{ old('is_active') ? 'checked' : '' }}
                     class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                 <label for="is_active" class="ml-2 block text-sm text-gray-700">Active</label>
                 @error('is_active')
                     <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                 @enderror
             </div>

             <div class="flex gap-2">
                 <button type="submit"
                     class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700">
                        Create Route
                 </button>
                 {{-- <a href="{{ route('developer.routes.index') }}"
                     class="px-4 py-2 border text-sm rounded-lg hover:bg-gray-50">
                     Cancel
                 </a> --}}
             </div>
         </form>

     </div>
 </div>
