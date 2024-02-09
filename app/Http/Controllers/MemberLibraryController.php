<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberLibrary;

class MemberLibraryController extends Controller
{
    # this is for dashboard
    public function member_library()
    {
        return view('admin.member_library');
    }
    
    public function index()
    {
        $members = MemberLibrary::all();
        return view('admin.member_library', ['members' => $members]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:member_libraries',
            'logo' => 'required|file|max:10240', // Ensure 'logo' is the correct field name
        ]);

        // Check if file is present in the request
        if ($request->hasFile('logo')) {
            // Handle file upload
            $file = $request->file('logo');
            // Use a unique name for the file
            $fileName = uniqid().'.'.$file->getClientOriginalExtension();
            // Move the file to the desired directory
            $file->move(public_path('uploads'), $fileName);

            // Create MemberLibrary instance
            MemberLibrary::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'description' => $request->input('description'),
                'link' => $request->input('link'),
                'status' => 1,
                'image_logo' => $fileName,
            ]);

            // Return success response
            return response()->json(['success' => 'Member created successfully!']);
        } else {
            // Return error response if file is not provided
            return response()->json(['error' => 'The logo field is required.'], 400);
        }
    }

    public function edit(MemberLibrary $member)
    {
        return response()->json(['member' => $member]);
    }

    public function update(Request $request, MemberLibrary $member)
    {
        try {
            $request->validate([
                'edit_name' => 'required|string',
                'edit_email' => 'required|email',
            ]);

            $member->update([
                'name' => $request->input('edit_name'),
                'email' => $request->input('edit_email'),
                'description' => $request->input('edit_description'),
                'link' => $request->input('edit_link'),
                'status' => $request->input('edit_status'),
            ]);

            // Optionally, you can return a success response
            return response()->json(['success' => 'Member updated successfully']);
        } catch (\Exception $e) {
            info("Error updating member: " . $e->getMessage());
            return response()->json(['error' => 'Error updating member.']);
        }
    }

    public function destroy(MemberLibrary $member)
    {
        $member->delete();
        return response()->json(['success' => 'Member deleted successfully!']);
    }
}
