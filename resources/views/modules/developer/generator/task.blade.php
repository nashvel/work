@php
  $table = [
    'id'   => 'pmTasks',
    'ajax' => ['url'=>url('/projects/tasks/fetch'),'method'=>'GET','dataSrc'=>'data'],
    'rowLink' => '/projects/tasks/{id}',
    'order'   => [[6,'asc']], // due date asc
    'filters' => [
      ['type'=>'select','name'=>'status','label'=>'Status','options'=>[''=>'All','open'=>'Open','in_progress'=>'In progress','review'=>'Review','completed'=>'Completed','on_hold'=>'On hold']],
      ['type'=>'select','name'=>'priority','label'=>'Priority','options'=>[''=>'All','low'=>'Low','medium'=>'Medium','high'=>'High','critical'=>'Critical']],
      ['type'=>'date_range','from'=>'due_from','to'=>'due_to','label'=>'Due','field'=>'due_date'],
      ['type'=>'text','name'=>'assignee_q','label'=>'Assignee','placeholder'=>'name/email','field'=>'assignee_name'], // or assignee_email
    ],
    'columns' => [
      ['type'=>'checkbox','title'=>'<input type="checkbox" class="form-check-input mx-3" id="selectAll">','data'=>'id','width'=>'5px'],
      ['type'=>'text','title'=>'Task','data'=>'title','align'=>'start','truncate'=>80],
      ['type'=>'avatar_text','title'=>'Assignee','data'=>'assignee_name','align'=>'start','avatar_field'=>'assignee_avatar','avatar_fallback'=>'/user.png','subtitle'=>'assignee_email'],
      ['type'=>'status','title'=>'Status','data'=>'status','align'=>'start'],
      ['type'=>'stage','title'=>'Stage','data'=>'stage','align'=>'start'],
      ['type'=>'priority','title'=>'Priority','data'=>'priority','align'=>'start'],
      ['type'=>'date','title'=>'Due','data'=>'due_date','format'=>'MMM D, YYYY','align'=>'start'],
      ['type'=>'progress_from_stage','title'=>'Progress','data'=>'stage','align'=>'start'],
      ['type'=>'dropdown_actions','title'=>'Actions','data'=>'id','align'=>'center','menu'=>[
        ['href'=>'/projects/tasks/{id}','icon'=>'bi bi-eye','label'=>'Open'],
        ['onclick'=>"pm_mark_done({id})",'icon'=>'bi bi-check2-circle','label'=>'Mark Done'],
        ['onclick'=>"remove_data({id}, 'task')",'icon'=>'bi bi-trash','label'=>'Delete','danger'=>true],
      ]],
    ],
  ];
@endphp

@include('modules.developer.helper.auto-table', ['table' => $table])
