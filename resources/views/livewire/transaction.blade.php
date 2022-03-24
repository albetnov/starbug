@section('title', 'Manage Transactions')
<div>
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y" wire:ignore>
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
                    <table class="table" id="table" wire:ignore>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Invoice Code</th>
                                <th>Payment Status</th>
                                <th>Subcription</th>
                                <th>Price</th>
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
                                    <td>Rp. {{ number_format($transaction->price) }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->updated_at }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary"
                                            wire:click='showDetail({{ $transaction->id }})'>
                                            <i class="bx bx-detail"></i>
                                        </button>
                                        <button class="btn btn-info"
                                            onclick="location.href='{{ route('owner.transaction.edit', $transaction->id) }}'"><i
                                                class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" wire:click='delete({{ $transaction->id }})'
                                            class="btn btn-danger"><i class="bx bx-trash"></i></button>
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
    @if ($detailReady)
        <!-- Modal -->
        <div class="modal fade" wire:ignore.self id="showDetail" tabindex="-1" role="dialog"
            aria-labelledby="showDetailLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Details {{ $name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($details as $detail)
                            <div class="card m-3 shadow">
                                <div class="card-header">
                                    <h4>{{ $detail->menu->name }}</h4><br>
                                    <img src="{{ asset('storage/menu/' . $detail->menu->photo) }}"
                                        alt="{{ $detail->menu->name }}" style="max-width: 200px;max-height:200px"
                                        class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <h5>Quantity: {{ $detail->qty }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    @livewireScripts
    <script>
        Livewire.on('showDetail', () => {
            const myModal = new bootstrap.Modal(document.getElementById('showDetail'));
            myModal.toggle();
        });
    </script>
    <script src="{{ asset('assets/vendor/datatable/datatables.min.js') }}"></script>
    <script>
        $("#table").DataTable({
            "aaSorting": []
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatable/datatables.min.css') }}">
    @livewireStyles
@endpush
