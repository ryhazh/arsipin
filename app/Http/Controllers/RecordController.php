<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Record::query();
        $currentUser = auth()?->user();

        // Filter by month
        $month = $request->get('month', now()->format('Y-m'));
        if ($month) {
            $query->whereYear('borrowed_at', substr($month, 0, 4))
                  ->whereMonth('borrowed_at', substr($month, 5, 2));
        }

        $records = $query->paginate(5)->withQueryString();
        $books = Book::all();
        $users = User::all();
        
        return view('librarian.records.index', compact('records', 'books', 'users', 'currentUser', 'month'));
    }

    public function requests(Request $request) {
        $requests = Record::where('is_approved', false)->paginate(5);
        $currentUser = auth()?->user();
        $books = Book::all();
        $users = User::all();
        return view('librarian.records.request', compact('requests', 'books', 'users', 'currentUser'));
    }

    public function userRequests(Request $request) {
        $requests = Record::where('user_id', auth()->id())->where('is_approved', false)->paginate(5);
        $currentUser = auth()?->user();
        $books = Book::all();
        $users = User::all();
        return view('user.request', compact('requests', 'books', 'users', 'currentUser'));
    }

    public function userBorrowed(Request $request) {
        $borrowed = Record::where('user_id', auth()->id())->where('is_approved', true)->whereNull('returned_at')->paginate(5);
        $currentUser = auth()?->user();
        $books = Book::all();

        return view('user.borrowed', compact('borrowed', 'books', 'currentUser'));
    }

    public function approve(Request $request, $id)
    {
        try {
            $record = Record::findOrFail($id);
            $record->update([
               'is_approved' => true,
            ]);
            return redirect()->back()->with('success', 'Record approved successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('error_title', 'Approve Failed')
                ->with('error_message', 'Failed to approve the record. '. $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $record = Record::findOrFail($id);
            $record->delete();
            return redirect()->back()->with('success', 'Record rejected and deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('error_title', 'Reject Failed')
                ->with('error_message', 'Failed to reject the record. '. $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'book_id' => 'required|exists:books,id',
                'user_id' => 'required|exists:users,id',
                'due_date' => 'required|date|after:today',
                'quantity' => 'required|integer|min:1',
                'reason' => 'required|string',
            ]);

            Record::create([
                'book_id' => $request->book_id,
                'user_id' => $request->user_id,
                'borrowed_at' => now(),
                'due_date' => $request->due_date,
                'quantity' => $request->quantity,
                'reason' => $request->reason,
                'is_approved' => true,
            ]);

            return redirect()->back()->with('success', 'Book borrowed successfully.');
            
        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('error_title', 'Borrow Failed')
                ->with('error_message', 'Failed to borrow the book. ' . $e->getMessage());
        }
    }

    public function borrow(Request $request)
    {
        try {
            $request->validate([
                'book_id' => 'required|exists:books,id',
                'due_date' => 'required|date|after:today',
                'quantity' => 'required|integer|min:1',
                'reason' => 'required|string',
            ]);

            Record::create([
                'book_id' => $request->book_id,
                'user_id' => auth()->id(),
                'borrowed_at' => now(),
                'due_date' => $request->due_date,
                'quantity' => $request->quantity,
                'reason' => $request->reason,
                'is_approved' => false,
            ]);

            return redirect()->back()->with('success', 'Book borrowed successfully.');
            
        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('error_title', 'Borrow Failed')
                ->with('error_message', 'Failed to borrow the book. ' . $e->getMessage());
        }
    }

    public function return (Request $request, $id)
    {
        try {
            $record = Record::findOrFail($id);
            $record->update([
                'returned_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Book returned successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('error_title', 'Return Failed')
                ->with('error_message', 'Failed to return the book. '. $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $record = Record::findOrFail($id);
            $request->validate([
                'book_id' => 'required|exists:books,id',
                'user_id' => 'required|exists:users,id',
                'due_date' => 'required|date',
                'quantity' => 'required|integer|min:1',
                'reason' => 'required|string',
            ]);

            $updateData = [
                'book_id' => $request->book_id,
                'user_id' => $request->user_id,
                'due_date' => $request->due_date,
                'quantity' => $request->quantity,
                'reason' => $request->reason,
                'returned_at' => $request->has('returned') ? now() : null,
            ];

            $record->update($updateData);
            return redirect()->back()->with('success', 'Record updated successfully.');

        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('error_title', 'Update Failed')
                ->with('error_message', 'Failed to update the record. '. $e->getMessage());
        }
    }

    
}
