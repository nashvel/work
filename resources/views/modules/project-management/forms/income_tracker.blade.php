<div class="pt-3 px-3 flex justify-between items-center">
    <div>
        <h3 class="text-2xl leading-6 font-medium text-gray-900"><strong>Income Tracker</strong></h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Track and manage project income.</p>
    </div>
    <a href="{{ route('projects.incomes.create', $project) }}"
        class="text-dark border  py-2 px-4 rounded-lg">
         <span class="bi bi-plus-lg"></span>
        Add Income
    </a>
</div>
<div class="overflow-x-auto pt-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($project->incomes as $income)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $income->title }}</div>
                        <div class="text-sm text-gray-500">{{ Str::limit($income->description, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $income->source }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                        ${{ number_format($income->amount, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $income->income_date->format('M j, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select onchange="updateIncomeStatus({{ $income->id }}, this.value)"
                            class="text-sm rounded-md border-gray-300
                                                @if ($income->status === 'received') bg-green-100 text-green-800
                                                @elseif($income->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                            <option value="pending" {{ $income->status === 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="received" {{ $income->status === 'received' ? 'selected' : '' }}>Received
                            </option>
                            <option value="cancelled" {{ $income->status === 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $income->creator->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('projects.incomes.edit', [$project, $income]) }}"
                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No income records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
