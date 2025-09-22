 <div class="px-3 pt-3 flex justify-between items-center">
     <div>
         <h3 class="text-2xl leading-6 font-medium text-gray-900"><strong>Expenses Tracker</strong></h3>
         <p class="mt-1 max-w-2xl text-sm text-gray-500">Track and manage project expenses.</p>
     </div>
     <a href="{{ route('projects.expenses.create', $project) }}" class="text-dark border  py-2 px-4 rounded-lg">
         <span class="bi bi-plus-lg"></span>
         Add Expense
     </a>
 </div>
 <div class="overflow-x-auto pt-6">
     <table class="min-w-full divide-y divide-gray-200">
         <thead class="bg-gray-50">
             <tr>
                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description
                 </th>
                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category
                 </th>
                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By
                 </th>
                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
             </tr>
         </thead>
         <tbody class="bg-white divide-y divide-gray-200">
             @forelse($project->expenses as $expense)
                 <tr class="hover:bg-gray-50">
                     <td class="px-6 py-4 whitespace-nowrap">
                         <div class="text-sm font-medium text-gray-900">{{ $expense->title }}</div>
                         <div class="text-sm text-gray-500">{{ Str::limit($expense->description, 50) }}</div>
                     </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->category }}</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">
                         ${{ number_format($expense->amount, 2) }}</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                         {{ $expense->expense_date->format('M j, Y') }}</td>
                     <td class="px-6 py-4 whitespace-nowrap">
                         <span
                             class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if ($expense->status === 'approved') bg-green-100 text-green-800
                                                @elseif($expense->status === 'rejected') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                             {{ ucfirst($expense->status) }}
                         </span>
                     </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->creator->name }}</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                         @if ($expense->status === 'pending')
                             <button onclick="approveExpense({{ $expense->id }})"
                                 class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                             <button onclick="rejectExpense({{ $expense->id }})"
                                 class="text-red-600 hover:text-red-900 mr-2">Reject</button>
                         @endif
                         <a href="{{ route('projects.expenses.edit', [$project, $expense]) }}"
                             class="text-indigo-600 hover:text-indigo-900">Edit</a>
                     </td>
                 </tr>
             @empty
                 <tr>
                     <td colspan="7" class="px-6 py-4 text-center text-gray-500">No expenses found</td>
                 </tr>
             @endforelse
         </tbody>
     </table>
 </div>
