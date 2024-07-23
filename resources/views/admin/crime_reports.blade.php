@extends('layout')
@section('title','Coincidences')
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
            <h4 class="text-success">Coincidences</h3>
        </div>
        <div class="col">
            <form class="d-flex" action="{{ route('admin.search.crime') }}" method="GET">
                <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    @if ($crimes->isEmpty())
    <div class="alert alert-info show fade alert-dismissible" role="alert">
        Sorry, currently there is no Coincidences reports!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @else
    <div class="row mt-3">
        @foreach($crimes as $crime)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div id="carouselExampleControls{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($crime->images as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('storage/crime_images/' . $image->path) }}" class="d-block" alt="..."
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
                    <h5 class="card-title">{{ $crime->name }}</h5>
                    <p class="card-text text-truncate">{{ $crime->description }}</p>
                    <p class="card-text"><small class="text-muted">Time Reported:
                            {{ $crime->created_at->format('M d, Y H:i') }}</small></p>
                    <p class="card-text"><small class="text-muted">Category: {{ $crime->category }}</small></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <!-- Add edit button -->
                            <a href="#" class="btn btn btn-outline-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#viewcrimeModal{{ $crime->id }}"
                                data-lost-item="{{ json_encode($crime) }}">View</a>
                            <a href="#" class="btn btn btn-outline-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#commentcrimeModal{{ $crime->id }}"
                                data-coincidence="{{ json_encode($crime) }}">Message Reporter</a>
                            <form action="{{route('admin.crime.resolve',$crime->id)}}" method="POST" class="p-0 m-0">
                                @csrf
                                <button class="btn btn btn-outline-primary me-3" type="submit">
                                    @if($crime->is_resolved)
                                    Mark as Unsolved
                                    @else
                                    Mark as Solved
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment Lost Item Modal -->
        <div class="modal fade" id="commentcrimeModal{{ $crime->id }}" tabindex="-1"
            aria-labelledby="deletecrimeModalLabel{{ $crime->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletecrimeModalLabel{{ $crime->id }}">
                            Message reporter of "{{ $crime->name }}"
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Write your message
                        </p>
                        <form action="{{ route('notifications.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{$crime->user->username}}">
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
        <div class="modal fade" id="viewcrimeModal{{ $crime->id }}" tabindex="-1"
            aria-labelledby="viewcrimeModalLabel{{ $crime->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewcrimeModalLabel{{ $crime->id }}">View Lost Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Carousel for images -->
                        <div id="carouselcrimeImages{{ $crime->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($crime->images as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('storage/crime_images/' . $image->path) }}" class="d-block w-100"
                                        alt="...">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselcrimeImages{{ $crime->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselcrimeImages{{ $crime->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Lost Item Details -->
                        <div class="mt-3">
                            <h5>{{ $crime->name }}</h5>
                            <p>{{ $crime->description }}</p>
                            <p>Time Reported: {{ $crime->created_at->format('M d, Y H:i') }}</p>
                            <p>Category: {{ $crime->category }}</p>
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
    {{ $crimes->links('paginationlinks') }}
</div>
@endsection


<script>
const viewButtons = document.querySelectorAll('.btn-view-coincidence');

viewButtons.forEach(button => {
    button.addEventListener('click', () => {
        const crime = JSON.parse(button.getAttribute('data-coincidence'));
        const modal = document.getElementById(`viewcrimeModal${crime.id}`);
        const carousel = modal.querySelector('.carousel-inner');

        // Clear previous images
        carousel.innerHTML = '';

        // Populate carousel with images
        crime.images.forEach((image, index) => {
            const carouselItem = document.createElement('div');
            carouselItem.classList.add('carousel-item');
            if (index === 0) {
                carouselItem.classList.add('active');
            }
            const imageElement = document.createElement('img');
            imageElement.src = `/storage/crime_images/${image.path}`;
            imageElement.classList.add('d-block', 'w-50');
            carouselItem.appendChild(imageElement);
            carousel.appendChild(carouselItem);
        });

        // Populate other details
        modal.querySelector('.coincidence-name').textContent = crime.name;
        modal.querySelector('.coincidence-description').textContent = crime.description;
        modal.querySelector('.coincidence-category').textContent = crime.category;
        modal.querySelector('.coincidence-time').textContent = `Time Reported: ${crime.created_at}`;
    });
});
</script>