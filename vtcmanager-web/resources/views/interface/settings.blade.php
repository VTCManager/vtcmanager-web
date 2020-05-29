@extends('layouts.interface')

@section('content')
<div class="modal fade" id="new-client-key" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.create_client_key') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('create-client-key') }}" method="post">
          @csrf
        <div class="modal-body">
            <p class="text-danger">{{ __('settings.create_client_key_ip_warning') }}</p>
            <p>{{ __('settings.create_client_key_your_ip') }}: {{Request::ip()}}</p>
            <input class="form-control text-white" name="description" maxlength="255" type="text" placeholder="Beschreibung">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
<h1>Einstellungen</h1>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
      <a class="nav-item nav-link" id="api-tab" data-toggle="tab" href="#client-page" role="tab" aria-controls="client-page" aria-selected="false">{{ __('settings.client') }}</a>
      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
    <div class="tab-pane fade" id="client-page" role="tabpanel" aria-labelledby="client-tab">
        <table class="table text-white">
            <thead>
              <tr>
                <th scope="col">{{ __('settings.client_api_key_name') }}</th>
                <th scope="col">{{ __('settings.client_api_key_created_at') }}</th>
                <th scope="col">{{ __('settings.client_api_key_key') }}</th>
                <th scope="col">{{ __('settings.client_api_key_ip') }}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($client_keys as $client_key)
                  <tr>
                    <td>{{$client_key->description}}</td>
                    <td>{{$client_key->created_at}}</td>
                    <td>{{$client_key->key}}</td>
                    <td>
                      <form action="{{ route('delete-client-key', ['key' => $client_key->key])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">{{ __('settings.delete') }}</button>
                      </form>
                  </tr>
              @endforeach
            </tbody>
        </table>
        <div class="float-right">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#new-client-key">{{ __('settings.create_client_key') }}</button>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
  </div>
@endsection
