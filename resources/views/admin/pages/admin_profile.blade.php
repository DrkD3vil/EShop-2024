@extends('admin.admin_layout')
@section('admin')
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">


        <!-- peast -->
        <section style="background-color: #eee;">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">User</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Admin Profile</h4>
                                <button id="profileEditButton" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                            <div class="card-body text-center">
                                <!-- Profile Picture -->
                                <img src="{{ asset('storage/' . $adminData->image) }}"
                                    alt="Admin Profile" class="rounded-circle img-fluid" style="width: 150px;">


                                <!-- User Info -->
                                <h5 class="my-3" id="usernameDisplay">{{ $adminData->username ?? 'Guest' }}</h5>
                                <input type="text" name="username" id="usernameInput" class="form-control d-none" value="{{ $adminData->username }}">

                                <p class="text-muted mb-1" id="jobTitleDisplay">Full Stack Developer</p>
                                <input type="text" name="job_title" id="jobTitleInput" class="form-control d-none" value="Full Stack Developer">

                                <p class="text-muted mb-4" id="locationDisplay">Bay Area, San Francisco, CA</p>
                                <input type="text" name="location" id="locationInput" class="form-control d-none" value="Bay Area, San Francisco, CA">

                                <!-- Follow and Message Buttons -->
                                <div class="d-flex justify-content-center mb-2">
                                    <button type="button" class="btn btn-primary">Follow</button>
                                    <button type="button" class="btn btn-outline-primary ms-1">Message</button>
                                </div>
                            </div>
                            <!-- Update Form -->
                            <form id="profileUpdateForm" action="{{ route('admin.update', $adminData->id) }}" method="POST" enctype="multipart/form-data" class="d-none">
                                @csrf
                                @method('PUT')

                                <!-- Profile Picture -->
                                <div class="mb-3">
                                    <label for="imageInput">Profile Image</label>
                                    <input type="file" name="image" id="imageInput" class="form-control">
                                </div>

                                <!-- Preview Profile Picture -->

                                <img src="{{ asset('storage/' . $adminData->image) }}" id="previewImage"
                                    alt="Admin Profile" class="rounded-circle img-fluid" style="width: 150px;">

                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="usernameInput">Username</label>
                                    <input type="text" name="username" id="usernameInput" class="form-control" value="{{ $adminData->username }}">
                                </div>
                                <!-- Save & Cancel Buttons -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" id="profileCancelButton" class="btn btn-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>



                        <div class="card mb-4 mb-lg-0">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fas fa-globe fa-lg text-warning"></i>
                                        <p class="mb-0">https://mdbootstrap.com</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-github fa-lg text-body"></i>
                                        <p class="mb-0">mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                        <p class="mb-0">@mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                        <p class="mb-0">mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                        <p class="mb-0">mdbootstrap</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">User Details</h4>
                                <button id="detailsEditButton" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                            <div class="card-body">
                                <form id="detailsForm" action="{{ route('admin.update', $adminData->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Full Name -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="nameDisplay">{{ $adminData->name ?? 'N/A' }}</p>
                                            <input type="text" name="name" id="nameInput" class="form-control d-none" value="{{ $adminData->name }}">
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="emailDisplay">{{ $adminData->email ?? 'N/A' }}</p>
                                            <input type="email" name="email" id="emailInput" class="form-control d-none" value="{{ $adminData->email }}">
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="phoneDisplay">{{ $adminData->phone ?? 'N/A' }}</p>
                                            <input type="text" name="phone" id="phoneInput" class="form-control d-none" value="{{ $adminData->phone }}">
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="addressDisplay">{{ $adminData->address ?? 'N/A' }}</p>
                                            <textarea name="address" id="addressInput" class="form-control d-none">{{ $adminData->address }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Save & Cancel Buttons -->
                                    <div class="text-end d-none" id="detailsButtons">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <button type="button" id="detailsCancelButton" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                        </p>
                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                        <div class="progress rounded mb-2" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                        </p>
                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                        <div class="progress rounded mb-2" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>






    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Profile Edit
        const profileEditButton = document.getElementById('profileEditButton');
        const profileCancelButton = document.getElementById('profileCancelButton');
        const profileUpdateForm = document.getElementById('profileUpdateForm');

        profileEditButton.addEventListener('click', () => {
            toggleVisibility(profileUpdateForm, profileEditButton);
        });

        profileCancelButton.addEventListener('click', () => {
            toggleVisibility(profileEditButton, profileUpdateForm);
        });

        // Details Edit
        const detailsEditButton = document.getElementById('detailsEditButton');
        const detailsCancelButton = document.getElementById('detailsCancelButton');
        const detailsForm = document.getElementById('detailsForm');
        const displayFields = {
            name: document.getElementById('nameDisplay'),
            email: document.getElementById('emailDisplay'),
            phone: document.getElementById('phoneDisplay'),
            address: document.getElementById('addressDisplay'),
        };
        const inputFields = {
            name: document.getElementById('nameInput'),
            email: document.getElementById('emailInput'),
            phone: document.getElementById('phoneInput'),
            address: document.getElementById('addressInput'),
        };

        detailsEditButton.addEventListener('click', () => {
            for (const key in displayFields) {
                toggleVisibility(inputFields[key], displayFields[key]);
            }
            toggleVisibility(detailsButtons, detailsEditButton);
        });

        detailsCancelButton.addEventListener('click', () => {
            for (const key in displayFields) {
                toggleVisibility(displayFields[key], inputFields[key]);
            }
            toggleVisibility(detailsEditButton, detailsButtons);
        });

        function toggleVisibility(show, hide) {
            show.classList.remove('d-none');
            hide.classList.add('d-none');
        }
    });
</script>

<!-- For Preview Images -->
<script>
    $(document).ready(function() {
        $('#imageInput').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection