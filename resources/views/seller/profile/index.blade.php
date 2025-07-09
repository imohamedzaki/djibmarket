@extends('layouts.app.seller')
@section('title', 'Seller Profile')

@section('content')
    {{-- Breadcrumb --}}
    <x-breadcrumb.wrapper>
        <x-breadcrumb.single title="Dashboard" type="first" link="{{ route('seller.dashboard') }}" />
        <x-breadcrumb.single title="Profile" />
    </x-breadcrumb.wrapper>

    {{-- Pending Status Alert --}}
    @include('includes.seller-pending-alert')


    <div class="nk-block">
        {{-- Profile Header Card --}}
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                <div class="nk-profile-content">
                    {{-- Cover Image --}}
                    <div class="nk-profile-cover shadow-sm"
                        style="
                            position: relative;
                            overflow: hidden;
                            @if ($seller->cover_image) background-image: url('{{ asset($seller->cover_image) }}');
                            @else
                                background-color: #f0f2f5; /* Light grey background */ @endif
                            height: 240px; /* Increased height to 240px */
                            background-size: cover;
                            background-position: center;
                            border-radius: .25rem;
                         ">
                        <div
                            style="
                            position: absolute;
                            bottom: 0;
                            left: 0;
                            right: 0;
                            height: 60px;
                            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
                        ">
                        </div>
                    </div>

                    <div class="nk-profile-avatar-wrapper"
                        style="margin-top: -60px; /* Adjusted margin for 240px cover height */ margin-left: 20px; position: relative;">
                        {{-- Square Avatar or Placeholder --}}
                        <div class="nk-profile-avatar">
                            @if ($seller->avatar)
                                <img class="rounded shadow-sm" src="{{ asset($seller->avatar) }}" alt="Avatar"
                                    style="width: 120px; height: 120px; border: 3px solid #fff; object-fit: cover;">
                            @else
                                @php
                                    $nameParts = explode(' ', trim($seller->name));
                                    $initials =
                                        count($nameParts) > 1
                                            ? strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1))
                                            : strtoupper(substr($nameParts[0] ?? '', 0, 2));
                                @endphp
                                {{-- Placeholder with initials --}}
                                <div class="rounded shadow-sm d-flex align-items-center justify-content-center"
                                    style="width: 120px; height: 120px; background-color: #e5e7eb; color: #4b5563; font-size: 1.5rem; font-weight: 600; border: 3px solid #fff;">
                                    {{ $initials }}
                                </div>
                            @endif
                        </div>
                        {{-- Seller Name (Optional, could be placed differently) --}}
                        <div class="nk-profile-name" style="margin-top: 10px; margin-left: 100px;">
                            <h4 class="title">{{ $seller->name }}</h4>
                            <span class="text-soft">{{ $seller->email }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- End Profile Header Card --}}

        <div class="card mt-4">
            <div class="card-inner">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Personal Information</h5>
                    @if ($seller->status === 'pending')
                        <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Profile editing is only available when your seller application has been accepted">
                            <button class="btn btn-sm btn-secondary" disabled>
                                <i class="fas fa-lock me-1"></i>Edit Profile (Locked)
                            </button>
                        </span>
                    @else
                        <a href="{{ route('seller.profile.edit') }}" class="btn btn-sm btn-primary">Edit Profile</a>
                    @endif
                </div>
                {{-- Basic form structure - Add form tag and CSRF for updates --}}
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $seller->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $seller->email }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $seller->phone }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $seller->address }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="business_activity">Business Activity</label>
                            {{-- Assuming you have a way to fetch the name from business_activity_id --}}
                            <input type="text" class="form-control" id="business_activity" name="business_activity"
                                value="{{ $seller->business_activity_id }}" readonly>
                        </div>
                    </div>
                    {{-- Add Update button if making this editable --}}
                    {{-- <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div> --}}
                </div>
                {{-- End form structure --}}
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-inner">
                <h5 class="card-title">Uploaded Documents</h5>
                @if ($seller->documents->isEmpty())
                    <p>No documents uploaded yet.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Document Type</th>
                                <th>File</th>
                                <th>Expiry Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seller->documents as $document)
                                <tr>
                                    <td>{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</td>
                                    <td>
                                        <span class="text-muted">{{ basename($document->document_path) }}</span>
                                    </td>
                                    <td>{{ $document->expiry_date ? \Carbon\Carbon::parse($document->expiry_date)->format('Y-m-d') : 'N/A' }}
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary view-document-btn"
                                                data-document-id="{{ $document->id }}"
                                                data-document-type="{{ $document->document_type }}"
                                                data-document-name="{{ basename($document->document_path) }}"
                                                data-document-url="{{ route('seller.documents.view', $document) }}"
                                                title="View Document">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <a href="{{ route('seller.documents.download', $document) }}"
                                                class="btn btn-sm btn-outline-success" title="Download Document">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                {{-- Add form for uploading new documents here if needed --}}
            </div>
        </div>
    </div>

    {{-- Document Viewer Modal --}}
    <div class="modal fade" id="documentViewerModal" tabindex="-1" aria-labelledby="documentViewerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentViewerModalLabel">Document Viewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div id="documentViewerContent" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="downloadFromModal" class="btn btn-success">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Handle view document button clicks
            document.querySelectorAll('.view-document-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const documentId = this.getAttribute('data-document-id');
                    const documentType = this.getAttribute('data-document-type');
                    const documentName = this.getAttribute('data-document-name');
                    const documentUrl = this.getAttribute('data-document-url');

                    // Update modal title
                    document.getElementById('documentViewerModalLabel').textContent =
                        `${documentType.charAt(0).toUpperCase() + documentType.slice(1).replace('_', ' ')} - ${documentName}`;

                    // Update download link
                    const downloadBtn = document.getElementById('downloadFromModal');
                    downloadBtn.href = documentUrl.replace('/view', '/download');

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById(
                        'documentViewerModal'));
                    modal.show();

                    // Load document content
                    loadDocumentContent(documentUrl, documentName);
                });
            });

            function loadDocumentContent(documentUrl, documentName) {
                const contentDiv = document.getElementById('documentViewerContent');

                // Show loading spinner
                contentDiv.innerHTML = `
            <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

                // Get file extension
                const fileExtension = documentName.split('.').pop().toLowerCase();

                if (fileExtension === 'pdf') {
                    // For PDF files, use an iframe
                    contentDiv.innerHTML = `
                <iframe src="${documentUrl}" 
                        width="100%" 
                        height="600" 
                        style="border: none;">
                    <p>Your browser does not support PDFs. 
                       <a href="${documentUrl}" target="_blank">Download the PDF</a>.
                    </p>
                </iframe>
            `;
                } else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                    // For image files, use an img tag
                    contentDiv.innerHTML = `
                <img src="${documentUrl}" 
                     class="img-fluid" 
                     alt="${documentName}"
                     style="max-height: 600px; object-fit: contain;">
            `;
                } else {
                    // For other file types, show a message
                    contentDiv.innerHTML = `
                <div class="alert alert-info m-3">
                    <h6>Document Preview Not Available</h6>
                    <p>This document type cannot be previewed in the browser. Please download the file to view it.</p>
                    <a href="${documentUrl.replace('/view', '/download')}" class="btn btn-primary">
                        <i class="fas fa-download"></i> Download Document
                    </a>
                </div>
            `;
                }
            }
        });
    </script>
@endpush
