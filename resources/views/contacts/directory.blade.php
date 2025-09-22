<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Contacts Directory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="mx-auto max-w-6xl p-6">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <h1 class="text-2xl font-semibold">Contacts Directory</h1>
      <a href="{{ route('contacts.directory.export') }}"
         class="inline-flex items-center gap-2 rounded bg-emerald-600 px-4 py-2 font-medium text-white hover:bg-emerald-700">
        <!-- download icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
          <polyline points="7 10 12 15 17 10"></polyline>
          <line x1="12" y1="15" x2="12" y2="3"></line>
        </svg>
        Export CSV
      </a>
    </div>
    
    @if($contacts->isEmpty())
      <div class="rounded border border-gray-200 bg-white p-6 text-gray-600">
        No contacts found.
      </div>
    @else
      <div class="overflow-hidden rounded border border-gray-200 bg-white">
        <table class="min-w-full border-separate border-spacing-0">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Company</th>
              <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Type</th>
              <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
              <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Phone</th>
              <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Website</th>
              <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Contact Persons</th>
            </tr>
          </thead>
          <tbody>
            @foreach($contacts as $c)
              <tr class="border-t border-gray-200 align-top">
                <td class="px-4 py-3">
                  <div class="font-medium">{{ $c->company_name }}</div>
                </td>
                <td class="px-4 py-3 text-sm text-gray-700">{{ $c->type }}</td>
                <td class="px-4 py-3 text-sm text-blue-700">
                  @if($c->email)
                    <a href="mailto:{{ $c->email }}" class="hover:underline">{{ $c->email }}</a>
                  @endif
                </td>
                <td class="px-4 py-3 text-sm text-gray-700">{{ $c->phone }}</td>
                <td class="px-4 py-3 text-sm">
                  @if($c->website)
                    <a href="{{ Str::startsWith($c->website, ['http://','https://']) ? $c->website : 'https://'.$c->website }}"
                       target="_blank"
                       class="text-blue-700 hover:underline">
                      {{ $c->website }}
                    </a>
                  @endif
                </td>
                <td class="px-4 py-3">
                  @if($c->people->isEmpty())
                    <div class="text-sm text-gray-500">No contact persons.</div>
                  @else
                    <ul class="space-y-2">
                      @foreach($c->people as $p)
                        <li class="rounded border border-gray-200 bg-gray-50 p-3">
                          <div class="text-sm font-medium">
                            {{ $p->first_name }} {{ $p->last_name }}
                            @if($p->position)
                              <span class="text-gray-500">— {{ $p->position }}</span>
                            @endif
                          </div>
                          <div class="mt-1 text-xs text-gray-700">
                            @if($p->email)
                              <a href="mailto:{{ $p->email }}" class="mr-3 text-blue-700 hover:underline">
                                {{ $p->email }}
                              </a>
                            @endif
                            @if($p->phone)
                              <span>{{ $p->phone }}</span>
                            @endif
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</body>
</html>
