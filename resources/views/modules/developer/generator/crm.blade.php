@php
  $table = [
    'id'   => 'crmUsers',
    'ajax' => ['url'=>url('/users/fetch'), 'method'=>'GET', 'dataSrc'=>'data'],
    'rowLink' => '/users/manage/details/{id}',
    'order'   => [[1,'asc']],
    'filters' => [
      ['type'=>'date_range','from'=>'created_from','to'=>'created_to','label'=>'Created','field'=>'created_at'],
      ['type'=>'select','name'=>'role','label'=>'Role','options'=>[
        ''=>'All','Administrator'=>'Administrator','Business Client'=>'Business Client',
        'Associated Client'=>'Associated Client','Virtual Assistant'=>'Virtual Assistant','Developer'=>'Development Team'
      ], 'field'=>'role_label'],
      ['type'=>'select','name'=>'isActived','label'=>'Status','options'=>[''=>'All','1'=>'Activated','0'=>'Deactivated']],
      ['type'=>'select','name'=>'is_verified','label'=>'Verified','options'=>[''=>'All','1'=>'Verified','0'=>'Unverified']],
      ['type'=>'text','name'=>'company_q','label'=>'Company','placeholder'=>'e.g. Acme','field'=>'company'],
    ],
    'columns' => [
      ['type'=>'checkbox','title'=>'<input type="checkbox" class="form-check-input mx-3" id="selectAll">','data'=>'id','width'=>'5px'],
      ['type'=>'avatar_text','title'=>'Name','data'=>'name','align'=>'start','avatar_field'=>'profile_photo_path','avatar_prefix'=>'/storage/','avatar_fallback'=>'/user.png','subtitle'=>'email'],
      ['type'=>'email','title'=>'Email Address','data'=>'email','align'=>'start'],
      ['type'=>'text','title'=>'Status','data'=>'isActived','align'=>'start','map'=>[
        '0'=>"<span class='text-bold'><i class=\"ri-close-circle-fill text-danger mx-2 text-[0.5625rem]\"></i>Deactivated</span>",
        '1'=>"<span class='text-bold'><i class=\"ri-circle-fill text-success mx-2 text-[0.5625rem]\"></i>Activated</span>",
      ]],
      ['type'=>'badge_map','title'=>'Account Role','data'=>'role','align'=>'start','map'=>[
        'Administrator'=>['label'=>'Administrator','icon'=>'bi-magic','class'=>'text-dark'],
        'BusinessClient'=>['label'=>'Business Client','icon'=>'bi-person-circle','class'=>'text-dark'],
        'Client'=>['label'=>'Business Client','icon'=>'bi-person-circle','class'=>'text-dark'],
        'AssociatedClient'=>['label'=>'Associated Client','icon'=>'bi-person-square','class'=>'text-dark'],
        'Sub-Client'=>['label'=>'Associated Client','icon'=>'bi-person-square','class'=>'text-dark'],
        'Developer'=>['label'=>'Development Team','icon'=>'bi-code-slash','class'=>'text-dark'],
      ]],
      ['type'=>'boolean_badge','title'=>'Verified','data'=>'is_verified','align'=>'start'],
      ['type'=>'dropdown_actions','title'=>'Actions','data'=>'id','align'=>'center','menu'=>[
        ['href'=>'/users/manage/details/{encrypted_id}','icon'=>'bi bi-eye','label'=>'View'],
        ['onclick'=>"remove_data({id}, 'user')",'icon'=>'bi bi-trash','label'=>'Delete','danger'=>true],
      ]],
    ],
  ];
@endphp

@include('modules.developer.helper.auto-table', ['table' => $table])
