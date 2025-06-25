@extends('layouts.app')

@section('content')
<div class="container-fluid uix-dashboard">
    <div class="row">
        <div class="col-12">
            <h2 class="fw-bold mb-1">AI Models</h2>
            <div class="text-muted mb-4">Access powerful AI models and manage your usage</div>
            <div class="card uix-card mb-4 p-4 d-flex flex-row align-items-center gap-3">
                <div class="uix-balance-icon bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
                    <i class="bi bi-cash-stack text-success fs-2"></i>
                </div>
                <div>
                    <div class="text-muted small">AI Balance</div>
                    <div class="fs-3 fw-bold">$0.00</div>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-key me-1"></i> Add API Key</button>
                    <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add Credit</button>
                </div>
            </div>
            <div class="card uix-card mb-4">
                <ul class="nav nav-tabs px-3 pt-3 border-0">
                    <li class="nav-item"><a class="nav-link" href="#">Quick Start</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Usage</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Models</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">API Keys</a></li>
                </ul>
                <div class="table-responsive p-3">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>MODEL</th>
                                <th>PROVIDER</th>
                                <th>CONTEXT LENGTH</th>
                                <th>INPUT PRICE</th>
                                <th>OUTPUT PRICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>text-embedding-ada-002</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success">openai</span></td>
                                <td>8,191</td>
                                <td>$0.1000000<br><span class="small text-muted">/1M tokens</span></td>
                                <td>$0.00<br><span class="small text-muted">/1M tokens</span></td>
                            </tr>
                            <tr>
                                <td>text-embedding-3-small</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success">openai</span></td>
                                <td>8,191</td>
                                <td>$0.0200000<br><span class="small text-muted">/1M tokens</span></td>
                                <td>$0.00<br><span class="small text-muted">/1M tokens</span></td>
                            </tr>
                            <tr>
                                <td>gpt-4o-mini-tts</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success">openai</span></td>
                                <td>0</td>
                                <td>$2.5000000<br><span class="small text-muted">/1M tokens</span></td>
                                <td>$10.0000000<br><span class="small text-muted">/1M tokens</span></td>
                            </tr>
                            <tr>
                                <td>whisper-1</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success">openai</span></td>
                                <td>0</td>
                                <td>$0.00<br><span class="small text-muted">/1M tokens</span></td>
                                <td>$0.00<br><span class="small text-muted">/1M tokens</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 