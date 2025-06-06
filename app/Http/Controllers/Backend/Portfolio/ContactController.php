<?php

namespace App\Http\Controllers\Backend\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Portfolio\Contact;
use App\Models\User;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(private readonly PortfolioService $portfolioService)
    {
    }

    /**
     * Display a listing of the contacts.
     */
    public function index()
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.view']);

        $user = User::first();
        $contacts = $this->portfolioService->getContacts($user);

        return view('backend.portfolio.contacts.index', compact('contacts'));
    }

    /**
     * Display the contact.
     */
    public function show(Contact $contact)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.view']);

        // Mark as read if not already
        if (!$contact->read) {
            $this->portfolioService->markContactAsRead($contact);
        }

        return view('backend.portfolio.contacts.show', compact('contact'));
    }

    /**
     * Remove the contact.
     */
    public function destroy(Contact $contact)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.delete']);

        $this->portfolioService->deleteContact($contact);

        return redirect()->route('admin.portfolio.contacts.index')
            ->with('success', __('Contact deleted successfully.'));
    }
}
