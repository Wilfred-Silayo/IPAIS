@extends('layout')
@section('title','Found Items')
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
            <h4 class="text-success">Found Items</h3>
        </div>
        <div class="col">
            <form class="d-flex" action="{{ route('search.found.items') }}" method="GET">
                <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>

</div>

@if ($foundItems->isEmpty())
<div class="alert alert-info mt-1">
    No items found. <a class="ms-2" href="{{ route('dashboard') }}">Go To Dashboard</a>
</div>
@else
<div class="row mt-3">
    @foreach($foundItems as $foundItem)
    <div class="col-md-6 mb-4">
        <div class="card">
            <div id="carouselExampleControls{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($foundItem->images as $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('storage/lostItem_images/' . $image->path) }}" class="d-block " alt="..."
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
                <h5 class="card-title">{{ $foundItem->name }}</h5>
                <p class="card-text text-truncate">{{ $foundItem->description }}</p>
                <p class="card-text"><small class="text-muted">Time Reported:
                        {{ $foundItem->created_at->format('M d, Y H:i') }}</small></p>
                <p class="card-text"><small class="text-muted">Category: {{ $foundItem->category }}</small></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <!-- Add edit button -->
                        <a href="#" class="btn btn btn-outline-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#viewfoundItemModal{{ $foundItem->id }}"
                            data-lost-item="{{ json_encode($foundItem) }}">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View foundItem Modal -->
    <div class="modal fade" id="viewfoundItemModal{{ $foundItem->id }}" tabindex="-1"
        aria-labelledby="viewfoundItemModalLabel{{ $foundItem->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewfoundItemModalLabel{{ $foundItem->id }}">View a foundItem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Carousel for images -->
                    <div id="carouselfoundItemImages{{ $foundItem->id }}" class="carousel slide"
                        data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($foundItem->images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/lostItem_images/' . $image->path) }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselfoundItemImages{{ $foundItem->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselfoundItemImages{{ $foundItem->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- Lost Item Details -->
                    <div class="mt-3">
                        <h5>{{ $foundItem->name }}</h5>
                        <p>{{ $foundItem->description }}</p>
                        <p>Time Reported: {{ $foundItem->created_at->format('M d, Y H:i') }}</p>
                        <p>Category: {{ $foundItem->category }}</p>
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
{{ $foundItems->links('paginationlinks') }}

@endsection

<script>
const viewButtons = document.querySelectorAll('.btn-view-lost-item');

viewButtons.forEach(button => {
    button.addEventListener('click', () => {
        const foundItem = JSON.parse(button.getAttribute('data-lost-item'));
        const modal = document.getElementById(`viewfoundItemModal${foundItem.id}`);
        const carousel = modal.querySelector('.carousel-inner');

        // Clear previous images
        carousel.innerHTML = '';

        // Populate carousel with images
        foundItem.images.forEach((image, index) => {
            const carouselItem = document.createElement('div');
            carouselItem.classList.add('carousel-item');
            if (index === 0) {
                carouselItem.classList.add('active');
            }
            const imageElement = document.createElement('img');
            imageElement.src = `/storage/lostItem_images/${image.path}`;
            imageElement.classList.add('d-block', 'w-50');
            carouselItem.appendChild(imageElement);
            carousel.appendChild(carouselItem);
        });

        // Populate other details
        modal.querySelector('.lost-item-name').textContent = foundItem.name;
        modal.querySelector('.lost-item-description').textContent = foundItem.description;
        modal.querySelector('.lost-item-category').textContent = foundItem.category;
        modal.querySelector('.lost-item-time').textContent = `Time Reported: ${foundItem.created_at}`;
    });
});
</script>