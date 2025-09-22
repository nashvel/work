<x-app-layout>

    <x-slot name="title">Manage Leads Information</x-slot>
    <x-slot name="url_1">{"link": "/crm/lead/generic", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/crm/lead/generic", "text": "Leads"}</x-slot>
    <x-slot name="active">Information</x-slot>
    <x-slot name="buttons">
        <button id="addRow" class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave ">
            <i class="bi bi-plus-lg me-1"></i> Add Row
        </button>
        <button id="addCol" class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0">
            <i class="bi bi-plus-lg me-1"></i> Add Column
        </button>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the virtual assistant here.
                    <hr class="mb-3 mt-3">
                    <div class="custom-box">

                        <style>
                            /* Apply border radius to the table and inputs */
                            .table-responsive {
                                overflow: hidden;
                                /* Hide overflow caused by rounded corners */
                                /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); */
                                /* Optional shadow for table */
                            }
                        
                            #featureTable td,
                            #featureTable th {
                                border: 1px solid rgba(0, 0, 0, 0.2);
                            }
                        
                            #featureTable {
                                border-collapse: collapse;
                            }
                        
                            #featureTable input[type="text"] {
                                width: 100%;
                                border: none;
                                background: transparent;
                                padding: 4px 6px;
                                font-size: 14px;
                                outline: none;
                                box-shadow: none;
                                border-radius: 6px;
                                /* Rounded corners for input */
                            }
                        
                            #featureTable input[type="text"]:focus {
                                background-color: #fef9e7;
                                border: 1px solid #ccc;
                                border-radius: 6px;
                                /* Rounded corners for focused input */
                            }
                        
                            #featureTable td {
                                padding: 0;
                                vertical-align: middle;
                            }
                        
                            /* Bold header inputs */
                            #featureTable .fw-bold {
                                font-weight: bold;
                            }
                        </style>

                        <div class="table-responsive shadow">
                            <table id="featureTable" class="table table-sm align-middle text-sm">
                                <tbody>
                                    @for ($i = 0; $i < $rowCount; $i++)
                                        <tr @if ($i == 0) class="fw-bold" @endif>
                                            <!-- Add the bold class to the first row -->
                                            <!-- Add row number -->
                                            <td class="row-number text-center" style="width: 50px;">
                                                <center>{{ $i + 1 }}.</center>
                                            </td>
                                            <!-- Row number in the first column -->

                                            @for ($j = 0; $j < $colCount; $j++)
                                                @php
                                                    $cell = $leads->first(function ($lead) use ($i, $j) {
                                                        return $lead->row_index === $i && $lead->column_index === $j;
                                                    });
                                                @endphp
                                                <td style="min-width: 150px;">
                                                    <input type="text" class="cell" data-row="{{ $i }}"
                                                        data-col="{{ $j }}"
                                                        value="{{ $cell?->value ?? '' }}">
                                                </td>
                                            @endfor
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let rowCount = {{ $i }}; // Number of rows initialized
        let colCount = {{ $j }}; // Number of columns

        // Add Row functionality
        document.getElementById('addRow').addEventListener('click', function() {
            const table = document.getElementById('featureTable').getElementsByTagName('tbody')[0];
            const newRow = document.createElement('tr');

            // Add row number to the first column
            const rowNumberCell = document.createElement('td');
            rowNumberCell.classList.add('row-number');
            rowNumberCell.innerHTML = "<center>" + (rowCount + 1) + ".</center>"; // Set the row number with bold formatting
            newRow.appendChild(rowNumberCell);

            // Add cells to the new row
            for (let j = 0; j < colCount; j++) {
                const td = document.createElement('td');
                td.innerHTML =
                    `<input type="text" class="form-control cell" data-row="${rowCount}" data-col="${j}" value="">`;
                newRow.appendChild(td);
            }

            // Append the new row to the table
            table.appendChild(newRow);
            rowCount++; // Increment row count after adding a new row
        });

        // Add Column functionality
        document.getElementById('addCol').addEventListener('click', function() {
            const rows = document.querySelectorAll('#featureTable tbody tr');

            rows.forEach((row, i) => {
                const td = document.createElement('td');
                td.innerHTML =
                    `<input type="text" class="form-control cell" data-row="${i}" data-col="${colCount}" value="">`;
                row.appendChild(td);
            });

            colCount++; // Increment column count after adding a new column
        });
    </script>



    <script>
        $(document).on('input', '.cell', function() {
            const row = $(this).data('row');
            const column = $(this).data('col');
            const value = $(this).val();

            $.ajax({
                url: "{{ route('generic.update') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    row: row,
                    column: column,
                    value: value
                },
                success: function(response) {
                    console.log('Saved:', response);
                }
            });
        });
    </script>

</x-app-layout>
