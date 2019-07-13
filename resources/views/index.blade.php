@extends('layouts.base')
@section('main')
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading" style="font-weight: 300;">Welcome!</h1>
            <p class="lead text-muted">
                My passion for web designing is like addiction to Video Games. <br>I push myself to learn and to finish every websites that I make.
            </p>
            <p>
                <a href="{{ url('/sendemail') }}" class="btn btn-outline-secondary">Email Me</a>
            </p>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                {{--<div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>--}}
                @forelse($data as $key => $projects)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <center>
                                <img src="{{ url('/') }}/images/project_images/{{ $projects->ProjectImage }}" width="100%" height="100%" style="max-height: 300px; max-width: 300px;" class="card-img img-fluid" alt="{{ $projects->ProjectImages }}">
                            </center>
                            <div class="card-body">
                                <p class="card-text">{{ $projects->ProjectName }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#view_{{ $projects->id }}">View</button>
                                    </div>
                                    <small class="text-muted">{{ $projects->updated_at }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="display-3">
                            <center>No Data Found</center>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@foreach($data as $modalData)
    <div id="view_{{ $modalData->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content mb-4 shadow-sm">
                <div class="modal-header">
                    <div class="modal-title">{{ $modalData->ProjectName }}</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <center>
                    <img src="{{ url('/') }}/images/project_images/{{ $modalData->ProjectImage }}" width="100%" height="100%" style="max-height: 200px; max-width: 200px;" class="card-img img-fluid" alt="{{ $projects->ProjectImages }}">
                </center>
                <div class="modal-body">
                    <p class="card-text">{{ $modalData->ProjectDescription }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Date Created: {{ $modalData->updated_at }}</small>
                    </div>
                    <small class="text-muted">Author: {{ $modalData->ProjectAuthor }}</small>
                    <br>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <a href="{{ $projects->ProjectLink }}" class="btn btn-sm btn-outline-secondary">Download</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
