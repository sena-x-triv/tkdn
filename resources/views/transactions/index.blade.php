@extends('layouts.app')

@section('content')
<div class="container-fluid uix-dashboard">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <div class="card uix-card shadow-sm mb-4">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs uix-tabs px-3 pt-3 border-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="transactions-tab" data-bs-toggle="tab" data-bs-target="#transactions" type="button" role="tab">
                                <i class="bi bi-credit-card me-1"></i> Transactions
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab">
                                <i class="bi bi-wallet2 me-1"></i> Payments
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade show active" id="transactions" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table uix-table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase small fw-bold text-secondary">Date</th>
                                            <th class="text-uppercase small fw-bold text-secondary">Description</th>
                                            <th class="text-uppercase small fw-bold text-secondary">Type</th>
                                            <th class="text-uppercase small fw-bold text-secondary text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>5/22/2025</td>
                                            <td>Service purchase: wablas (monthly)</td>
                                            <td>
                                                <span class="d-inline-flex align-items-center text-danger fw-semibold">
                                                    <i class="bi bi-arrow-down-circle me-1"></i> Usage
                                                </span>
                                            </td>
                                            <td class="text-end text-danger fw-bold">Rp 0 credits</td>
                                        </tr>
                                        <tr>
                                            <td>5/22/2025</td>
                                            <td>Welcome bonus credits</td>
                                            <td>
                                                <span class="d-inline-flex align-items-center text-success fw-semibold">
                                                    <i class="bi bi-gift-fill me-1"></i> Bonus
                                                </span>
                                            </td>
                                            <td class="text-end text-success fw-bold">+Rp 1.000 credits</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payments" role="tabpanel">
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-wallet2 fs-1 mb-2"></i>
                                <div>No payments found.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 