@extends('layout')
@section('title','Welcome')
@section('content')
<div class="container-fluid">
    @session('error')
    <x-alert type="danger" session="error" />
    @endsession.
    @session('info')
    <x-alert type="info" session="info" />
    @endsession
    @session('success')
    <x-alert type="success" session="success" />
    @endsession

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 mb-4">
                <div class="card bg-light">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($lostItem->images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                @if($type==1)
                                <img src="{{ asset('storage/lostItem_images/' . $image->path) }}" class="d-block"
                                alt="..." height="200">
                                @else
                                <img src="{{ asset('storage/crime_images/' . $image->path) }}" class="d-block"
                                    alt="..." height="200">
                                @endif
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
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $lostItem->name }}</h5>
                        <p class="card-text text-truncate">{{ $lostItem->description }}</p>
                        <p class="card-text"><small class="text-muted">Time Reported:
                                {{ $lostItem->created_at->format('M d, Y H:i') }}</small></p>
                        <p class="card-text"><small class="text-muted">Category: {{ $lostItem->category }}</small></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-4">
                @if($comments->isEmpty())
                <div class="alert alert-info">
                    No comments found.
                </div>
                @else
                @foreach($comments as $comment)
                <div class="card mb-2">
                    <div class="card-header">
                        <img src="{{asset('storage/profile_images/' . $comment->user->profile_image) }}" alt="Profile"
                            class="rounded-circle" width="60">
                        <span class="ms-4 fw-bold">
                            {{$comment->user->first_name}}
                            {{$comment->user->last_name}}
                        </span>
                    </div>
                    <div class="card-body">
                        <p>{{$comment->content}}</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn btn-outline-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#commentlostItemModal{{ $lostItem->id }}"
                            data-coincidence="{{ json_encode($lostItem) }}">Message Commenter</a>
                    </div>
                </div>
                @endforeach
                {{ $comments->links('paginationlinks') }}

                @endif
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
                        Message commentor of "{{ $lostItem->user->first_name }} {{ $lostItem->user->last_name }}"
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
            modal.querySelector('.coincidence-time').textContent =
                `Time Reported: ${lostItem.created_at}`;
        });
    });
    </script>