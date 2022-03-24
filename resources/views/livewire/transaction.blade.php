@section('title', 'Manage Transactions')
<div>
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Transactions List
                <br>
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.transaction.create') }}'">
                    <i class="bx bx-plus"></i> Create Transactions
                </button>
                <button class="mt-1 btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filter"
                    aria-expanded="false" aria-controls="filter">
                    Filter
                </button>
                <div class="collapse" id="filter">
                    <div class="card card-body">
                        <form wire:submit.prevent>
                            <div class="mb-2">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">-</option>
                                    <option value="paid">Paid</option>
                                    <option value="waiting">Waiting</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <button class="btn btn-primary"><i class="bx bx-filter"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Invoice Code</th>
                                <th>Payment Status</th>
                                <th>Subcription</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->customer->name }}</td>
                                    <td>{{ $transaction->invoice }}</td>
                                    <td>
                                        @if ($transaction->payment_status == 'paid')
                                            <span
                                                class="badge bg-label-success me-1">{{ $transaction->payment_status }}</span>
                                        @elseif ($transaction->payment_status == 'waiting')
                                            <span
                                                class="badge bg-label-warning me-1">{{ $transaction->payment_status }}</span>
                                        @else
                                            <span
                                                class="badge bg-label-danger me-1">{{ $transaction->payment_status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $transaction->customer->subcription->name }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->updated_at }}</td>
                                    <td class="text-center">
                                        {{-- <button class="btn btn-primary"
                                            onclick="location.href='{{ route('owner.transaction.show', $transaction->id) }}'">
                                            <i class="bx bx-detail"></i>
                                        </button>
                                        <button class="btn btn-info"
                                            onclick="location.href='{{ route('owner.transaction.edit', $transaction->id) }}'"><i
                                                class="bx bx-edit"></i>
                                        </button>
                                        <form action="{{ route('owner.transaction.delete', $transaction->id) }}"
                                            method="post" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bx bx-trash"></i></button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@push('scripts')
    <script src="{{ asset('assets/vendor/datatable/datatables.min.js') }}"></script>
    <script>
        $("#table").DataTable({
            "aaSorting": []
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatable/datatables.min.css') }}">
@endpush
