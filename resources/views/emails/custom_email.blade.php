<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Construction Bidding Proposal</title>
</head>

@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;
    use App\Models\ProjectBidding;
    use App\Models\FileSubmitted;
    use App\Models\Contact;
    use App\Models\ContactPerson;
    use App\Models\Clients;

    $user_id = Auth::id();
    $project = ProjectBidding::find($id);

    if (!$project) {
        echo $id . '-';
        echo 'Project not found.';
        exit();
    }

    $files = FileSubmitted::from('file_submitted as fs')
        ->join('t_file_manager as fm', 'fm.id', '=', 'fs.file_id')
        ->where('fs.project_id', $id)
        ->where('fs.user_id', $user_id)
        ->get(['fm.name as name', 'fm.path as path', 'fm.google_drive_id as google_drive_id']);

    $attachments = $files
        ->map(
            fn($f) => [
                'name' => $f->name,
                'path' => $f->path,
                'google_drive_id' => $f->google_drive_id ?? null,
            ],
        )
        ->all();

    // Get project due date and duration
    $dueDate = Carbon::parse($project->proj_due_date);
    $now = Carbon::now();
    $duration = $now->diffForHumans($dueDate, ['parts' => 2]);

    // Fetch bidder contact details
    $bidder_contact = Contact::find($bidders);
    $bidder_person = Clients::where('id', $bidder_id)->first();

    // Fetch client (user sending the proposal)
    $user = Clients::where('user_id', $user_id)->first();
@endphp

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Mogra&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">

<body
    style="margin: 0; padding: 40px 16px; background: linear-gradient(to bottom right, #dbeafe, #ffffff, #eff6ff); font-family: 'Rubik', sans-serif;">
    <div
        style="max-width: 90%; margin: 0 auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">

        <!-- Header -->
        <div
            style="background: #2980b9; color: white; padding: 18px; text-align: center; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;">
            {{ $project->proj_name }}
        </div>

        <!-- Body Content -->
        <div style="padding: 25px; font-size: 16px; color: #333;">
            <p>Dear <strong>{{ $bidder_person->first_name ?? 'Valued Client' }} {{ $bidder_person->last_name ?? '' }}
                    ({{ $bidder_contact->company_name ?? 'Company' }})</strong>,</p>

            <p>We are pleased to submit our proposal for the <strong>{{ $project->proj_name }}</strong> project. Below
                you'll find a summary of our bid, scope of work, and project timeline.</p>

            <!-- Proposal Summary -->
            <div style="background: #f0f4f7; padding: 20px; border-radius: 8px; margin-top: 20px;">
                <h3 style="color: #2c3e50;">📌 Proposal Summary</h3>
                @if (!empty($project->stage_descriptions))
                    <ul style="padding-left: 25px; line-height: 1.6;">
                        @foreach ($project->stage_descriptions as $stage => $description)
                            <li><strong>{{ $stage }}</strong></li>
                        @endforeach
                    </ul>
                @else
                    <p>No stage descriptions available.</p>
                @endif

                <h3 style="color: #2c3e50;">📌 Scope of Work</h3>
                <div style="padding-left: 20px;">
                    @foreach ($project->stage_descriptions ?? [] as $stage => $description)
                        <h4><strong>{{ $stage }}</strong></h4>
                        {!! $description !!}
                    @endforeach
                </div>
            </div>
        
            <!-- Attachments -->
            @if (!empty($attachments))
                <div style="margin-top: 25px;">
                    <h3 style="color: #2c3e50;">📎 Attached Documents</h3>
                    <ul style="padding-left: 20px; list-style: none; line-height: 1.8;">
                        @foreach ($attachments as $file)
                            <li>
                                🔗 <a
                                    href="https://drive.google.com/uc?id={{ $file['google_drive_id'] }}&export=download"
                                    target="_blank" style="color: #2980b9; font-weight: 500;">
                                    {{ basename($file['name']) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <!-- Call-to-action -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="mailto:{{ $user->email ?? 'your@email.com' }}" target="_blank"
                    style="display: inline-block; background-color: #27ae60; color: white; text-decoration: none; font-size: 16px; padding: 12px 24px; border-radius: 6px; font-weight: 500;">
                    📥 Contact Us for Full Proposal
                </a>
            </div>

            <p>We appreciate the opportunity to work with you. Please let us know if you have any questions or need
                further details.</p>

            <p>Best Regards,</p>
            <p><strong>{{ $user->first_name ?? 'Your Name' }} {{ $user->last_name ?? '' }}</strong><br>
                {{ $user->location ?? 'Your Location' }}<br>
                {{ $user->email ?? 'your@email.com' }}<br>
                {{ $user->phone ?? 'Your Contact Number' }}
            </p>
        </div>

        <!-- Footer -->
        <div
            style="text-align: center; background-color: #f1f1f1; font-size: 14px; color: #666; padding: 15px; border-radius: 0 0 10px 10px;">
            <p>© {{ date('Y') }} Integrity Outsourcing Services. All rights reserved.</p>
            <p><strong>This is an automated email — please do not reply.</strong></p>
            <p>Questions? <a href="mailto:{{ $user->email ?? 'support@hillbcs.com' }}" style="color: #2980b9;">Contact
                    us</a>.</p>
        </div>
    </div>
</body>


</html>
