@php
  $table = [
    'id'   => 'fmFiles',
    'ajax' => ['url'=>route('api.filemanager.files'),'method'=>'POST','headers'=>['X-CSRF-Token'=>csrf_token()],'data'=>['id'=>request()->query('f')],'dataSrc'=>'data'],
    'rowLink' => '/file-manager/preview/{google_drive_id}',
    'order'   => [[5,'desc']], // by Uploaded date
    'filters' => [
      ['type'=>'date_range','from'=>'uploaded_from','to'=>'uploaded_to','label'=>'Uploaded','field'=>'created_at'],
      ['type'=>'select','name'=>'format','label'=>'Type','options'=>[''=>'All','pdf'=>'PDF','docx'=>'DOCX','xlsx'=>'XLSX','jpg'=>'JPG','png'=>'PNG']],
      ['type'=>'text','name'=>'name_q','label'=>'File Name','placeholder'=>'Search name','field'=>'name'],
    ],
    'columns' => [
      ['type'=>'checkbox','title'=>'<input type="checkbox" class="form-check-input mx-3" id="selectAll">','data'=>'id','width'=>'5px'],
      ['type'=>'text','title'=>'File Name','data'=>'name','align'=>'start'],
      ['type'=>'avatar_text','title'=>'Uploaded By','data'=>'uploaded_by','avatar'=>'/user.png','align'=>'start','subtitle'=>'uploaded_by_email'],
      ['type'=>'text_muted','title'=>'Type','data'=>'format','align'=>'start'],
      ['type'=>'text','title'=>'Size','data'=>'size','align'=>'start'],
      ['type'=>'date','title'=>'Uploaded','data'=>'created_at','format'=>'MMM D, YYYY','align'=>'start'],
      ['type'=>'dropdown_actions','title'=>'Action','data'=>'id','align'=>'center','menu'=>[
        ['overlay'=>'#move-files-folder','icon'=>'bi bi-arrows-move','label'=>'Move'],
        ['href'=>'/download-file/{google_drive_id}','icon'=>'bi bi-cloud-download','label'=>'Download'],
        ['onclick'=>"rename_ff({id}, 'File', '{name}')",'icon'=>'bi bi-pen','label'=>'Rename'],
        ['onclick'=>"share_item({id})",'icon'=>'bi bi-send-plus','label'=>'Share'],
        ['onclick'=>"remove_data({id}, 'file-manager')",'icon'=>'bi bi-trash','label'=>'Delete','danger'=>true],
      ]],
    ],
  ];
@endphp

@include('modules.developer.helper.auto-table', ['table' => $table])
