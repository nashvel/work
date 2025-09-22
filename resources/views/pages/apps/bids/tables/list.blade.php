 @include('pages.actions.table-mod')

 <div class="table-responsive-n">
     <table id="projectTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
         style="min-height:  0px;;">
         <thead>
             <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                 <th class="text-start"><span class="mx-3">Code</span></th>
                 <th class="text-start">Project</th>
                 <th class="text-start">Subject</th>
                 <th class="text-start">Due Date</th>
                 <th class="text-start">Stage</th>
                 <th class="text-start">Created At</th>
                 <th class="text-start" id="action_th">Action</th>
             </tr>
         </thead>
     </table>
 </div>
<script>
  // Parse "YYYY-MM-DD" (optionally with time) to LOCAL midnight to avoid TZ shifts
  function parseLocalDate(input) {
    if (!input) return null;
    const s = String(input).trim();
    const m = s.match(/^(\d{4})-(\d{2})-(\d{2})/);
    if (m) return new Date(Number(m[1]), Number(m[2]) - 1, Number(m[3]));
    const d = new Date(s);
    if (isNaN(d)) return null;
    return new Date(d.getFullYear(), d.getMonth(), d.getDate());
  }

  $(document).on('click', '#projectTable tbody tr', function(e) {
    const link = $(this).data('href');
    if (!$(e.target).closest('button, input[type="checkbox"], a').length) {
      window.location.href = link;
    }
  });

  $(document).ready(function () {
    var table = $('#projectTable').DataTable({
      processing: true,
      serverSide: false,
      ajax: {
        url: "{{ route('api.bid.projects') }}",
        type: "POST",
        data: { _token: "{{ csrf_token() }}" },
        beforeSend: function(){ $("#customLoader").show(); },
        complete:   function(){ $("#customLoader").hide(); },
        dataSrc: function(json){ return json.data || []; },
        error: function(xhr){ console.error("AJAX Error:", xhr.responseText); }
      },
      language: { search: "_INPUT_", searchPlaceholder: "Search here..." },
      columns: [
        {
          data: 'code',
          render: function(data){ return `<span class="mx-3 text-center">#${data}</span>`; }
        },
        {
          data: 'name',
          render: function(data){ return `<span style="display:flex;align-items:center" class="!text-dark">${data}</span>`; }
        },
        { data: 'stage_subject', className: "text-start" },

        // Due Date: display MM/DD/YYYY; sort by timestamp; future first
        {
          data: 'due',
          className: "text-start",
          render: function(data, type){
            if (!data) return (type === 'sort') ? -1 : '';
            const d = parseLocalDate(data);
            if (!d) return (type === 'sort') ? -1 : data;

            if (type === 'display' || type === 'filter') {
              const mm = String(d.getMonth()+1).padStart(2,'0');
              const dd = String(d.getDate()).padStart(2,'0');
              const yyyy = d.getFullYear();
              return `${mm}/${dd}/${yyyy}`;
            }
            return d.getTime(); // numeric for sorting
          }
        },

        { data: 'stage', className: "text-start text-info" },

        // Created At: show MM/DD/YYYY; sort by timestamp
        {
          data: 'created_at',
          className: "text-start",
          render: function(data, type){
            if (!data) return (type === 'sort') ? -1 : '';
            const d = parseLocalDate(data);
            if (!d) return (type === 'sort') ? -1 : data;

            if (type === 'display' || type === 'filter') {
              const mm = String(d.getMonth()+1).padStart(2,'0');
              const dd = String(d.getDate()).padStart(2,'0');
              const yyyy = d.getFullYear();
              return `${mm}/${dd}/${yyyy}`;
            }
            return d.getTime();
          }
        },

        {
          data: 'id',
          orderable: false,
          searchable: false,
          render: function(data, type, row){
            return `<div class="hstack gap-1 text-[.9375rem]">
              <center>
                <span class="custom-tooltip">
                  <a href="/project/edit/${row.id}" class="ti-btn ti-btn-sm ti-btn-soft-warning bg-warning/20">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <span class="tooltip-text">Edit</span>
                </span>

                <span class="custom-tooltip">
                  <a href="/project/list/details/${row.id}" class="ti-btn ti-btn-sm ti-btn-soft-info bg-info/10">
                    <i class="bi bi-eye"></i>
                  </a>
                  <span class="tooltip-text">Preview</span>
                </span>

                <span class="custom-tooltip">
                  <a onclick="remove_data(${row.id}, 'project')" href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10">
                    <i class="bi bi-trash"></i>
                  </a>
                  <span class="tooltip-text">Delete</span>
                </span>
              </center>
            </div>`;
          }
        }
      ],

      // Sort by Due Date DESC so future (not-due) appear first
      order: [[0, "DESC"]],

      rowCallback: function(row, data){
        $(row).attr('data-href', `/project/list/details/${data.id}`);
      },

      createdRow: function(row, data){
        const due = parseLocalDate(data.due);
        if (due) {
          const now = new Date();
          const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
          if (due.getTime() <= today.getTime()) {
            $(row).addClass('is-due');
          }
        }
      },

      initComplete: function(){
        $("#customSearchWrapper").html($("#projectTable_filter"));
        $("#customLengthWrapper").html($("#projectTable_length"));
      }
    });
  });
</script>

<style>
  #action_th { width: 120px !important; }

  /* Soft red highlight for due today or past due */
  #projectTable tbody tr.is-due { background-color: #ffeaea !important; }
  #projectTable tbody tr.is-due td:nth-child(4) { font-weight: 600; } /* Due Date cell */
</style>

