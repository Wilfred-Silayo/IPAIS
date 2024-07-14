@extends('layout')
@section('title','Lost Items')
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

<div class="container m-1">
    <div class="row justify-content-between">
        <div class="col">
            <h4 class="text-success">Lost Items</h3>
        </div>
        <div class="col">
            <form class="d-flex" action="{{ route('officer.search.lost.item') }}" method="GET">
                <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    @if ($lostItems->isEmpty())
    <div class="alert alert-info show fade alert-dismissible" role="alert">
        Sorry, currently there is no Coincidences reports!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @else
    <div class="row mt-3">
        @foreach($lostItems as $lostItem)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div id="carouselExampleControls{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($lostItem->images as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('storage/lostItem_images/' . $image->path) }}" class="d-block" alt="..."
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
                    <h5 class="card-title">{{ $lostItem->name }}</h5>
                    <p class="card-text text-truncate">{{ $lostItem->description }}</p>
                    <p class="card-text"><small class="text-muted">Time Reported:
                            {{ $lostItem->created_at->format('M d, Y H:i') }}</small></p>
                    <p class="card-text"><small class="text-muted">Category: {{ $lostItem->category }}</small></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <!-- Add edit button -->
                            <a href="#" class="btn btn btn-outline-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#viewlostItemModal{{ $lostItem->id }}"
                                data-lost-item="{{ json_encode($lostItem) }}">View</a>
                            <a href="{{route('comments.list',$lostItem->id)}}"
                                class="btn btn btn-outline-primary me-3">Comments</a>
                            <a href="#" class="btn btn btn-outline-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#commentlostItemModal{{ $lostItem->id }}"
                                data-coincidence="{{ json_encode($lostItem) }}">Message Reporter</a>
                            <form action="{{route('lost.item.resolve',$lostItem->id)}}" method="POST" class="p-0 m-0">
                                @csrf
                                <button class="btn btn btn-outline-primary me-3" type="submit">
                                    @if($lostItem->is_found)
                                    Mark as UnFound
                                    @else
                                    Mark as Found
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment Lost Item Modal -->
        <div class="modal fade" id="commentlostItemModal{{ $lostItem->id }}" tabindex="-1"
            aria-labelledby="deletelostItemModalLabel{{ $lostItem->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletelostItemModalLabel{{ $lostItem->id }}">
                            Message reporter of "{{ $lostItem->name }}"
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Write your message
                        </p>
                        <form action="{{ route('notifications.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{$lostItem->user->username}}">
                            <input type="hidden" name="sender_id" value="{{auth()->user()->username}}">
                            <textarea name="content" id="" class="col-12 form-control" rows="5" cols="60"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mt-2">send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Lost Item Modal -->
        <div class="modal fade" id="viewlostItemModal{{ $lostItem->id }}" tabindex="-1"
            aria-labelledby="viewlostItemModalLabel{{ $lostItem->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewlostItemModalLabel{{ $lostItem->id }}">View Lost Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Carousel for images -->
                        <div id="carousellostItemImages{{ $lostItem->id }}" class="carousel slide"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($lostItem->images as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('storage/lostItem_images/' . $image->path) }}"
                                        class="d-block w-100" alt="...">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carousellostItemImages{{ $lostItem->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carousellostItemImages{{ $lostItem->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Lost Item Details -->
                        <div class="mt-3">
                            <h5>{{ $lostItem->name }}</h5>
                            <p>{{ $lostItem->description }}</p>
                            <p>Time Reported: {{ $lostItem->created_at->format('M d, Y H:i') }}</p>
                            <p>Category: {{ $lostItem->category }}</p>
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
    {{ $lostItems->links('paginationlinks') }}
</div>
@endsection


<script>
const viewButtons = document.querySelectorAll('.btn-view-coincidence');

viewButtons.forEach(button => {
    button.addEventListener('click', () => {
        const lostItem = JSON.parse(button.getAttribute('data-coincidence'));
        const modal = document.getElementById(`viewlostItemModal${lostItem.id}`);
        const carousel = modal.querySelector('.carousel-inner');

        // Clear previous images
        carousel.innerHTML = '';

        // Populate carousel with images
        lostItem.images.forEach((image, index) => {
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
        modal.querySelector('.coincidence-name').textContent = lostItem.name;
        modal.querySelector('.coincidence-description').textContent = lostItem.description;
        modal.querySelector('.coincidence-category').textContent = lostItem.category;
        modal.querySelector('.coincidence-time').textContent = `Time Reported: ${lostItem.created_at}`;
    });
});
</script>