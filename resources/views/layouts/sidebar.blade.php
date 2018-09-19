<div class="col-md-4 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Pending Jobs</span>
        <span class="badge badge-secondary badge-pill">{{ count($jobs) }}</span>
    </h4>
    <ul class="list-group mb-3">
        @if (count($jobs) == 0)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">No jobs pending.</h6>
                </div>
            </li>
        @endif

        @foreach ($jobs as $job)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">Job #{{ $job->id }}</h6>
                    <small class="text-muted">{{ $job->created_at->toDayDateTimeString() }}</small>
                </div>
                <span class="text-muted">{{ $job->attempts }}</span>
            </li>
        @endforeach
    </ul>
</div>