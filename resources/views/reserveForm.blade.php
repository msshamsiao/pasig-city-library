<form id="borrowForm" action="{{ route('reserve', ['bookId' => $book->id]) }}" method="post">
    @csrf
    <input type="hidden" name="book_id" value="{{ $book->id ?? null }}">
    <!-- Other form fields go here -->
    <div class="mb-3">
        <label for="user_name" class="form-label">Your Name</label>
        <input type="text" class="form-control" id="user_name" name="user_name" required>
    </div>
    <div class="mb-3">
        <label for="user_email" class="form-label">Your Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email" required>
    </div>
    <div class="mb-3">
        <label for="school" class="form-label">Member Library</label>
        <select class="form-control" name="member_library" id="member_library" required>
            <option value="">All Member Libraries</option>
            @php
                $memberLibraries = \App\Models\MemberLibrary::get();
            @endphp
              @foreach($memberLibraries as $memberLibrary)
                  <option value="{{ $memberLibrary->id }}">{{ $memberLibrary->member_library_name }}</option>
              @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>