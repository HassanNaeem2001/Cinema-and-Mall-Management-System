@extends('admin.layout')

@section('admincontent')

{{-- ================= STYLES ================= --}}
<style>
.page-link {
    background-color: #222;
    color: #fff;
    border-color: #444;
}
.page-item.active .page-link {
    background-color: grey;
    border-color: white;
}
.page-link:hover {
    background-color: black;
    color: white;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<div class="content-wrapper">
    <h3>All Movies</h3>

    {{-- ================= TOAST ================= --}}
    @if(session('Successmsg'))
    <script>
        Toastify({
            text: "This movie is now featured successfully!",
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            style: {
                background: "linear-gradient(to right, #28e417, #3b5c03)",
            },
        }).showToast();
    </script>
    @endif

    <hr>

    {{-- ================= TABLE ================= --}}
    <div class="table-responsive">
        <table class="table table-dark table-bordered text-center table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Thumbnail</th>
                    <th>Movie Name</th>
                    <th>Category</th>
                    <th>Premier Date</th>
                    <th>Featured</th>
                    <th>Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach($movies as $movie)
                <tr>
                    <td>{{ $movies->firstItem() + $loop->index }}</td>

                    <td>
                        <img src="{{ asset('thumbnails/'.$movie->thumbnail) }}" width="300">
                    </td>

                    <td>{{ $movie->moviename }}</td>
                    <td>{{ $movie->categoryname }}</td>
                    <td>{{ date('d-F-Y', strtotime($movie->premierdate)) }}</td>

                    <td>
                        @if($movie->isfeatured === 'yes')
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                    </td>

                    <td>
                        <div class="d-flex justify-content-center">

                            <a href="{{ url('admin/editmovie/'.$movie->id) }}"
                               class="btn btn-primary mx-1">
                                Edit
                            </a>

                            <button
                                type="button"
                                class="btn btn-warning mx-1"
                                data-bs-toggle="modal"
                                data-bs-target="#featureModal"
                                data-movie-id="{{ $movie->id }}"
                            >
                                Feature Movie
                            </button>

                            <form action="{{ url('admin/deletemovie/'.$movie->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mx-1"
                                    onclick="return confirm('Delete this movie?')">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {!! $movies->links() !!}
        </div>
    </div>
</div>

{{-- ================= MODAL (ONLY ONE) ================= --}}
<div class="modal fade" id="featureModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content bg-dark text-white">

            <div class="modal-header">
                <h5 class="modal-title">Feature Movie</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>
                    Movie ID:
                    <strong id="movieIdText"></strong>
                </p>

                <form method="POST" action="{{ url('admin/feature-movie') }}">
                    @csrf

                    <input type="hidden" name="movie_id" id="movieIdInput">

                    <select name="cinema_id"
                            class="form-control bg-dark text-white mt-3">
                        <option value="">Select Cinema</option>
                        {{-- Add cinemas here --}}
                    </select>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- ================= SCRIPTS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
document.getElementById('featureModal')
    .addEventListener('show.bs.modal', function (event) {

    let button = event.relatedTarget;
    let movieId = button.getAttribute('data-movie-id');

    document.getElementById('movieIdText').innerText = movieId;
    document.getElementById('movieIdInput').value = movieId;
});
</script>

@endsection
