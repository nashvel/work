@php
    $details = App\Models\ProjectBidding::where('id', $id)->first();
    $user = Auth::user();
    $clientId = null;

    if ($user->role === 'Virtual Assistant') {
        $clientId = $user->company;
    } elseif ($user->role === 'Sub-Client') {
        $clientId = App\Models\Clients::where('email', $user->email)->value('id');
    } else {
        $clientId = App\Models\Lead::where('email', $user->email)->value('id');
    }

    $contacts = App\Models\ContactPerson::join('t_contacts', 't_contacts.id', 't_contact_person.company_id')
        ->select(
            't_contact_person.first_name',
            't_contact_person.last_name',
            't_contact_person.company_id as id',
            't_contact_person.id as pid',
            't_contact_person.email as email',
            't_contacts.company_name as company',
        )
        ->where('t_contact_person.lead_id', $clientId)
        ->orderBy('t_contact_person.id', 'DESC')
        ->get();

    // Assuming proj_bidders is stored as JSON array of IDs like: [4344, 4700]
    $preselected = [];
    if (!empty($details->proj_bidders)) {
        $projBidderIds = is_array($details->proj_bidders)
            ? $details->proj_bidders
            : json_decode($details->proj_bidders, true);

        // echo response()->json($projBidderIds, 200, [], JSON_PRETTY_PRINT) . "<hr>";
        // echo response()->json($contacts, 200, [], JSON_PRETTY_PRINT);

        foreach ($contacts as $person) {
            if (in_array($person->email, $projBidderIds)) {
                $preselected[$person->pid] = [
                    'id' => $person->pid,
                    'text' => $person->first_name . ' ' . $person->last_name . ' (' . $person->company . ')',
                    'email' => $person->email,
                ];
            }
        }
    }

@endphp

<script>
    // Make sure selectedBidders is truly global
    var selectedBidders = selectedBidders || {};

    function updateSelectedBidders() {
        let $customSelect = $('#customSelectWrapper');
        let $selectElement = $('#bidders-list'); // Make sure this matches your <select> ID

        $customSelect.empty();
        $selectElement.empty();

        let biddersArray = Object.values(selectedBidders);
        if (biddersArray.length === 0) {
            $customSelect.text("Click to select bidders");
        } else {
            biddersArray.forEach((bidder) => {
                // Display in the custom wrapper
                $customSelect.append(
                    $('<span>', {
                        class: 'selected-item',
                        html: `${bidder.text} <small style="color: #6b7280;">(${bidder.email})</small>`
                    })
                );

                // Add to hidden select for form submission
                $selectElement.append(
                    $('<option>', {
                        value: bidder.id,
                        text: bidder.text,
                        selected: true
                    })
                );
            });
        }
    }

    $(document).ready(function () {
        const initialBidders = {!! json_encode($preselected) !!} || {};

        // Copy preselected bidders into our global object
        for (const id in initialBidders) {
            selectedBidders[id] = initialBidders[id];
        }

        // Render them into the UI
        updateSelectedBidders();

        console.log('initialBidders', initialBidders);

        let table = $('#clientTable').DataTable();

        table.on('draw', function () {
            $('#clientTable tbody .rowCheckbox').each(function () {
                let bidderId = $(this).val();
                if (selectedBidders[bidderId]) {
                    $(this).prop('checked', true);
                }
            });
        });
    });

</script>

<style>
    .custom-multi-select {
        border: 1px solid #eee;
        padding: 8px;
        border-radius: 5px;
        cursor: pointer;
        min-height: 40px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 5px;
        background: #fff;
    }

    .selected-item {
        background: #f5f5f5;
        color: #202020;
        padding: 5px 10px;
        border-radius: 3px;
        display: flex;
        align-items: center;
    }

    .remove-item {
        margin-left: 5px;
        cursor: pointer;
        font-weight: bold;
        display: none;
    }

    .assigned-team-members {
        display: none !important;
    }
</style>
