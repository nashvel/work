@include('pages.actions.table-mod')

<div class="table-responsive-n">
    <table id="projectTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
        style="min-height:  0px;;">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" id="action_th"><span class="mx-3">Code</span></th>
                <th class="text-start">Scope</th>
                <th class="text-start">Subject</th>
                <th class="text-start">Project</th>
                <th class="text-start">Due</th>
                <th class="text-start">Stages</th>
                <th class="text-start">GC's</th>
                <th class="text-start" id="action_th_s">Action</th>
            </tr>
        </thead>
    </table>
</div>
<script>
  // Parse "YYYY-MM-DD" (or similar) as a LOCAL midnight date to avoid TZ shifts
  function parseLocalDate(input) {
    if (!input) return null;
    const s = String(input).trim();
    const m = s.match(/^(\d{4})-(\d{2})-(\d{2})/);
    if (m) return new Date(Number(m[1]), Number(m[2]) - 1, Number(m[3]));
    const d = new Date(s);
    if (isNaN(d)) return null;
    return new Date(d.getFullYear(), d.getMonth(), d.getDate());
  }

  $(document).ready(function () {
    var table = $('#projectTable').DataTable({
      processing: true,
      serverSide: false,
      ajax: {
        url: "{{ route('api.bid.projects.invitation') }}",
        type: "POST",
        data: { _token: "{{ csrf_token() }}" },
        beforeSend: function(){ $("#customLoader").removeClass("hidden"); },
        complete:   function(){ $("#customLoader").addClass("hidden"); },
        dataSrc: function(json){ return json.data || []; },
        error: function(xhr){ console.error("AJAX Error:", xhr.responseText); }
      },
      language: { search: "_INPUT_", searchPlaceholder: "Search here..." },
      columns: [
        {
          data: 'code',
          render: function(data){ return `<span class="mx-3 text-center text-dark">#${data}</span>`; }
        },
        {
          data: 'category',
          className: "text-start",
          render: function(data){
            return `<span class="block mx-1 mb-1 p-0">
                      <i class="bi bi-briefcase me-2 align-middle text-[14px] text-dark dark:text-textmuted/50 inline-block"></i>
                      <a href="#" class="text-dark">${data}</a>
                    </span>`;
          }
        },
        {
          data: 'subject',
          className: "text-start",
          render: function(data){
            return `<span class="block mx-1 mb-1 p-0">
                      <i class="bi bi-app-indicator me-2 align-middle text-[14px] text-dark dark:text-textmuted/50 inline-block"></i>
                      <a href="#" class="text-dark">${data}</a>
                    </span>`;
          }
        },
        {
          data: 'name',
          render: function(data, type, row){
            return `<span style="display:flex;align-items:center" class="!text-dark">${data}</span>`;
          }
        },

        /* DUE: show MM/DD/YYYY (zero-padded); sort by timestamp */
        {
          data: 'due',
          className: "text-start",
          render: function(data, type){
            if (!data) return (type === 'sort') ? -1 : '';
            const d = parseLocalDate(data);
            if (!d)    return (type === 'sort') ? -1 : data;

            if (type === 'display' || type === 'filter') {
              const mm = String(d.getMonth()+1).padStart(2,'0');
              const dd = String(d.getDate()).padStart(2,'0');
              const yyyy = d.getFullYear();
              return `${mm}/${dd}/${yyyy}`; // 09/04/2025
            }
            return d.getTime(); // sort numeric
          }
        },

        {
          data: 'stage',
          render: function(data){
            const badgeColors = {
              'Upload': 'soft-secondary',
              'Measure': 'soft-info',
              "Spec'ed": 'soft-warning',
              'PHL': 'soft-danger',
              'Ready': 'soft-info'
            };
            const key = (data === "Spec'ed" || data === "Spec'ed") ? "Spec'ed" : data;
            const color = badgeColors[key] || 'primary';
            return `<span class="badge ti-btn-${color}" style="align-items:center;">${data}</span>`;
          }
        },
        {
          data: 'count_gc',
          className: "text-center",
          render: function(data){ return `x ${data}`; }
        },
        {
          data: 'id',
          orderable: false,
          searchable: false,
          render: function(data, type, row){
            const rowData = encodeURIComponent(JSON.stringify(row));
            return `
              <div class="btn-list p-0">
                <center>
                  <div class="ti-btn-list text-nowrap ms-auto">
                    <button data-hs-overlay="#info" onclick="preview('${rowData}')" aria-label="button" type="button"
                      class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-info">
                      <i class="bi bi-info-circle"></i>
                    </button>
                    <button onclick="invitation(${data}, 'Bidding', '${row.category}', '${row.subject}')" aria-label="button" type="button"
                      class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-success">
                      <i class="ri-check-line"></i>
                    </button>
                    <button onclick="invitation(${data}, 'Declined', '${row.category}', '${row.subject}')" aria-label="button" type="button"
                      class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-danger me-0">
                      <i class="ri-close-line"></i>
                    </button>
                  </div>
                </center>
              </div>`;
          }
        }
      ],

      // Sort by Due DESC so future (not-due) appear first / latest on top
      order: [[4, "desc"]],

      createdRow: function(row, data){
        const d = parseLocalDate(data.due);
        if (d) {
          const now = new Date();
          const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
          if (d.getTime() <= today.getTime()) {
            $(row).addClass('is-due'); // mark due or past due
          }
        }
      },

      initComplete: function(){
        $("#customSearchWrapper").html($("#projectTable_filter"));
        $("#customLengthWrapper").html($("#projectTable_length"));
      }
    });

    function boldNumbersInInfo() {
      let info = $('.dataTables_info').html();
      if (info) {
        info = info.replace(/(\d+)/g, '<strong>$1</strong>');
        $('.dataTables_info').html(info);
      }
    }
    $('#projectTable').on('draw.dt', boldNumbersInInfo);
  });
</script>

<style>
  #projectTable tbody tr { cursor: default; }
  #action_th_s { width: 5px !important; text-align: center !important; }

  /* Soft red for due today or past due */
  #projectTable tbody tr.is-due {
    background-color: #ffeaea !important;
  }
  #projectTable tbody tr.is-due td:nth-child(5) {
    font-weight: 600;
  }
</style>

