
    <!-- Modal component blade -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                </div>
                <div class="modal-body">
                    {{$body}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-4" data-bs-dismiss="modal">No</button>
                    <form action="{{ route($routeName) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-info">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
