@section('title', 'CRM - Delegates Detail')
<div class="tab-pane active" id="pills-delegates" role="tabpanel" aria-labelledby="pills-delegates-tab">
    <div class="delegates">
        <div class="row">

            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <ol class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Name</div>
                                {{ $training_course->name }}
                                {{ $training_course->last_name }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Email</div>
                                {{ $training_course->email ?? '-' }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Company</div>
                                {{ $training_course->company ?? '-' }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Address</div>
                                {{ $training_course->address ?? '-' }}
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <ol class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Phone</div>
                                {{ $training_course->phone_number ?? '-' }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Date of Birth</div>
                                {{ $training_course->birth_date ?? '-' }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Birth Place</div>
                                {{ $training_course->birth_place ?? '-' }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Gender</div>
                                {{ $training_course->gender ?? '-' }}
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
