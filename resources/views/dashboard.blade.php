<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

    <div class="container-xl ">
     
<!-- 
        <div class="card shadow-sm">
            <div class="card-header text-dark">
            <div class="col-md-4">
            <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal">
                    Add new task
                </a>
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <h1 class="mb-0">Kanban</h1>
                </div>
            </div>
        </div> -->
       
    </div>
</x-app-layout>

<div class="modal modal-blur fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="title">TITLE:</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">DESCRIPTION:</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">FILE:</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">ASSIGN TO:</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                
                            <div class="form-group mb-3">
                                <label for="description">ASSIGN TO:</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>

                            <div class="mb-3">
                            <label class="form-label">STATUS</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="pending"  selected>PENDING</option>
                                <option value="ongoing"  selected>ONGOING</option>
                                <option value="done"  selected>DONE</option>
                            </select>
                    </div>
                        </div>

                      
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        Add new ship
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
