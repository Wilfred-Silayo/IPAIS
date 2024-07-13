@extends('layout')
@section('title','Most Wanted')
@section('content')
<div class="container">
    @session('error')
    <x-alert type="danger" session="error" />
    @endsession.
    @session('info')
    <x-alert type="info" session="info" />
    @endsession
    @session('success')
    <x-alert type="success" session="success" />
    @endsession
</div>

<div class="container bg-white shadow-sm py-2 mt-1">
    <div class="row justify-content-between">
        <div class="col">
            <h4 class="text-success">Most Wanted</h3>
        </div>
        <div class="col">
            <form class="d-flex" action="{{ route('search.most.wanted') }}" method="GET">
                <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>

</div>

@if ($mostWanted->isEmpty())
<div class="alert alert-info mt-1">
    No most wanted found. <a class="ms-2" href="{{ route('dashboard') }}">Go To Dashboard</a>
</div>
@else
<div class="row mt-3">
    @foreach($mostWanted as $mostwanted)
    <div class="col-md-6 mb-4">
        <div class="card">
            <div id="carouselExampleControls{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($mostwanted->images as $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('storage/mostwanted_images/' . $image->path) }}" class="d-block " alt="..."
                            height="200">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselExampleControls{{ $loop->index }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselExampleControls{{ $loop->index }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $mostwanted->name }}</h5>
                <p class="card-text text-truncate">{{ $mostwanted->description }}</p>
                <p class="card-text"><small class="text-muted">Time Reported:
                        {{ $mostwanted->created_at->format('M d, Y H:i') }}</small></p>
                <p class="card-text"><small class="text-muted">Category: {{ $mostwanted->category }}</small></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <!-- Add edit button -->
                        <a href="#" class="btn btn btn-outline-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#viewmostwantedModal{{ $mostwanted->id }}"
                            data-lost-item="{{ json_encode($mostwanted) }}">View</a>

                        <a href="#" class="btn btn btn-outline-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#commentmostwantedModal{{ $mostwanted->id }}"
                            data-coincidence="{{ json_encode($mostwanted) }}">Comment</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comment most wanted Modal -->
    <div class="modal fade" id="commentmostwantedModal{{ $mostwanted->id }}" tabindex="-1"
        aria-labelledby="deletemostwantedModalLabel{{ $mostwanted->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletemostwantedModalLabel{{ $mostwanted->id }}">
                        Comment on "{{ $mostwanted->name }}"
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please provide precise information about the coincidence</p>
                    <form action="{{ route('comment.store',$mostwanted->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->user()->username}}">
                        <textarea name="content" id="" class="col-12 form-control" rows="5" cols="60"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mt-2">send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View mostwanted Modal -->
    <div class="modal fade" id="viewmostwantedModal{{ $mostwanted->id }}" tabindex="-1"
        aria-labelledby="viewmostwantedModalLabel{{ $mostwanted->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewmostwantedModalLabel{{ $mostwanted->id }}">View a mostwanted</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Carousel for images -->
                    <div id="carouselmostwantedImages{{ $mostwanted->id }}" class="carousel slide"
                        data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($mostwanted->images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/mostwanted_images/' . $image->path) }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselmostwantedImages{{ $mostwanted->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselmostwantedImages{{ $mostwanted->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- Lost Item Details -->
                    <div class="mt-3">
                        <h5>{{ $mostwanted->name }}</h5>
                        <p>{{ $mostwanted->description }}</p>
                        <p>Time Reported: {{ $mostwanted->created_at->format('M d, Y H:i') }}</p>
                        <p>Category: {{ $mostwanted->category }}</p>
                        <!-- Add more details as needed -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
{{ $mostWanted->links('paginationlinks') }}

@endsection

<script>
const viewButtons = document.querySelectorAll('.btn-view-lost-item');

viewButtons.forEach(button => {
    button.addEventListener('click', () => {
        const mostwanted = JSON.parse(button.getAttribute('data-lost-item'));
        const modal = document.getElementById(`viewmostwantedModal${mostwanted.id}`);
        const carousel = modal.querySelector('.carousel-inner');

        // Clear previous images
        carousel.innerHTML = '';

        // Populate carousel with images
        mostwanted.images.forEach((image, index) => {
            const carouselItem = document.createElement('div');
            carouselItem.classList.add('carousel-item');
            if (index === 0) {
                carouselItem.classList.add('active');
            }
            const imageElement = document.createElement('img');
            imageElement.src = `/storage/mostwanted_images/${image.path}`;
            imageElement.classList.add('d-block', 'w-50');
            carouselItem.appendChild(imageElement);
            carousel.appendChild(carouselItem);
        });

        // Populate other details
        modal.querySelector('.lost-item-name').textContent = mostwanted.name;
        modal.querySelector('.lost-item-description').textContent = mostwanted.description;
        modal.querySelector('.lost-item-category').textContent = mostwanted.category;
        modal.querySelector('.lost-item-time').textContent = `Time Reported: ${mostwanted.created_at}`;
    });
});
</script>