@extends('layouts.interface')

@section('content')
<div class="modal fade" id="job-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{ __('logbook.general') }}</a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">{{ __('logbook.costs') }}</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('logbook.truck') }}</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<h1>{{ Auth::user()->name }}{{ __('logbook.title') }}</h1>

<table class="table text-white">
    <thead>
      <tr>
        <th scope="col">{{ __('logbook.origin') }}</th>
        <th scope="col">{{ __('logbook.destination') }}</th>
        <th scope="col">{{ __('logbook.cargo') }}</th>
        <th scope="col">{{ __('logbook.status') }}</th>
        <th scope="col">{{ __('logbook.started_date') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($jobs as $job)
        <tr>
            <td class="align-middle">{{$job->origin}}</td>
            <td class="align-middle">{{$job->destination}}</td>
            <td class="align-middle">{{$job->cargo}}</td>
            <td class="align-middle">
                @if ($job->started)
                    <i class="fas fa-truck"></i> {{ __('logbook.started') }}
                @elseif ($job->canceled)
                    <i class="fas fa-times-circle" style="color:orange;"></i> {{ __('logbook.canceled') }}
                @elseif ($job->finished)
                    <i class="fas fa-warehouse"></i> {{ __('logbook.finished') }}
                @elseif ($job->accepted)
                    <i class="fas fa-check-circle" style="color: green"></i> {{ __('logbook.accepted') }}
                @elseif ($job->declined)
                    <i class="fas fa-times-circle" style="color:red;"></i> {{ __('logbook.declined') }}
                 @elseif ($job->pending_verification)
                    <i class="fas fa-clock"></i> {{ __('logbook.pending_verification') }}
                @endif
            </td>
            <td class="align-middle">{{$job->created_at->format("d.m.Y H:i")}}</td>
            <td class="align-middle"><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#job-details">{{ __('logbook.details') }}</button></td>
          </tr>
        @endforeach
    </tbody>
</table>
@if ($jobs->isempty())
    <h3 class="text-center">{{ __('logbook.no_tour_found') }}</h3>
@endif
@endsection