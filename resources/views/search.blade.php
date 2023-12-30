<!-- resources/views/search.blade.php -->
@extends('layouts.app')

@section('title', 'Search Books')

@section('content')
    <h1>Search Books</h1>

    <form id="search-form">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" placeholder="Enter search term">
        <button type="submit">Search</button>
    </form>

    <div id="search-results">
        <!-- Display search results here -->
    </div>

    <script>
        document.getElementById('search-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const searchTerm = document.getElementById('search').value;

            fetch(`/api/search?search=${searchTerm}`)
                .then(response => response.json())
                .then(data => {
                    displaySearchResults(data.books);
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        });

        function displaySearchResults(books) {
            const searchResultsContainer = document.getElementById('search-results');
            searchResultsContainer.innerHTML = '';

            if (books.length > 0) {
                const ul = document.createElement('ul');
                books.forEach(book => {
                    const li = document.createElement('li');
                    li.textContent = `${book.title} by ${book.author}`;
                    ul.appendChild(li);
                });
                searchResultsContainer.appendChild(ul);
            } else {
                searchResultsContainer.textContent = 'No results found.';
            }
        }
    </script>
@endsection
