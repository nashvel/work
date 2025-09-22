@include('pages.actions.table-mod')

<div class="table-responsive-n">
    <table id="projectTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
        style="min-height:  0px;;">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start"><span class="mx-3">Code</span></th>
                <th class="text-start">Project</th>
                <th class="text-start">No. of GC's</th>
                <th class="text-start">Scope</th>
                <th class="text-start">Due Date</th>
                <th class="text-start" id="action_th">Action</th>
            </tr>
        </thead>
    </table>
</div>
<script>
  $(document).on('click', '#projectTable tbody tr', function(e) {
    const $row = $(this);
    const link = $row.data('href');
    if (!$(e.target).closest('button, input[type="checkbox"], a').length) {
      window.open(link, '_blank');
    }
  });

  $(document).ready(function () {
    const table = $('#projectTable').DataTable({
      processing: true,
      serverSide: false,
      ajax: {
        url: "{{ route('api.bid.projects.current') }}",
        type: "POST",
        data: { _token: "{{ csrf_token() }}" },
        beforeSend: ()=> $("#customLoader").removeClass("hidden"),
        complete:   ()=> $("#customLoader").addClass("hidden"),
        dataSrc: (json)=> json.data || [],
        error: (xhr)=> console.error("AJAX Error:", xhr.responseText)
      },
      language: { search: "_INPUT_", searchPlaceholder: "Search here..." },
      columns: [
        {
          data: 'code',
          render: (data)=> `<span class="mx-3 text-center text-dark">#${data}</span>`
        },
        {
          data: 'name',
          render: (data)=> `
            <span style="display:flex;align-items:center" class="!text-dark">
              <i class="bi bi-box2 me-2 align-middle text-[14px] text-dark dark:text-textmuted/50 inline-block"></i>
              ${data}
            </span>`
        },
        { data: 'count_gc', className: "text-start", render: (d)=> `x ${d}` },
        { data: 'scope', className: "text-start" },

        // DUE DATE: display as MM/DD/YYYY (zero-padded); sort by timestamp
        {
          data: 'due',
          className: "text-start",
          render: function (data, type) {
            if (!data) return (type === 'sort') ? -1 : '';
            const d = new Date(data);
            if (isNaN(d)) return (type === 'sort') ? -1 : data;

            // normalize to midnight for consistent compare
            d.setHours(0,0,0,0);

            if (type === 'display' || type === 'filter') {
              const mm  = String(d.getMonth() + 1).padStart(2,'0');
              const dd  = String(d.getDate()).padStart(2,'0');
              const yyyy= String(d.getFullYear());
              return `${mm}/${dd}/${yyyy}`;   // 09/04/2025
            }
            // sort value
            return d.getTime();
          }
        },

        {
          data: 'id',
          orderable: false,
          searchable: false,
          render: function (data, type, row) {
            return `<div class="hstack gap-1 text-[.9375rem]">
              <center>
                <span class="custom-tooltip">
                  <a href="/bid/projects/${row.id}" class="ti-btn ti-btn-sm ti-btn-soft-info bg-info/10">
                    <i class="bi bi-eye"></i>
                  </a>
                  <span class="tooltip-text">Preview</span>
                </span>
                <span class="custom-tooltip">
                  <a onclick="remove_data(${row.id}, 'crm-projects')" href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10">
                    <i class="bi bi-trash"></i>
                  </a>
                  <span class="tooltip-text">Delete</span>
                </span>
              </center>
            </div>`;
          }
        }
      ],

      // FUTURE (not-due) DATES FIRST = latest at top
      order: [[4, "desc"]],

      rowCallback: function (row, data) {
        $(row).attr('data-href', `/bid/projects/${data.id}`);
      },

      createdRow: function (row, data) {
        // Soft red if due today or past due
        const due = new Date(data.due);
        if (!isNaN(due)) {
          const today = new Date();
          due.setHours(0,0,0,0);
          today.setHours(0,0,0,0);
          if (due.getTime() <= today.getTime()) {
            $(row).addClass('is-due');
          }
        }
      },

      initComplete: function () {
        $("#customSearchWrapper").html($("#projectTable_filter"));
        $("#customLengthWrapper").html($("#projectTable_length"));
      }
    });
  });
</script>



<style>
  #action_th { width: 100px !important; }

  /* Soft red highlight for past-due / due-today */
  #projectTable tbody tr.is-due {
    background-color: #ffeaea !important;
  }
  /* Emphasize the Due Date cell when highlighted */
  #projectTable tbody tr.is-due td:nth-child(5) {
    font-weight: 600;
  }
</style>

