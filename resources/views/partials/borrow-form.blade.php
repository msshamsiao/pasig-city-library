<!-- Partial for the borrow form -->
<form id="borrowForm" action="{{ route('borrow') }}" method="post">
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
        <input type="text" class="form-control" id="school" name="school" required>
        {{-- dynamic values --}}
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
