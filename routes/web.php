<?php

use App\Http\Controllers\Users\CreditsController;
use App\Http\Controllers\Users\ManagementController;
use App\Http\Controllers\Users\ActivityLogsController;

use App\Http\Controllers\Chats\MessagesController;
use App\Http\Controllers\Chats\ConversationController;

use App\Http\Controllers\Privilege\ManagerController;
use App\Http\Controllers\Privilege\RouteController;

use App\Http\Controllers\Developer\DeveloperController;

use App\Http\Controllers\ProjectManagement\ProjectMngntController;
use App\Http\Controllers\Sheets\ProjectManagementSheet;

use App\Http\Controllers\Services\Calendar;

use App\Http\Controllers\ContactDirectoryController;
use App\Http\Controllers\ScheduleController;

use App\Http\Controllers\Administrator;
use App\Http\Controllers\BidController;

use App\Http\Controllers\BuilderController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentManagement_ClientController;
use App\Http\Controllers\ContentManagement_GalleryController;
use App\Http\Controllers\ContentManagement_PartnersController;
use App\Http\Controllers\ContentManagement_TeamsController;
use App\Http\Controllers\ContentsClientController;
use App\Http\Controllers\ChatQuestionController;
use App\Http\Controllers\CorsPendingController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FacebookLeadController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectBiddingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectProfitTrackerController;
use App\Http\Controllers\QuickBooksControllers;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\RequestCreditController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TaskController as DefaultTaskController;
use App\Http\Controllers\ProjectManagement\TaskController;
use App\Http\Controllers\VirtualAssistantController;
use App\Http\Controllers\WelcomeMessageController;

use App\Models\User;
use App\Models\AboutUsContent;
use App\Models\CMS_Gallery;
use App\Models\Clients;
use App\Models\FiguresContent;
use App\Models\HeroContent;
use App\Models\ServiceContent;
use App\Models\TeamMemberContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\GoogleLoginController;

use App\Http\Controllers\QuickBooks\InvoiceController;
use App\Http\Controllers\TicketController;

use Illuminate\Support\Facades\Http;

Route::middleware(['auth'])->group(function () {
    Route::get('/invoices/send', [InvoiceController::class, 'create'])->name('invoices.send');
    Route::post('/invoices/send-bulk', [InvoiceController::class, 'sendBulk'])->name('invoices.sendBulk');
    Route::get('/invoices/list', [InvoiceController::class, 'listInvoices'])->name('invoices.list');
});
Route::middleware(['web'])->group(function () {
    // Step 1: Redirect to QuickBooks OAuth authorization
    Route::get('/quickbooks/form', [QuickBooksControllers::class, 'payment'])->name('quickbooks.payment');
    Route::get('/quickbooks/connect', [QuickBooksControllers::class, 'quickbooks_connect'])->name('quickbooks.connect');

    // Step 2: OAuth callback URL (must match RedirectURI in QuickBooks app)
    Route::get('/quickbooks/callback', [QuickBooksControllers::class, 'quickbooks_callback'])->name('quickbooks.callback');

    // Step 3: List invoices (optional)
    Route::get('/quickbooks/invoices', [QuickBooksControllers::class, 'listInvoices'])->name('quickbooks.invoices');

    // Step 4: Create payment linked to an invoice
    Route::post('/quickbooks/payment', [QuickBooksControllers::class, 'createPayment'])->name('quickbooks.createPayment');

    Route::get('/quickbooks/customers', [QuickBooksControllers::class, 'listCustomers'])->name('quickbooks.customers');

    Route::post('/quickbooks/webhook', [QuickBooksControllers::class, 'handle']);

    Route::get('/quickbooks/invoices/sync', [QuickBooksControllers::class, 'manualSyncInvoices'])->name('quickbooks.syncInvoices');
    Route::get('/quickbooks/invoices/list', [QuickBooksControllers::class, 'viewInvoices'])->name('quickbooks.viewInvoices');
});


Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }

    return redirect('/');
})->name('login');


Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'callback']);

Route::get('/terms-of-service', fn() => view('legal.terms'))->name('terms.show');
Route::get('/privacy-policy', fn() => view('legal.policy'))->name('policy.show');

// In Blade:

Route::get('/landing-page-v1', function () {
    //session()->put('show_welcome_modal', true);

    $hero = HeroContent::orderBy('id', 'DESC')->first();
    $about = AboutUsContent::orderBy('id', 'DESC')->first();
    $figure = FiguresContent::orderBy('id', 'DESC')->first();
    $service = ServiceContent::orderBy('id', 'DESC')->first();
    $team = TeamMemberContent::orderBy('id', 'DESC')->get();
    $gallery = CMS_Gallery::orderBy('id', 'DESC')->get();

    return view('home1.index', compact('hero', 'about', 'figure', 'service', 'team', 'gallery'));
});

Route::get('/', function () {
    session()->put('show_welcome_modal', true);
    if (Auth::check()) {
        // User is already logged in, redirect to dashboard
        return redirect()->route('dashboard');
    }

    // Not logged in, show login page
    return view('auth.login');
});

Route::get('/blog/{id}/{slug}', function ($id, $slug) {
    return view('home.blog.index', compact('id', 'slug'));
});

Route::post('/chat/send', [ChatMessageController::class, 'sendMessage']);

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




Route::middleware('auth')->group(function () {
    Route::get('/chat/{id}', [ChatController::class, 'fetchMessages']);
    Route::post('/chat/{id}/send', [ChatController::class, 'sendMessage']);
});

Route::get('/chat-test', function () {
    return view('modules.chats.v2.test');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::get('/tickets/list', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::put('/tickets/{ticket}/update-status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');


    Route::middleware('auth')->group(function () {
        Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
        Route::get('/emails/fetch', [EmailController::class, 'fetchFromGmail'])->name('emails.fetch');
        Route::get('/emails/compose', [EmailController::class, 'compose'])->name('emails.compose');
        Route::post('/emails/send', [EmailController::class, 'send'])->name('emails.send');
    });

    // Show the verification notice
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware(['auth'])->name('verification.notice');

    // Handle the email verification link click
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard'); // or wherever you want after verification
    })->middleware(['auth', 'signed'])->name('verification.verify');

    // Resend the verification email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    // *** [@Relationship] Application Section *** // Added Relationship section
    Route::prefix('users')
        ->middleware('auth')
        ->group(function () {
            Route::group([], function () {
                Route::get('/manage', [ManagementController::class, 'index'])->name('users.manage');
                Route::get('/manage/details/{id}', [ManagementController::class, 'details'])->name('users.details');
                Route::get('/fetch', [ManagementController::class, 'fetch'])->name('users.fetch');
                Route::post('/update/{id}', [ManagementController::class, 'updateInline'])->name('users.update');


                Route::get('/api/activity-logs', [ActivityLogsController::class, 'activities'])->name('activity.logs');
                Route::get('/api/credit-logs', [CreditsController::class, 'activities'])->name('credit.logs');
            });
        });
    // *** [@Relationship] Application Section *** // Added Relationship section
    Route::prefix('/relationship')
        ->middleware('auth')
        ->group(function () {
            Route::get('/list', [ContactController::class, 'index']);
            Route::get('/list/contacts/{id}', [ContactController::class, 'create_contacts']);
            Route::get('/list/register', [ContactController::class, 'create_company']);
            Route::get('/create', [ContactController::class, 'create_company']); // TEMP
            Route::get('/list/edit/{company}/{id}', [ContactController::class, 'edit_contact_details']);
            Route::get('/list/details/{id}', [ContactController::class, 'company_details']);

            Route::get('/clients', [ContactController::class, 'index']);

            Route::post('/store', [ContactController::class, 'store'])->name('contact.create');
            Route::post('/update/{id}', [ContactController::class, 'update'])->name('contact.update');

            Route::post('/api/contacts', [ContactController::class, 'getClients'])->name('api.relationship.contacts');
            Route::post('/api/projects', [ContactController::class, 'getProjects'])->name('api.relationship.projects');

            Route::post('/api/company/contacts', [ContactController::class, 'getContacts'])->name('project.relationship.contacts');

            Route::post('/data/contact/store', [ContactController::class, 'store_contact'])->name('relationship.contact.store');
            Route::post('/data/contact/update/{id}', [ContactController::class, 'update_contact'])->name('relationship.contact.update');

            Route::get('/clients', [ContactController::class, 'clients']);
            Route::get('/client/data', [ContactController::class, 'getClients'])->name('relationship.contacts');

            Route::get('/company/data', [ContactController::class, 'getCompany'])->name('relationship.company');
            Route::get('/company/data/subscriber', [ContactController::class, 'getCompanySubscriber'])->name('relationship.company.subscriber');

            Route::get('/person/list/{id}', [ContactController::class, 'person_index']);
            Route::get('/person/create', [ContactController::class, 'person_create']);
            Route::get('/{company_id}/person/new', function ($company_id) {
                //return view('pages.contacts.forms.new_client', compact('company_id'));
            });

            Route::post('/xyz', [ContactController::class, 'endpoint'])->name('contacts');
            Route::post('/clients/delete', [ContactController::class, 'deleteClients'])->name('clients.delete');
            Route::post('/person/store', [ContactController::class, 'person_store'])->name('contact-persons.store');
        });

    Route::middleware(['auth'])->group(function () {
        Route::get('/calendar', [CalendarEventController::class, 'view'])->name('calendar.view');
        Route::get('/calendar-events', [CalendarEventController::class, 'index']);
        Route::post('/calendar-events', [CalendarEventController::class, 'store']);
        Route::put('/calendar-events/{event}', [CalendarEventController::class, 'update']);
        Route::delete('/calendar-events/{event}', [CalendarEventController::class, 'destroy']);
    });

    Route::get('/url/chat', function () {
        $id = Auth::user()->id;
        $token = Crypt::encryptString("user:{$id}|time:" . now()->timestamp);
        $url = url("/api/launch-chat/{$token}/{$id}");

        return response()->make(
            "
        <html>
            <head>
                <title>Redirecting to Chat...</title>
                <script>
                    window.onload = function() {
                        window.location.href = '{$url}';
                    };
                </script>
            </head>
            <body>
                <noscript>
                    <p>JavaScript is required. <a href=\"{$url}\">Click here to continue</a>.</p>
                </noscript>
            </body>
        </html>
    ",
            200,
            ['Content-Type' => 'text/html'],
        );
    });

    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    Route::post('/delete', [Administrator::class, 'trashBin'])
        ->name('trash.bin')
        ->middleware('auth');

    Route::middleware('auth')
        ->get('/dashboard', function () {
            $roleRoutes = [
                'Developer' => '/developer/dashboard',
                'Administrator' => '/dashboard/auth',
                'Client' => '/dashboard/member',
                'Sub-Client' => '/dashboard/member',
                'Virtual Assistant' => '/dashboard/member',
                'default' => '/member/dashboard',
            ];

            $role = Auth::user()->role;
            $redirectRoute = $roleRoutes[$role] ?? $roleRoutes['default'];

            return redirect($redirectRoute);
        })
        ->name('dashboard');

    // *** [@Administrator] Application Section *** // Added Administrator section
    Route::prefix('/hbcs')
        ->group(function () {
            Route::get('/clients', [Administrator::class, 'clients']);
            Route::get('/clients/details/{id}', [Administrator::class, 'client_details']);

            Route::post('/api/client/data', [Administrator::class, 'client_data'])->name('hbcs.clients.data');
            Route::post('/client/store', [LeadController::class, 'store'])->name('leads.store');
            Route::post('/client/update/{id}', [LeadController::class, 'update'])->name('leads.update');

            Route::post('/assigned', [LeadController::class, 'assigned'])->name('assigned.va');

            Route::get('/directors', [Administrator::class, 'directors']);
            Route::post('/api/data', [Administrator::class, 'client_data'])->name('api.hbcs.data');
        })
        ->middleware('auth');

    // *** [@Bid] Application Section *** // Added Bid section
    Route::prefix('/bid')
        ->middleware('auth')
        ->group(function () {
            Route::get('/invitation', [CustomerController::class, 'invitation']);
            Route::get('/projects', [CustomerController::class, 'projects']);
            Route::get('/projects/{project_id}', [CustomerController::class, 'details'])->name('bids.index');
            Route::get('/preview/projects/{project_id}', [CustomerController::class, 'preview'])->name('bids.preview');

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
        });

    Route::post('/bids/{project_id}', [BidController::class, 'store'])->name('bids.store');
    Route::post('/bids-cancel/{project_id}', [BidController::class, 'cancel'])->name('bids.cancel');
    Route::get('/bids/{project_id}', [BidController::class, 'index'])->name('bids.index');

    // *** [@Builder] Application Section *** // Added Builder section
    Route::prefix('/builder')
        ->middleware('auth')
        ->group(function () {
            Route::get('/banner', [BuilderController::class, 'banner']);
            Route::get('/about', [BuilderController::class, 'about']);
        });

    // *** [@Chat] Application Section *** // Added Chat section
    Route::prefix('/chat')
        ->middleware('auth')
        ->group(function () {
            Route::get('/questionnaire', [ChatQuestionController::class, 'index']);
            Route::post('/questionnaire/save', [ChatQuestionController::class, 'store'])->name('chat-questions.store');

            // Route::get('/{id}', [ChatController::class, 'chat']);

            Route::post('/discussions', [ChatController::class, 'store'])->name('chats.old.store');
            // Route::post('/messages', [ChatController::class, 'getMessages'])->name('chats.old.list');
        });

    //Route::post('/chat/send', [ChatMessageController::class, 'sendMessage']);
    Route::get('/chat/faq/{identifier}', [ChatMessageController::class, 'getPredefined']);

    // *** [@Clients] Application Section *** // Added Clients section
    Route::prefix('/client')
        ->middleware('auth')
        ->group(function () {
            // Route::get('/list', function () { // Commented out the anonymous function route
            //     return view('pages.clients.modules.client_list');
            // });
            Route::get('/{company_id}/new', function ($company_id) {
                return view('pages.clients.modules.client_new', compact('company_id'));
            });

            Route::get('/list', [ClientsController::class, 'index']);
            Route::get('/list/register', [ClientsController::class, 'register']);
            Route::get('/list/details/{id}', [ClientsController::class, 'client_details']);
            Route::get('/view/{id}', [ClientsController::class, 'details']);

            Route::post('/api/client/data', [ClientsController::class, 'getClients'])->name('api.client.contacts');
            Route::post('/api/project/data', [ClientsController::class, 'getProjects'])->name('api.client.projects');

            Route::post('/store', [ClientsController::class, 'store'])->name('client.store');
            Route::post('/update/{id}', [ClientsController::class, 'update'])->name('client.update');
            Route::post('/list/data', [ClientsController::class, 'client_data'])->name('clients.data');
            Route::post('/{client}/credits/store', [CreditController::class, 'store'])->name('credits.store'); // Moved here for alphabetical order
        });

    Route::get('/client', function () {
        // Kept this route as it seems distinct
        return view('pages.client_sub.index');
    });

    // *** [@CMS] Application Section *** // Added CMS section
    Route::prefix('/cms')
        ->middleware('auth')
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

            Route::get('/gallery', [ContentManagement_GalleryController::class, 'cms_gallery_index']);
            Route::post('/gallery/store', [ContentManagement_GalleryController::class, 'cms_gallery_store'])->name('cms.gallery.store');
            Route::post('/gallery/update/info/{id}', [ContentManagement_GalleryController::class, 'cms_teams_info_store'])->name('cms.gallery.info.update');
            Route::post('/gallery/update/logo', [ContentManagement_GalleryController::class, 'cms_gallery_update_logo'])->name('cms.gallery.logo.update');
            Route::post('/gallery/update/position', [ContentManagement_GalleryController::class, 'cms_gallery_update_position'])->name('cms.gallery.position.update');
            Route::post('/gallery/delete', [ContentManagement_GalleryController::class, 'cms_gallery_remove'])->name('cms.gallery.delete');

            Route::get('/inquiry-logs', [MessageController::class, 'index'])->name('content.contact');
            Route::post('/inquiry-logs/data', [MessageController::class, 'list'])->name('cms.inquiry.list');

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

            // Route::post('/clients/update', [ContentsClientController::class, 'update'])->name('cms.clients.update');
            // Route::post('/update-gallery-position', [ContentController::class, 'updatePosition'])->name('gallery.updatePosition');
            // Route::post('/gallery/delete', [ContentController::class, 'deleteGallery'])->name('gallery.delete');
            // Route::post('/content/gallery/store', [ContentController::class, 'gallery_store'])->name('content.gallery.store');
            // Route::post('/clients/storeX', [ContentsClientController::class, 'store'])->name('cms.clients.storeX');
        });

    // *** [@CRM] Application Section *** // Added CRM section
    Route::prefix('/crm')
        ->middleware('auth')
        ->group(function () {
            Route::get('/lead/facebook/create', [FacebookLeadController::class, 'create'])->name('lead.facebook');
            Route::get('/lead/facebook', [FacebookLeadController::class, 'index'])->name('lead.facebook.list');

            Route::get('/lead/demo/{link}', [FacebookLeadController::class, 'leads_x'])->name('lead.facebook.list');
            // Route::get('/lead/tiktok', [FacebookLeadController::class, 'index'])->name('lead.tiktok.list');
            // Route::get('/lead/instagram', [FacebookLeadController::class, 'index'])->name('lead.instagram.list');
            // Route::get('/lead/linkedin', [FacebookLeadController::class, 'index'])->name('lead.linkedin.list');
            // Route::get('/lead/youtube', [FacebookLeadController::class, 'index'])->name('lead.youtube.list');

            Route::get('/lead/generic', [FacebookLeadController::class, 'generic'])->name('lead.generic.list');
            Route::post('/lead/generic/update', [FacebookLeadController::class, 'updateCell'])->name('generic.update');

            Route::get('/profit/tracker', [ProjectProfitTrackerController::class, 'generic'])->name('profit.tracker.list');
            Route::post('/profit/tracker/update', [ProjectProfitTrackerController::class, 'updateCell'])->name('profit.update');

            Route::post('/lead/facebook/data', [FacebookLeadController::class, 'list'])->name('lead.facebook.data');
            Route::post('/lead/facebook/store', [FacebookLeadController::class, 'store'])->name('lead.facebook.store');
        });

    Route::prefix('/dashboard') // Kept this dashboard prefix together
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

            Route::get('/sales', function () {
                return view('pages.dashboard.sales');
            });
        });

    Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussions.index');
    Route::post('/discussions', [DiscussionController::class, 'store'])
        ->name('discussions.store')
        ->middleware('auth');

    Route::get('/download-file/{id}', [GoogleDriveController::class, 'download']); // Kept here

    // *** [Email] Application Section *** // Added Email section
    Route::get('/email/send', [EmailController::class, 'send'])->name('email.send');
    Route::get('/email/template', [EmailController::class, 'template'])->name('email.template');
    Route::get('/email/template/setup', [EmailController::class, 'setup'])->name('email.setup');
    //Route::get('/email/send', [EmailController::class, 'create'])->name('email.create');

    Route::get('/FAQ', function () {
        // Kept here
        return view('pages.tools.faq');
    });

    // *** [@File Manager] Application Section *** // Added File Manager section
    Route::prefix('/file-manager')
        ->middleware('auth')
        ->group(function () {
            Route::get('/list', [FileManagerController::class, 'index'])->name('filemanager.index');
            Route::get('/list/folder', [FileManagerController::class, 'index'])->name('filemanager.index');
            //Route::get('/preview/{id}', [FileManagerController::class, 'preview'])->name('filemanager.index');

            Route::get('/preview/{id}', [GoogleDriveController::class, 'show'])->name('filemanager.filemanager');

            Route::get('/storage', [FileManagerController::class, 'index'])->name('filemanager.index');
            Route::get('/{parent_id?}', [FileManagerController::class, 'xindex'])->name('filemanager.index');
            Route::get('/folder/privacy', [FileManagerController::class, 'updatePrivacy'])->name('folder.privacy');
            Route::get('/folder/file/{url}', [FileManagerController::class, 'preview'])->name('folder.preview.file');

            Route::post('/upload', [FileManagerController::class, 'store'])->name('filemanager.store');
            Route::post('/create/folder', [FileManagerController::class, 'folder'])->name('filemanager.folder');
            Route::post('/submit', [FileManagerController::class, 'submitted'])->name('filemanager.submitted');
            Route::post('/rename/{id}', [FileManagerController::class, 'rename'])->name('filemanager.rename');

            Route::post('/api/files', [FileManagerController::class, 'api_files'])->name('api.filemanager.files');

            Route::delete('/{file}', [FileManagerController::class, 'destroy'])->name('filemanager.destroy');
        });

    Route::get('/sheet/{id}', [GoogleDriveController::class, 'show'])->name('sheet.show');

    Route::get('/feedback-hub', function () {
        // Kept here
        return view('pages.tools.feedback');
    });

    // *** [@Greetings] Application Section *** // Added Greetings section
    Route::prefix('/content')
        ->middleware('auth')
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
        });

    // *** [@Profit Tracker] Application Section *** // Added Greetings section
    Route::prefix('/profit-tracker')
        ->middleware('auth')
        ->group(function () {
            Route::get('/bids', [ProjectProfitTrackerController::class, 'index'])->name('pt.bids.index');
            Route::get('/bids/  /create', [ProjectProfitTrackerController::class, 'create'])->name('pt.bids.create');
            Route::get('/bids/store', [ProjectProfitTrackerController::class, 'store'])->name('pt.bids.store');

            Route::get('/cors', [CorsPendingController::class, 'index'])->name('pt.cors.index');
            Route::get('/cors/list/create', [CorsPendingController::class, 'create'])->name('pt.cors.create');
            Route::get('/cors/store', [CorsPendingController::class, 'store'])->name('pt.cors.store');

            Route::get('/income', [IncomeController::class, 'index'])->name('pt.income.index');
            Route::get('/income/list/create', [IncomeController::class, 'create'])->name('pt.income.create');
            Route::get('/income/store', [IncomeController::class, 'store'])->name('pt.income.store');

            Route::get('/expense', [ExpenseController::class, 'index'])->name('pt.expense.index');
            Route::get('/expense/list/create', [ExpenseController::class, 'create'])->name('pt.expense.create');
            Route::get('/expense/store', [ExpenseController::class, 'store'])->name('pt.expense.store');
        });

    Route::get('/google-drive', function (Request $request) {
        // Kept here
        return view('pages.filemanager.upload');
    });
    Route::post('/google-drive-actived', [GoogleDriveController::class, 'activated'])->name('drive.folder.activated'); // Kept here
    Route::post('/drive/folder/create', [GoogleDriveController::class, 'folder'])->name('drive.folder.create'); // Kept here
    Route::get('/drive/storage', [GoogleDriveController::class, 'getStorageInfo']); // Kept here
    Route::post('/drive/file/upload', [GoogleDriveController::class, 'upload'])->name('drive.file.upload'); // Modified line: Changed 'upload-file' to '/drive/file/upload' for consistency

    Route::get('/leads', [Clients::class, 'index']); // Kept here
    // Route::get('/client/details/{id}', function ($id) { // Commented out anonymous function route
    //     return view('pages.clients.view', compact('id'));
    // })->name('dashboard');

    Route::get('/member/dashboard', function () {
        // Kept here
        return view('pages.clients.dashboard_member');
    });

    // *** [@Notes] Application Section *** // Added Notes section
    Route::middleware(['auth'])->group(function () {
        Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
        Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
        Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
        Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
        Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    });

    Route::get('/preview-file/{id}', [GoogleDriveController::class, 'preview']); // Kept here
    Route::get('/preview-office/{id}', [GoogleDriveController::class, 'officeFilePreview']); // Kept here



    // *** [@Purchase Credit] Application Section *** // Added Purchase Credit section
    Route::post('/request-credit', [RequestCreditController::class, 'store'])->name('request.credit.store');
    Route::get('/my-credit-requests', [RequestCreditController::class, 'index'])->name('request.credit.index');
    Route::post('/request-credit/{id}/status', [RequestCreditController::class, 'updateStatus'])->name('request.credit.updateStatus');

    // *** [@Sales] Application Section *** // Added Sales section
    Route::prefix('/sales')
        ->middleware('auth')
        ->group(function () {
            Route::get('/relationship/list', [SalesController::class, 'index']);
            Route::get('/list/register', [ClientsController::class, 'register']);
            Route::get('/relationship/list/details/{id}', [SalesController::class, 'client_details']);

            Route::post('/api/client/data', [ClientsController::class, 'getClients'])->name('api.client.contacts');
            Route::post('/api/project/data', [ClientsController::class, 'getProjects'])->name('api.client.projects');

            Route::post('/store', [ClientsController::class, 'store'])->name('client.store');
            Route::post('/update/{id}', [SalesController::class, 'update'])->name('sales.update');
            Route::post('/list/data', [SalesController::class, 'client_data'])->name('sales.data');
        });

    Route::get('/task-board', function () {
        // Kept here
        return view('pages.apps.taskBoard');
    });

    // *** [@Task] Application Section *** // Added Task section
    Route::prefix('/task')
        ->middleware('auth')
        ->group(function () {
            Route::get('/list', [TaskController::class, 'index']);
            Route::get('/list/create', [TaskController::class, 'create']);
            Route::get('/list/details/{id}', [TaskController::class, 'details']);

            Route::post('/api/list/data', [TaskController::class, 'list'])->name('api.task.list');

            Route::post('/store', [TaskController::class, 'store'])->name('task.create');
        });

    Route::get('/temp/logout', function (Request $request) {
        // Kept here
        Auth::logout(); // Log out the user

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login')->with('success', 'You have been logged out.');
    });

    // *** [@Todo List] Application Section ***
    // Route::prefix('/todo')
    //     ->middleware('auth')
    //     ->group(function () {
    //         Route::get('/list', [TaskController::class, 'index']);
    //         Route::post('/tasks', [TaskController::class, 'store']);
    //         Route::put('/tasks/{task}', [TaskController::class, 'update']);

    //         // Route::post('/subtasks', [SubTaskController::class, 'store']);
    //         // Route::put('/subtasks/{subtask}', [SubTaskController::class, 'update']);
    //     });
    Route::prefix('/todo')
        ->middleware('auth')
        ->group(function () {
            Route::get('/list', [TaskController::class, 'index']);
            Route::post('/tasks', [TaskController::class, 'store']);
            Route::put('/tasks/{task}', [TaskController::class, 'update']);

            Route::post('/subtasks', [TaskController::class, 'sub_store']);
            Route::put('/subtasks/{subtask}', [TaskController::class, 'sub_update']);

            Route::get('/create', [TaskController::class, 'create']);
            Route::post('/assigned', [TaskController::class, 'assigned']);

            Route::get('/tasks/{task}/progress', function (App\Models\V3_Task $task) {
                $percent = $task->subtasks()->count() ? round(($task->subtasks()->where('status', 'completed')->count() / $task->subtasks()->count()) * 100) : 0;

                $color = '#f44336';
                if ($percent >= 60) {
                    $color = '#4caf50';
                } elseif ($percent >= 30) {
                    $color = '#ff9800';
                }

                return response()->json(['percent' => $percent, 'color' => $color]);
            });
        });

    Route::get('/to-do-list', function () {
        // Kept here
        return view('pages.apps.tasks.todo');
    });

    Route::post('/upload-document', [DocumentController::class, 'store'])->name('documents.store'); // Kept here

    // *** [@Virtual Assistant] Application Section *** // Added Virtual Assistant section
    Route::prefix('/virtual-assistant')
        ->middleware('auth')
        ->group(function () {
            Route::get('/list', [VirtualAssistantController::class, 'index']);

            Route::post('/store', [VirtualAssistantController::class, 'store'])->name('va.store');
            Route::post('/data', [VirtualAssistantController::class, 'list'])->name('va.list');
        });

    Route::prefix('/payment')
        ->middleware('auth')
        ->group(function () {
            Route::get('/quickbooks', [QuickBooksControllers::class, 'quickbooks']);
        });


    Route::prefix('/hook')
        ->middleware('auth')
        ->group(function () {
            Route::post('/grant/access', function (Request $request) {
                $user = User::where('id', $request->id)->first();
                $m_id = $user->id;

                session()->put('manage_portal_id', $m_id);
                session()->put('manage_portal_email', $user->email);
                session()->put('manage_orignal_id', Auth::user()->id);

                return redirect('/va/my-clients')->with(['success' => 'Success']);
            })->name('grant.access');

            Route::get('/reset/access', function () {
                session()->forget('manage_portal_id');
                session()->forget('manage_portal_eforgetl');
                session()->forget('manage_orignal_id');

                return redirect('/dashboard')->with(['success' => 'Success']);
            });
        });

    Route::get('/api/user-name/{id}', function ($id) {
        $user = User::find($id);
        return response()->json([
            'name' => $user?->name,
            'avatar' => $user?->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : '/user.png',
        ]);
    });
});

Route::get('/test-upload', function () {
    $drive = app(\App\Services\GoogleDriveService::class);
    $localFilePath = storage_path('app/temp_project_uploads/sample.pdf'); // put a test file there manually
    $folderId = Auth::user()->google_drive_id; // or hardcode a folder id
    $uploadedFileId = $drive->uploadFile($localFilePath, 'sample.pdf', $folderId);

    dd($uploadedFileId);
});


    
    // Automation routes
    Route::get('/projects/{project}/automation-suggestions', [App\Http\Controllers\ProjectManagement\AutomationController::class, 'getAutomationSuggestions']);
    Route::get('/projects/{project}/automation-rules', [App\Http\Controllers\ProjectManagement\AutomationController::class, 'getAutomationRules']);
    Route::post('/automation/execute', [App\Http\Controllers\ProjectManagement\AutomationController::class, 'executeAutomation']);
    Route::post('/automation/create-rule', [App\Http\Controllers\ProjectManagement\AutomationController::class, 'createAutomationRule']);
    Route::patch('/automation/rules/{rule}/toggle', [App\Http\Controllers\ProjectManagement\AutomationController::class, 'toggleAutomationRule']);
    
    Route::get('/meet/popup', function () {
        return view('meet.popup'); // resources/views/meet/popup.blade.php
    })->name('meet.popup');

    Route::prefix('developer')
        ->middleware('auth')
        ->group(function () {
            Route::group([], function () {
                Route::get('/tools', [DeveloperController::class, 'tools'])->name('developer.tools');
                Route::get('/dashboard', [DeveloperController::class, 'dashboard'])->name('developer.dashboard');
                Route::get('/manage', [DeveloperController::class, 'index'])->name('developer.manage');
                Route::post('/manage', [DeveloperController::class, 'store'])->name('developer.route.store');
                Route::resource('/routes', DeveloperController::class);
            });
        });


Route::prefix('sheet')
    ->middleware('auth')
    ->group(function () {
        Route::group([], function () {
            Route::post('/pms', [ProjectManagementSheet::class, 'updateCell'])->name('sheet.pms');
            Route::post('/pms/delete', [ProjectManagementSheet::class, 'deleteRow'])->name('sheet.pms.rowDelete');
            Route::post('/pms/{project}/contract', [ProjectManagementSheet::class, 'updateAmount'])->name('sheet.pms.contract');
        });
    });

Route::middleware(['auth'])->group(function () {

    Route::post('/chats/conversations/open', [ConversationController::class, 'open'])
        ->name('chats.conversations.open');

    Route::prefix('chats')
        ->middleware('auth')
        ->group(function () {
            Route::group([], function () {
                Route::get('/message', [MessagesController::class, 'index'])->name('users.manage');

                Route::get('/conversations', [ConversationController::class, 'index']);
                Route::post('/conversations/dm', [ConversationController::class, 'storeDm']);
                Route::post('/conversations/group', [ConversationController::class, 'storeGroup']);
                Route::patch('/conversations/{conversation}', [ConversationController::class, 'update']);

                Route::post('/conversations/{conversation}/participants', [ConversationController::class, 'listMembers']);
                Route::get('/conversations/{conversation}/attachments', [ConversationController::class, 'attachments'])
                    ->name('chats.participants.attachments');
                Route::post('/conversations/{conversation}/rename', [ConversationController::class, 'rename']);
                // Add participants
                Route::post('/conversations/{conversation}/participants/add', [ConversationController::class, 'add'])
                    ->name('chats.participants.add');
                // Remove participant
                Route::post('/conversations/{conversation}/participants/{user}/remove', [ConversationController::class, 'remove'])
                    ->name('chats.participants.remove');


                Route::get('/users/search', [ConversationController::class, 'search'])
                    ->name('users.search');

                Route::post('/conversations/{conversation}/members', [ConversationController::class, 'addMembers']);

                Route::delete('/conversations/{conversation}/members/{user}', [ConversationController::class, 'removeMember']);
                Route::post('/conversations/{conversation}/leave', [ConversationController::class, 'leave']);

                // Per-user flags
                Route::post('/conversations/{conversation}/pin', [ConversationController::class, 'pin']);
                Route::delete('/conversations/{conversation}/pin', [ConversationController::class, 'unpin']);
                Route::post('/conversations/{conversation}/archive', [ConversationController::class, 'archive']);
                Route::delete('/conversations/{conversation}/archive', [ConversationController::class, 'unarchive']);
                Route::post('/conversations/{conversation}/trash', [ConversationController::class, 'trash']);
                Route::delete('/conversations/{conversation}/trash', [ConversationController::class, 'restore']);
                Route::post('/conversations/{conversation}/read', [ConversationController::class, 'markRead']);
                Route::post('/conversations/{conversation}/info', [ConversationController::class, 'info']);

                Route::post('/conversations/{conversation}/meet/join', [ConversationController::class, 'joined']);
                Route::post('/conversations/{conversation}/meet/left', [ConversationController::class, 'left']);
                Route::post('/conversations/{conversation}/meet/end', [ConversationController::class, 'end']);


                // Messages
                Route::get('/conversations/{conversation}/messages', [MessagesController::class, 'list']);
                Route::post('/conversations/{conversation}/messages', [MessagesController::class, 'store']);
                // routes/web.php or routes/api.php
                Route::patch('/chats/conversations/{conversation}', [ConversationController::class, 'update']); // existing
                // add this if you want POST too:
                Route::post('/chats/conversations/{conversation}', [ConversationController::class, 'update']);


                Route::patch('/messages/{message}', [MessagesController::class, 'update']);
                Route::delete('/messages/{message}', [MessagesController::class, 'destroy']);

                // Reactions & Pins
                Route::post('/messages/{message}/reactions', [MessagesController::class, 'react']);
                Route::delete('/messages/{message}/reactions', [MessagesController::class, 'unreact']);
                Route::post('/messages/{message}/pin', [MessagesController::class, 'pinMessage']);
                Route::delete('/messages/{message}/pin', [MessagesController::class, 'unpinMessage']);
            });
        });



    Route::prefix('/project-management')
        ->middleware('auth')
        ->group(function () {
            Route::group([], function () {
                Route::get('/list', [ProjectMngntController::class, 'index'])->name('project-management.list');
                Route::get('/overview', [ProjectMngntController::class, 'overview'])->name('project-management.overview');
                Route::get('/analytics', [ProjectMngntController::class, 'analytics'])->name('project-management.analytics');
                Route::get('/calendar', [ProjectMngntController::class, 'calendar'])->name('project-management.calendar');
                Route::get('/reports', [ProjectMngntController::class, 'reports'])->name('project-management.reports');
                Route::get('/settings', [ProjectMngntController::class, 'settings'])->name('project-management.settings');
                Route::get('/templates', [ProjectMngntController::class, 'templates'])->name('project-management.templates');
                Route::get('/archive', [ProjectMngntController::class, 'archive'])->name('project-management.archive');
                
                Route::get('/{project}/dashboard', [ProjectMngntController::class, 'dashboard'])->name('projects.dashboard');
                Route::get('/projects/{project}/tracker', [ProjectMngntController::class, 'tracker'])->name('projects.tracker');
                Route::get('/projects/{project}/expenses', [ProjectMngntController::class, 'expenses'])->name('projects.expenses');
                Route::get('/projects/{project}/timeline', [ProjectMngntController::class, 'timeline'])->name('projects.timeline');
                Route::get('/projects/{project}/files', [ProjectMngntController::class, 'files'])->name('projects.files');
                Route::get('/projects/{project}/team', [ProjectMngntController::class, 'team'])->name('projects.team');
                Route::get('/projects/{project}/communication', [ProjectMngntController::class, 'communication'])->name('projects.communication');
                
                // Task Detail View Route
                Route::get('/{project}/tasks/{task}/detail', [ProjectMngntController::class, 'taskDetail'])->name('projects.tasks.detail');

                Route::get('/api/projects', [ProjectMngntController::class, 'fetch'])->name('projects.fetch');
            });
        });

    // Project Management Routes
    Route::resource('projects', ProjectMngntController::class);
    Route::resource('projects.tasks', \App\Http\Controllers\ProjectManagement\TaskController::class);
    Route::patch('projects/tasks/{task}/status', [\App\Http\Controllers\ProjectManagement\TaskController::class, 'updateStatus'])->name('projects.tasks.status');
    Route::patch('projects/tasks/{task}', [\App\Http\Controllers\ProjectManagement\TaskController::class, 'update'])->name('projects.tasks.update');
    Route::post('projects/bulk-delete', [ProjectMngntController::class, 'bulkDelete'])->name('projects.bulk-delete');
    Route::post('projects/assign', [ProjectMngntController::class, 'assignToUser'])->name('projects.assign');
    Route::post('projects/assign-team', [ProjectMngntController::class, 'assignTeam'])->name('projects.assign-team');
    Route::get('projects/{project}/team-members', [ProjectMngntController::class, 'getTeamMembers'])->name('projects.team-members');
    Route::delete('projects/team-member', [ProjectMngntController::class, 'removeTeamMember'])->name('projects.remove-team-member');
    
    // Task assignment and status routes
    Route::get('project-management/{project}/team-members', [ProjectMngntController::class, 'getTeamMembers'])->name('project-management.team-members');
    Route::get('project-management/my-tasks', [ProjectMngntController::class, 'memberDashboard'])->name('project-management.my-tasks');
    Route::get('project-management/tasks/{task}/assignments', [\App\Http\Controllers\ProjectManagement\TaskController::class, 'getAssignments'])->name('tasks.assignments');
    Route::get('project-management/tasks/{task}/assignment-data', [\App\Http\Controllers\ProjectManagement\TaskController::class, 'getAssignmentData'])->name('tasks.assignment-data');
    Route::post('project-management/tasks/{task}/assign', [\App\Http\Controllers\ProjectManagement\TaskController::class, 'assign'])->name('tasks.assign');
    Route::patch('/project-management/tasks/{task}/status', [App\Http\Controllers\ProjectManagement\TaskController::class, 'updateStatus']);


    // Task Management Routes
    Route::resource('tasks', DefaultTaskController::class)->only(['index', 'create', 'store']);
    Route::patch('tasks/{task}/status', [DefaultTaskController::class, 'updateStatus'])->name('tasks.status');
    Route::patch('tasks/{task}/assign', [DefaultTaskController::class, 'assign'])->name('tasks.assign');
    Route::get('tasks/calendar', [DefaultTaskController::class, 'calendar'])->name('tasks.calendar');
    Route::get('tasks/my-tasks', [DefaultTaskController::class, 'myTasks'])->name('tasks.my-tasks');
    Route::post('tasks/{task}/comment', [DefaultTaskController::class, 'addComment'])->name('tasks.comment');
    Route::patch('tasks/{task}/priority', [DefaultTaskController::class, 'updatePriority'])->name('tasks.priority');

    // Expense Management Routes
    Route::resource('projects.expenses', ExpenseController::class)->except(['show']);
    Route::patch('expenses/{expense}/approve', [ExpenseController::class, 'approve'])->name('expenses.approve');
    Route::patch('expenses/{expense}/reject', [ExpenseController::class, 'reject'])->name('expenses.reject');

    // Income Management Routes
    Route::resource('projects.incomes', IncomeController::class)->except(['show']);
    Route::patch('incomes/{income}/status', [IncomeController::class, 'updateStatus'])->name('incomes.status');

    // Team Management Routes
    Route::get('teams', [TeamController::class, 'index'])->name('teams.index');
    Route::get('teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('teams/{team}', [TeamController::class, 'show'])->name('teams.show');
    Route::get('teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::patch('teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
    Route::get('teams/{team}/performance', [TeamController::class, 'performance'])->name('teams.performance');
    Route::post('teams/{team}/members', [TeamController::class, 'addMember'])->name('teams.add-member');
    Route::delete('teams/{team}/members/{user}', [TeamController::class, 'removeMember'])->name('teams.remove-member');
    // Route::post('projects/{project}/team', [ProjectTeamController::class, 'store'])->name('projects.team.store');
    // Route::delete('projects/{project}/team/{user}', [ProjectTeamController::class, 'destroy'])->name('projects.team.destroy');
    // Route::patch('projects/{project}/team/{user}', [ProjectTeamController::class, 'updateRole'])->name('projects.team.role');

    // TEMP END

    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('/manager/permissions/{user}', [ManagerController::class, 'permissions'])->name('manager.permissions');
    Route::post('/manager/permissions/{user}', [ManagerController::class, 'updatePermissions'])->name('manager.permissions.update');
    Route::get('/manager/{user}/preview', [ManagerController::class, 'previewNavigation'])->name('manager.preview');

    // $routes = App\Models\Privilege\Route::where('is_active', true)->get();
    // foreach ($routes as $dbRoute) {
    //     Route::get($dbRoute->path, [RouteController::class, 'handleRoute'])
    //         ->name($dbRoute->name)
    //         ->middleware('route.permission:' . $dbRoute->name)
    //         ->defaults('routeName', $dbRoute->name);
    // }


    Route::view('/project-management/ai', 'modules.ai.project-management.index'); // Updated to use modular structure

    Route::post('/ai', function (Request $req) {
        $data = $req->validate([
            'messages'    => 'required|array',   // [{role, content}]
            'title'       => 'nullable|string|max:150',
            'description' => 'nullable|string|max:4000',
            'due_date'    => 'nullable|date',
            'budget'      => 'nullable|numeric|min:0',
            'tasks'       => 'nullable|array',   // [{name, est_days, dependsOn[], notes}]
            'tasks.*.name'      => 'required_with:tasks|string|max:200',
            'tasks.*.est_days'  => 'nullable|numeric|min:0',
            'tasks.*.dependsOn' => 'nullable|array',
            'tasks.*.dependsOn.*' => 'nullable|string|max:200',
            'tasks.*.notes'     => 'nullable|string|max:1000',
        ]);

        $hasUserTasks = !empty($data['tasks']) && is_array($data['tasks']);

        // --- System prompt: Janitorial PM planner (NO employee DB), due-date anchored, suggest tasks if missing
        $system = [
            'role' => 'system',
            'content' => <<<SYS
You are a Project Planning Assistant for a janitorial services company.

**Scheduling rule (very important):**
- If a project "due_date" is provided, anchor the plan to that date and schedule **backward** so the final QA/turnover ends **on or before the due_date**. Use realistic durations.
- Respect task dependencies. If explicit "tasks" are provided by the user (with optional est_days and dependsOn), merge them into the plan and place them on the timeline (with start/end) relative to the due_date and other steps.
- If due_date is missing, ask for it before producing a full plan.
- Make the date humanize formatd (e.g., "2024-12-31" → "December 31, 2024").

**If the user did not provide any tasks:**
- Include a "suggested_tasks" array with 6–14 tasks typical for janitorial project work (site assessment, pre-clean, area deep-cleans, floor stripping/waxing, windows/high-access, waste management, QA/turnover, etc.). Each item must have:
  {"name":"string","est_days": number,"dependsOn":["string"],"notes":"string"}
- Also use these suggested tasks to construct the "timeline" with computed start/end (anchored to due_date).
- Add more details about the tasks, such as "est_days" (estimated days) and "dependsOn" (dependencies), to ensure a realistic sequence.

When enough info exists, reply with **valid JSON only** (no markdown) matching this schema:

{
  "timeline": [
    {"task":"string","start":"YYYY-MM-DD","end":"YYYY-MM-DD","dependsOn":["string"],"notes":"string"}
  ],
  "manpower_hours": {
    "by_role": [{"role":"string","hours": number}],
    "total_hours": number
  },
  "expense_summary": {
    "labor": number,
    "supplies": number,
    "equipment": number,
    "contingency": number,
    "total": number,
    "budget": number,
    "variance": number
  },
  "role_recommendations": [
    {"role":"string","skills":["string"],"headcount": number,"hours_each": number,"total_hours": number,"notes":"string"}
  ],
  "risks": ["string"],
  "assumptions": ["string"],
  "notes": ["string"],
  "suggested_tasks": [
    {"name":"string","est_days": number,"dependsOn":["string"],"notes":"string"}
  ]
}

Guidance:
- Use janitorial roles like Supervisor, Team Lead, General Cleaner, Floor Technician (stripping/waxing), Window/High-Access Tech, Waste Handler, Quality Inspector, Safety Officer (as needed).
- Suggest skills per role (e.g., "auto-scrubber", "PPE", "chemical dilution ratios", "ladder/high-access").
- Keep plan within budget if possible; if not, compute variance and suggest trade-offs (reduce frequency/scope, shift hours, cheaper consumables, reschedule heavy equipment).
- Provide realistic sequencing (site assessment → pre-clean → deep cleans by area → floor care → windows → QA).
- If user-provided tasks exist, include them in "timeline" with computed start/end (use est_days when present).
- Be concise but complete. Always output valid JSON.
SYS
        ];

        // Structured context
        $context = [
            'role' => 'user',
            'content' => json_encode([
                'project' => [
                    'title'       => $data['title'] ?? null,
                    'description' => $data['description'] ?? null,
                    'due_date'    => $data['due_date'] ?? null,
                    'budget'      => $data['budget'] ?? null,
                ],
                'tasks' => $data['tasks'] ?? [],
                'needs_task_suggestions' => !$hasUserTasks,  // explicit hint
            ], JSON_UNESCAPED_UNICODE)
        ];

        $messages = [$system, $context, ...$data['messages']];

        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post(
            rtrim(env('OPENAI_BASE', 'https://api.openai.com/v1'), '/') . '/chat/completions',
            [
                'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
                'messages' => $messages,
                'temperature' => 0.2,
                'response_format' => ['type' => 'json_object'],
            ]
        );

        if (!$res->ok()) {
            return response()->json([
                'error' => 'AI request failed',
                'details' => $res->json()
            ], $res->status());
        }

        $content = $res->json('choices.0.message.content'); // JSON string
        return response()->json(['assistant' => $content]);
    })->name('ai.call');
});


Route::get('/contacts-directory', [ContactDirectoryController::class, 'index'])->name('contacts.directory');
Route::get('/contacts-directory/export', [ContactDirectoryController::class, 'export'])->name('contacts.directory.export');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // *** [@Project] Application Section ***
    Route::prefix('/project')
        ->middleware('auth')
        ->group(function () {
            Route::group([], function () {
                Route::get('/list', [ProjectBiddingController::class, 'index']);
                Route::get('/list/register', [ProjectBiddingController::class, 'register']);
                Route::get('/list/details/{project_id}', [BidController::class, 'details'])->name('bids.index');

                Route::get('/listx', [ContactController::class, 'index']);
                Route::get('/new', [ProjectBiddingController::class, 'registration']);
                Route::get('/edit/{id}', [ProjectBiddingController::class, 'edit']);
                Route::post('/store', [ProjectBiddingController::class, 'store'])->name('project.store');
                Route::post('/update/{id}', [GoogleDriveController::class, 'update_project'])->name('project-bidding.update');

                Route::post('/stage/file/remove', [GoogleDriveController::class, 'remove_scope_file'])->name('stage.file.update');
                Route::post('/file/remove', [GoogleDriveController::class, 'remove_proj_file'])->name('project.file.update');
            });
        });

    // *** [@Relationship] Application Section *** // Added Relationship section
    Route::prefix('/relationship')
        ->middleware('auth')
        ->group(function () {
            Route::get('/list', [ContactController::class, 'index']);
            Route::get('/list/contacts/{id}', [ContactController::class, 'create_contacts']);
            Route::get('/list/register', [ContactController::class, 'create_company']);
            Route::get('/create', [ContactController::class, 'create_company']); // TEMP
            Route::get('/list/edit/{company}/{id}', [ContactController::class, 'edit_contact_details']);
            Route::get('/list/details/{id}', [ContactController::class, 'company_details']);

            Route::get('/clients', [ContactController::class, 'index']);

            Route::post('/store', [ContactController::class, 'store'])->name('contact.create');
            Route::post('/update/{id}', [ContactController::class, 'update'])->name('contact.update');

            Route::post('/api/contacts', [ContactController::class, 'getClients'])->name('api.relationship.contacts');
            Route::post('/api/projects', [ContactController::class, 'getProjects'])->name('api.relationship.projects');

            Route::post('/api/company/contacts', [ContactController::class, 'getContacts'])->name('project.relationship.contacts');

            Route::post('/data/contact/store', [ContactController::class, 'store_contact'])->name('relationship.contact.store');
            Route::post('/data/contact/update/{id}', [ContactController::class, 'update_contact'])->name('relationship.contact.update');

            Route::get('/clients', [ContactController::class, 'clients']);
            Route::get('/client/data', [ContactController::class, 'getClients'])->name('relationship.contacts');

            Route::get('/company/data', [ContactController::class, 'getCompany'])->name('relationship.company');
            Route::get('/company/data/subscriber', [ContactController::class, 'getCompanySubscriber'])->name('relationship.company.subscriber');

            Route::get('/person/list/{id}', [ContactController::class, 'person_index']);
            Route::get('/person/create', [ContactController::class, 'person_create']);
            Route::get('/{company_id}/person/new', function ($company_id) {
                //return view('pages.contacts.forms.new_client', compact('company_id'));
            });

            Route::post('/xyz', [ContactController::class, 'endpoint'])->name('contacts');
            Route::post('/clients/delete', [ContactController::class, 'deleteClients'])->name('clients.delete');
            Route::post('/person/store', [ContactController::class, 'person_store'])->name('contact-persons.store');
        });

    // *** [@CRM] Application Section *** // Added CRM section
    Route::prefix('/crm')
        ->middleware('auth')
        ->group(function () {

            Route::get('/manage', [Calendar::class, 'index'])->name('crm.manage');


            Route::get('/lead/facebook/create', [FacebookLeadController::class, 'create'])->name('lead.facebook');
            Route::get('/lead/facebook', [FacebookLeadController::class, 'index'])->name('lead.facebook.list');

            Route::get('/lead/demo/{link}', [FacebookLeadController::class, 'leads_x'])->name('lead.facebook.list');
            // Route::get('/lead/tiktok', [FacebookLeadController::class, 'index'])->name('lead.tiktok.list');
            // Route::get('/lead/instagram', [FacebookLeadController::class, 'index'])->name('lead.instagram.list');
            // Route::get('/lead/linkedin', [FacebookLeadController::class, 'index'])->name('lead.linkedin.list');
            // Route::get('/lead/youtube', [FacebookLeadController::class, 'index'])->name('lead.youtube.list');

            Route::get('/lead/generic', [FacebookLeadController::class, 'generic'])->name('lead.generic.list');
            Route::post('/lead/generic/update', [FacebookLeadController::class, 'updateCell'])->name('generic.update');

            Route::get('/profit/tracker', [ProjectProfitTrackerController::class, 'generic'])->name('profit.tracker.list');
            Route::post('/profit/tracker/update', [ProjectProfitTrackerController::class, 'updateCell'])->name('profit.update');

            Route::post('/lead/facebook/data', [FacebookLeadController::class, 'list'])->name('lead.facebook.data');
            Route::post('/lead/facebook/store', [FacebookLeadController::class, 'store'])->name('lead.facebook.store');
        });
});


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/chats/conversations/{conversation}/schedule/events',           [ScheduleController::class, 'index']);
    Route::post('/chats/conversations/{conversation}/schedule/events',           [ScheduleController::class, 'store']);
    Route::put('/chats/conversations/{conversation}/schedule/events/{event}',   [ScheduleController::class, 'update']);
    Route::delete('/chats/conversations/{conversation}/schedule/events/{event}',   [ScheduleController::class, 'destroy']);

    Route::get('kanban', [ScheduleController::class, 'kanban']);             // kanban feed
    Route::patch('events/{event}/type', [ScheduleController::class, 'updateType']); // DnD type change
});

use App\Http\Controllers\VAAssignmentController;

Route::middleware(['auth'])->group(function () {

    // Page + data endpoint
    Route::get('/va/assignments',            [VAAssignmentController::class, 'index'])->name('va.assignments.index');
    Route::get('/va/assignments/fetch',      [VAAssignmentController::class, 'fetch'])->name('va.assignments.fetch'); // <-- static FIRST

    // Modal API (bind only numeric ids)
    Route::get   ('/va/assignments/{user}',          [VAAssignmentController::class, 'show'])
        ->whereNumber('user')->name('va.assignments.show');
    Route::post  ('/va/assignments/{user}',          [VAAssignmentController::class, 'store'])
        ->whereNumber('user')->name('va.assignments.store');
    Route::delete('/va/assignments/{user}/{vaId}',   [VAAssignmentController::class, 'destroy'])
        ->whereNumber('user')->whereNumber('vaId')->name('va.assignments.destroy');

    // VA self-view
    Route::get('/va/my-clients', [VAAssignmentController::class, 'myClients'])->name('va.my_clients');
});
