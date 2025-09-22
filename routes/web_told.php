<?php

use App\Http\Controllers\Admin\ChatQuestionController;


use App\Http\Controllers\Administrator;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\FacebookLeadController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProjectController;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CreditController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BidController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentsClientController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectBiddingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VirtualAssistantController;
use App\Http\Controllers\FileManagerController;

use App\Http\Controllers\ContentManagement_ClientController;
use App\Http\Controllers\ContentManagement_GalleryController;
use App\Http\Controllers\ContentManagement_PartnersController;
use App\Http\Controllers\ContentManagement_TeamsController;

use App\Models\Document;
use Illuminate\Http\Request;

use App\Models\HeroContent;
use App\Models\AboutUsContent;
use App\Models\FiguresContent;
use App\Models\ServiceContent;
use App\Models\TeamMemberContent;
use App\Models\CMS_Gallery;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RequestCreditController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WelcomeMessageController;
use App\Models\Clients;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    session()->put('show_welcome_modal', true);

    $hero = HeroContent::orderBy('id', 'DESC')->first();
    $about = AboutUsContent::orderBy('id', 'DESC')->first();
    $figure = FiguresContent::orderBy('id', 'DESC')->first();
    $service = ServiceContent::orderBy('id', 'DESC')->first();
    $team = TeamMemberContent::orderBy('id', 'DESC')->get();
    $gallery = CMS_Gallery::orderBy('id', 'DESC')->get();

    return view('home.index', compact('hero', 'about', 'figure', 'service', 'team', 'gallery'));
});

Route::prefix('content')->group(function () {
    // Content Routes

    Route::get('/figures', [ContentController::class, 'figures'])->name('content.figures');
    Route::post('/figures/store', [ContentController::class, 'figures_store'])->name('content.figures.store');

    Route::get('/clients', [ContentController::class, 'clients'])->name('content.clients');
    Route::post('/clients/store', [ContentController::class, 'clients_store'])->name('content.clients.store');

    Route::get('/services', [ContentController::class, 'services'])->name('content.services');
    Route::post('/services/store', [ContentController::class, 'services_store'])->name('content.services.store');

    Route::get('/team-members', [ContentController::class, 'team_members'])->name('content.team_members');
    Route::post('/team-members/store', [ContentController::class, 'team_members_store'])->name('content.team_members.store');
    Route::post('/team-members/update', [ContentController::class, 'team_members_update'])->name('content.team_members.update');
    Route::post('/team-members/delete', [ContentController::class, 'team_members_delete'])->name('content.team_members.delete');

    Route::post('/gallery/update', [ContentController::class, 'gallery_update'])->name('content.gallery.update');
    Route::post('/gallery/delete', [ContentController::class, 'gallery_delete'])->name('content.gallery.delete');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    //
    // *** [@Dashboards] Application Section ***
    Route::middleware('auth')
        ->get('/dashboard', function () {
            $roleRoutes = [
                'Administrator' => '/dashboard/auth',
                'Client' => '/dashboard/member',
                'Sub-Client' => '/dashboard/subscriber',
                'Virtual Assistant' => '/dashboard/member',
                'default' => '/member/dashboard',
            ];

            $role = Auth::user()->role;
            $redirectRoute = $roleRoutes[$role] ?? $roleRoutes['default'];

            return redirect($redirectRoute);
        })
        ->name('dashboard');

    Route::prefix('/dashboard')
        ->middleware('auth')
        ->group(function () {
            Route::get('/auth', function () {
                return view('pages.admin.dashboard');
            });
            Route::get('/teams', [ClientsController::class, 'index']);
            Route::get('/member', function () {
                return view('pages.members.dashboard');
            });
            Route::get('/subscriber', function () {
                return view('pages.members.subscriber');
            });
        });

    // *** Administrator Section ***
    Route::prefix('/hbcs')
        ->group(function () {
            Route::get('/clients', [Administrator::class, 'clients']);
            Route::get('/clients/details/{id}', [Administrator::class, 'client_details']);

            Route::post('/client/data', [Administrator::class, 'client_data'])->name('hbcs.clients.data');
            Route::post('/client/store', [LeadController::class, 'store'])->name('leads.store');
            Route::post('/client/update/{id}', [LeadController::class, 'update'])->name('leads.update');
        })
        ->middleware('auth');

    Route::post('/delete', [Administrator::class, 'trashBin'])
        ->name('trash.bin')
        ->middleware('auth');

    // *** [@Builder] Application Section ***
    Route::prefix('/builder')
        ->group(function () {
            Route::get('/banner', [BuilderController::class, 'banner']);
            Route::get('/about', [BuilderController::class, 'about']);
        })
        ->middleware('auth');

    // *** [@Clients] Application Section ***
    Route::prefix('/client')
        ->group(function () {
            Route::get('/list', [ClientsController::class, 'index']);
            Route::get('/list/register', [ClientsController::class, 'register']);
            Route::get('/list/details/{id}', [ClientsController::class, 'client_details']);

            Route::post('/api/client/data', [ClientsController::class, 'getClients'])->name('api.client.contacts');
            Route::post('/api/project/data', [ClientsController::class, 'getProjects'])->name('api.client.projects');

            Route::post('/store', [ClientsController::class, 'store'])->name('client.store');
            Route::post('/update/{id}', [ClientsController::class, 'update'])->name('client.update');
            Route::post('/list/data', [ClientsController::class, 'client_data'])->name('clients.data');
        })
        ->middleware('auth');

    // *** [@Sales] Application Section ***
    Route::prefix('/sales')
        ->group(function () {
            Route::get('/relationship/list', [SalesController::class, 'index']);
            Route::get('/list/register', [ClientsController::class, 'register']);
            Route::get('/relationship/list/details/{id}', [SalesController::class, 'client_details']);

            Route::post('/api/client/data', [ClientsController::class, 'getClients'])->name('api.client.contacts');
            Route::post('/api/project/data', [ClientsController::class, 'getProjects'])->name('api.client.projects');

            Route::post('/store', [ClientsController::class, 'store'])->name('client.store');
            Route::post('/update/{id}', [SalesController::class, 'update'])->name('sales.update');
            Route::post('/list/data', [SalesController::class, 'client_data'])->name('sales.data');
        })
        ->middleware('auth');

    // *** [@Relationship] Application Section ***
    Route::prefix('/relationship')
        ->group(function () {
            Route::get('/list', [ContactController::class, 'index']);
            Route::get('/list/contacts/{id}', [ContactController::class, 'create_contacts']);
            Route::get('/list/register', [ContactController::class, 'create_company']);
            Route::get('/list/edit/{id}', [ContactController::class, 'edit_contact_details']);
            Route::get('/list/details/{id}', [ContactController::class, 'company_details']);

            Route::post('/store', [ContactController::class, 'store'])->name('contact.create');
            Route::post('/update/{id}', [ContactController::class, 'update'])->name('contact.update');

            Route::post('/api/contacts', [ContactController::class, 'getClients'])->name('api.relationship.contacts');
            Route::post('/api/projects', [ContactController::class, 'getProjects'])->name('api.relationship.projects');

            Route::post('/api/company/contacts', [ContactController::class, 'getContacts'])->name('project.relationship.contacts');

            Route::post('/data/contact/store', [ContactController::class, 'store_contact'])->name('relationship.contact.store');
            Route::post('/data/contact/update', [ContactController::class, 'update_contact'])->name('relationship.contact.update');

            Route::get('/clients', [ContactController::class, 'clients']);
            Route::get('/client/data', [ContactController::class, 'getClients'])->name('relationship.contacts');

            Route::get('/company/data', [ContactController::class, 'getCompany'])->name('relationship.company');
            Route::get('/company/data/subscriber', [ContactController::class, 'getCompanySubscriber'])->name('relationship.company.subscriber');

            Route::get('/list', [ContactController::class, 'index']);
            Route::get('/person/list/{id}', [ContactController::class, 'person_index']);
            Route::get('/person/create', [ContactController::class, 'person_create']);
            Route::get('/{company_id}/person/new', function ($company_id) {
                //return view('pages.contacts.forms.new_client', compact('company_id'));
            });

            Route::post('/xyz', [ContactController::class, 'endpoint'])->name('contacts');
            Route::post('/clients/delete', [ContactController::class, 'deleteClients'])->name('clients.delete');
            Route::post('/person/store', [ContactController::class, 'person_store'])->name('contact-persons.store');
        })
        ->middleware('auth');

    // *** [@CRM] Application Section ***
    Route::prefix('/crm')
        ->group(function () {
            Route::get('/lead/facebook/create', [FacebookLeadController::class, 'create'])->name('lead.facebook');
            Route::get('/lead/facebook', [FacebookLeadController::class, 'index'])->name('lead.facebook.list');

            Route::get('/lead/generic', [FacebookLeadController::class, 'generic'])->name('lead.generic.list');
            Route::post('/lead/generic/update', [FacebookLeadController::class, 'updateCell'])->name('generic.update');

            Route::post('/lead/facebook/data', [FacebookLeadController::class, 'list'])->name('lead.facebook.data');
            Route::post('/lead/facebook/store', [FacebookLeadController::class, 'store'])->name('lead.facebook.store');
        })
        ->middleware('auth');

    // *** [@Notes] Application Section ***
    Route::middleware(['auth'])->group(function () {
        Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
        Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
        Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
        Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
        Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    });

    // *** [@Purchase Credit] Application Section ***
    Route::post('/request-credit', [RequestCreditController::class, 'store'])->name('request.credit.store');
    Route::get('/my-credit-requests', [RequestCreditController::class, 'index'])->name('request.credit.index');
    Route::post('/request-credit/{id}/status', [RequestCreditController::class, 'updateStatus'])->name('request.credit.updateStatus');

    // *** [@Projects] Application Section ***
    Route::prefix('/project')
        ->group(function () {
            Route::get('/list', [ProjectBiddingController::class, 'index']);
            Route::get('/register', [ProjectBiddingController::class, 'register']);
            Route::get('/edit/{id}', [ProjectBiddingController::class, 'edit']);
            Route::post('/update/{id}', [GoogleDriveController::class, 'update_project'])->name('project-bidding.update');
        })
        ->middleware('auth');

    // *** [@CMS] Application Section ***
    Route::prefix('/cms')
        ->group(function () {
            Route::get('/banner', [ContentController::class, 'hero'])->name('cms.hero');
            Route::post('/banner/store', [ContentController::class, 'hero_store'])->name('cms.hero.store');

            Route::get('/about-us', [ContentController::class, 'about_us'])->name('cms.about_us');
            Route::post('/about-us/update/{id}', [ContentController::class, 'about_us_update'])->name('cms.about_us.update');

            Route::get('/clients', [ContentManagement_ClientController::class, 'cms_client_index']);
            Route::post('/clients/store', [ContentManagement_ClientController::class, 'cms_client_store'])->name('cms.client.store');
            Route::post('/clients/update/info/{id}', [ContentManagement_ClientController::class, 'cms_client_info_store'])->name('cms.client.info.update');
            Route::post('/clients/update/logo', [ContentManagement_ClientController::class, 'cms_client_update_logo'])->name('cms.client.logo.update');
            Route::post('/clients/update/position', [ContentManagement_ClientController::class, 'cms_client_update_position'])->name('cms.client.position.update');
            Route::post('/clients/delete', [ContentManagement_ClientController::class, 'cms_client_remove'])->name('cms.client.delete');
            Route::get('/clients/data', [ContentsClientController::class, 'getClients'])->name('cms.clients.data');

            Route::get('/partners', [ContentManagement_PartnersController::class, 'cms_partners_index']);
            Route::post('/partners/store', [ContentManagement_PartnersController::class, 'cms_partners_store'])->name('cms.partners.store');
            Route::post('/partners/update/info/{id}', [ContentManagement_PartnersController::class, 'cms_partners_info_store'])->name('cms.partners.info.update');
            Route::post('/partners/update/logo', [ContentManagement_PartnersController::class, 'cms_partners_update_logo'])->name('cms.partners.logo.update');
            Route::post('/partners/update/position', [ContentManagement_PartnersController::class, 'cms_partners_update_position'])->name('cms.partners.position.update');
            Route::post('/partners/delete', [ContentManagement_PartnersController::class, 'cms_partners_remove'])->name('cms.partners.delete');

            Route::get('/teams', [ContentManagement_TeamsController::class, 'cms_teams_index']);
            Route::post('/teams/store', [ContentManagement_TeamsController::class, 'cms_teams_store'])->name('cms.teams.store');
            Route::post('/teams/update/info/{id}', [ContentManagement_TeamsController::class, 'cms_teams_info_store'])->name('cms.teams.info.update');
            Route::post('/teams/update/logo', [ContentManagement_TeamsController::class, 'cms_teams_update_logo'])->name('cms.teams.logo.update');
            Route::post('/teams/update/position', [ContentManagement_TeamsController::class, 'cms_teams_update_position'])->name('cms.teams.position.update');
            Route::post('/teams/delete', [ContentManagement_TeamsController::class, 'cms_teams_remove'])->name('cms.teams.delete');

            Route::get('/gallery', [ContentManagement_GalleryController::class, 'cms_gallery_index']);
            Route::post('/gallery/store', [ContentManagement_GalleryController::class, 'cms_gallery_store'])->name('cms.gallery.store');
            Route::post('/gallery/update/info/{id}', [ContentManagement_GalleryController::class, 'cms_teams_info_store'])->name('cms.gallery.info.update');
            Route::post('/gallery/update/logo', [ContentManagement_GalleryController::class, 'cms_gallery_update_logo'])->name('cms.gallery.logo.update');
            Route::post('/gallery/update/position', [ContentManagement_GalleryController::class, 'cms_gallery_update_position'])->name('cms.gallery.position.update');
            Route::post('/gallery/delete', [ContentManagement_GalleryController::class, 'cms_gallery_remove'])->name('cms.gallery.delete');

            Route::get('/inquiry-logs', [MessageController::class, 'index'])->name('content.contact');
            Route::post('/inquiry-logs/data', [MessageController::class, 'list'])->name('cms.inquiry.list');

            // Route::post('/clients/update', [ContentsClientController::class, 'update'])->name('cms.clients.update');
            // Route::post('/update-gallery-position', [ContentController::class, 'updatePosition'])->name('gallery.updatePosition');
            // Route::post('/gallery/delete', [ContentController::class, 'deleteGallery'])->name('gallery.delete');
            // Route::post('/content/gallery/store', [ContentController::class, 'gallery_store'])->name('content.gallery.store');
            // Route::post('/clients/storeX', [ContentsClientController::class, 'store'])->name('cms.clients.storeX');
        })
        ->middleware('auth');

    // *** [@Greetings] Application Section ***
    Route::prefix('/content')
        ->group(function () {
            Route::get('/client/greetings', [WelcomeMessageController::class, 'client_index'])->name('content.client.greetings');
            Route::get('/client/greetings/new', [WelcomeMessageController::class, 'client_register'])->name('content.client.greetings.new');
            Route::get('/client/greetings/{id}/edit', [WelcomeMessageController::class, 'client_edit'])->name('content.client.greetings.edit');
            Route::post('/client/greetings/create', [WelcomeMessageController::class, 'client_store'])->name('content.client.greetings.store');
            Route::post('/client/greetings/{id}/update', [WelcomeMessageController::class, 'client_update'])->name('content.client.greetings.update');
            Route::post('/api/client/greetings', [WelcomeMessageController::class, 'client_list'])->name('api.content.client.greetings');

            Route::get('/crm/greetings', [WelcomeMessageController::class, 'crm_index'])->name('content.crm.greetings');
            Route::get('/crm/greetings/new', [WelcomeMessageController::class, 'crm_register'])->name('content.crm.greetings.new');
            Route::get('/crm/greetings/{id}/edit', [WelcomeMessageController::class, 'crm_edit'])->name('content.crm.greetings.edit');
            Route::post('/crm/greetings/create', [WelcomeMessageController::class, 'crm_store'])->name('content.crm.greetings.store');
            Route::post('/crm/greetings/{id}/update', [WelcomeMessageController::class, 'crm_update'])->name('content.crm.greetings.update');
            Route::post('/api/crm/greetings', [WelcomeMessageController::class, 'crm_list'])->name('api.content.crm.greetings');

        })
        ->middleware('auth');

    // *** [@File Manager] Application Section ***
    Route::prefix('/file-manager')
        ->group(function () {
            Route::get('/preview/{id}', [FileManagerController::class, 'preview'])->name('filemanager.index');

            Route::get('/storage', [FileManagerController::class, 'index'])->name('filemanager.index');
            Route::get('/{parent_id?}', [FileManagerController::class, 'xindex'])->name('filemanager.index');
            Route::get('/folder/privacy', [FileManagerController::class, 'updatePrivacy'])->name('folder.privacy');
            Route::get('/folder/file/{url}', [FileManagerController::class, 'preview'])->name('folder.preview.file');

            Route::post('/upload', [FileManagerController::class, 'store'])->name('filemanager.store');
            Route::post('/create/folder', [FileManagerController::class, 'folder'])->name('filemanager.folder');
            Route::post('/submit', [FileManagerController::class, 'submitted'])->name('filemanager.submitted');
            Route::post('/rename/{id}', [FileManagerController::class, 'rename'])->name('filemanager.submitted');

            Route::post('/api/files', [FileManagerController::class, 'api_files'])->name('api.filemanager.files');

            Route::delete('/{file}', [FileManagerController::class, 'destroy'])->name('filemanager.destroy');
        })
        ->middleware('auth');

    // *** [@Virtual Assistant] Application Section ***
    Route::prefix('/virtual-assistant')
        ->group(function () {
            Route::get('/list', [VirtualAssistantController::class, 'index']);

            Route::post('/store', [VirtualAssistantController::class, 'store'])->name('va.store');
            Route::post('/data', [VirtualAssistantController::class, 'list'])->name('va.list');
        })
        ->middleware('auth');

    // *** [@Chat] Application Section ***
    Route::prefix('/chat')
        ->group(function () {
            Route::get('/questionnaire', [ChatQuestionController::class, 'index']);
            Route::post('/questionnaire/save', [ChatQuestionController::class, 'store'])->name('chat-questions.store');

            Route::get('/{id}', [ChatController::class, 'chats.old']);

            Route::post('/discussions', [ChatController::class, 'store'])->name('chats.old.store');
            Route::post('/messages', [ChatController::class, 'getMessages'])->name('chats.old.list');
        })
        ->middleware('auth');

    Route::post('/chat/send', [ChatMessageController::class, 'sendMessage']);
    Route::get('/chat/faq/{identifier}', [ChatMessageController::class, 'getPredefined']);

    // *** [@Task] Application Section ***
    Route::prefix('/task')
        ->group(function () {
            Route::get('/list', [TaskController::class, 'index']);
            Route::get('/list/create', [TaskController::class, 'create']);
            Route::get('/list/details/{id}', [TaskController::class, 'details']);

            Route::post('/api/list/data', [TaskController::class, 'list'])->name('api.task.list');

            Route::post('/store', [TaskController::class, 'store'])->name('task.create');
        })
        ->middleware('auth');

    // *** [Email] Application Section ***
    Route::get('/email/send', [EmailController::class, 'send'])->name('email.send');
    Route::get('/email/template', [EmailController::class, 'template'])->name('email.template');
    Route::get('/email/template/setup', [EmailController::class, 'setup'])->name('email.setup');
    //Route::get('/email/send', [EmailController::class, 'create'])->name('email.create');

    Route::prefix('/project')->group(function () {
        Route::get('/listx', [ContactController::class, 'index']);
        Route::get('/new', [ProjectBiddingController::class, 'registration']);
        Route::post('/store', [ProjectBiddingController::class, 'store'])->name('project.store');

        Route::get('/fetch-clients', function (Request $request) {
            $search = $request->input('search');

            $bidders = Clients::join('t_contacts', 't_contacts.id', 'clients.company_id')
                ->where('t_contacts.client_id', 17)
                ->where(function ($query) use ($search) {
                    $query
                        ->where('clients.first_name', 'like', "%{$search}%")
                        ->orWhere('clients.last_name', 'like', "%{$search}%")
                        ->orWhere('t_contacts.company_name', 'like', "%{$search}%");
                })
                ->limit(10) // Fetch only 10 results to keep it fast
                ->get(['clients.id', 'clients.first_name', 'clients.last_name', 't_contacts.company_name']);

            return response()->json($bidders);
        })->name('fetch.clients');
    });

    //
    Route::post('/bids/{project_id}', [BidController::class, 'store'])->name('bids.store');
    Route::post('/bids-cancel/{project_id}', [BidController::class, 'cancel'])->name('bids.cancel');
    Route::get('/bids/{project_id}', [BidController::class, 'index'])->name('bids.index');

    Route::prefix('/bid')
        ->group(function () {
            Route::get('/invitation', [CustomerController::class, 'invitation']);
            Route::get('/projects', [CustomerController::class, 'projects']);
            Route::get('/view/{project_id}', [CustomerController::class, 'details'])->name('bids.index');
            Route::get('/details/{project_id}', [BidController::class, 'details'])->name('bids.index');

            Route::post('/invitation/update', [CustomerController::class, 'invitation_update']);
            Route::post('/invitation/project/update', [CustomerController::class, 'invitation_project_update'])->name('invitation.project.update');

            Route::get('/details/{project_id}', [BidController::class, 'details'])->name('bids.index');

            Route::post('/api/project/data', [BidController::class, 'getProjects'])->name('api.bid.projects');
            Route::post('/api/project/invitation/data', [CustomerController::class, 'getInvitation'])->name('api.bid.projects.invitation');
            Route::post('/api/project/current/data', [CustomerController::class, 'getCurrentBid'])->name('api.bid.projects.current');

            Route::get('/current', function () {
                return view('pages.projects.current_bid');
            });

            Route::get('/new', function () {
                return view('pages.projects.create');
            });

            Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');

            // Plan Panther
            Route::get('/create', function () {
                return view('pages.projects.plan-panther.create');
            });
            //Route::post('/plan-panther/store', [ProjectBiddingController::class, 'store'])->name('project-bidding.store');
            Route::post('/plan-panther/store', [GoogleDriveController::class, 'upload_project'])->name('project-bidding.store');
        })
        ->middleware('auth');

    Route::middleware(['auth'])->group(function () {
        Route::get('/file-manager/{parent_id?}', [FileManagerController::class, 'index'])->name('filemanager.index');
        Route::post('/file-manager/upload', [FileManagerController::class, 'store'])->name('filemanager.store');
        Route::post('/file-manager/create/folder', [FileManagerController::class, 'folder'])->name('filemanager.folder');
        Route::post('/file-manager/submit', [FileManagerController::class, 'submitted'])->name('filemanager.submitted');
        Route::delete('/file-manager/{file}', [FileManagerController::class, 'destroy'])->name('filemanager.destroy');

        Route::get('/folder/privacy', [FileManagerController::class, 'updatePrivacy'])->name('folder.privacy');
        Route::get('/folder/file/{url}', [FileManagerController::class, 'preview'])->name('folder.preview.file');
    });

    Route::post('/upload-document', [DocumentController::class, 'store'])->name('documents.store');

    Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussions.index');
    Route::post('/discussions', [DiscussionController::class, 'store'])
        ->name('discussions.store')
        ->middleware('auth');

    Route::get('/leads', [Clients::class, 'index']);
    // Route::get('/client/details/{id}', function ($id) {
    //     return view('pages.clients.view', compact('id'));
    // })->name('dashboard');

    Route::get('/client', function () {
        return view('pages.client_sub.index');
    });

    Route::prefix('/client')->group(function () {
        // Route::get('/list', function () {
        //     return view('pages.clients.modules.client_list');
        // });
        Route::get('/{company_id}/new', function ($company_id) {
            return view('pages.clients.modules.client_new', compact('company_id'));
        });

        Route::get('/view/{id}', [ClientsController::class, 'details']);
        Route::post('/{client}/credits/store', [CreditController::class, 'store'])->name('credits.store');
    });

    Route::get('/FAQ', function () {
        return view('pages.tools.faq');
    });
    Route::get('/to-do-list', function () {
        return view('pages.apps.tasks.todo');
    });

    Route::get('/task-board', function () {
        return view('pages.apps.taskBoard');
    });




    Route::get('/member/dashboard', function () {
        return view('pages.clients.dashboard_member');
    });

    Route::get('/feedback-hub', function () {
        return view('pages.tools.feedback');
    });

    Route::get('/temp/logout', function (Request $request) {
        Auth::logout(); // Log out the user

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login')->with('success', 'You have been logged out.');
    });
    // Route::get('/client/edit', [ProjectController::class, 'create']);
    // Route::post('/client/update', [ProjectController::class, 'update'])->name('projects.store');

    Route::post('upload-file', [GoogleDriveController::class, 'upload'])->name('drive.file.upload');
    Route::post('/drive/folder/create', [GoogleDriveController::class, 'folder'])->name('drive.folder.create');
    Route::post('/google-drive-actived', [GoogleDriveController::class, 'activated'])->name('drive.folder.activated');
    Route::get('/drive/storage', [GoogleDriveController::class, 'getStorageInfo']);

    Route::get('/preview-office/{id}', [GoogleDriveController::class, 'officeFilePreview']);
    Route::get('/preview-file/{id}', [GoogleDriveController::class, 'preview']);
   Route::get('/download-file/{id}', [GoogleDriveController::class, 'download']);

    Route::get('/google-drive', function (Request $request) {
        return view('pages.filemanager.upload');
    });
});
