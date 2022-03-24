@section('title', 'Edit Transaction')
<div>
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                Edit Transaction
                <br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button class="mt-1 btn btn-primary" onclick="location.href='{{ route('owner.transaction') }}'">
                    <i class="bx bx-arrow-back"></i>
                </button>
            </div>
            <div class="card-body">
                <form class="mb-3" wire:submit.prevent='update' method="POST" id="edit"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="id_customer" class="form-label">Customer Name:</label><br>
                        <button class="btn btn-primary" wire:click='guestMode'
                            type="button">{{ $notGuest == false ? 'Mark as Customer' : 'Mark as Guest' }}</button>
                        @if ($notGuest)
                            <select name="id_customer" id="id_customer" wire:model='id_customer'
                                class="form-select mt-3">
                                <option value="">-</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @if ($subcription)
                                <select disabled class="form-select mt-3">
                                    <option>{{ $subcription }}</option>
                                </select>
                                <p class="text-muted mt-2">Discount: {{ $discount }}</p>
                                @if ($notSupported)
                                    <div class="alert alert-warning">Upgrade advised: <a
                                            href="{{ route('owner.customers.edit', $id_customer) }}">Click here</a>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="invoice" class="form-label">Invoice</label><br>
                        <button class="btn btn-sm badge rounded-pill bg-primary" type="button"
                            wire:click="generate">Auto
                            Generate</button>
                        <input type="text" name="invoice" wire:model="invoice" class="form-control mt-2">
                    </div>

                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Payment Status</label>
                        <select name="payment_status" id="payment_status" class="form-select"
                            wire:model="payment_status">
                            <option value="">-</option>
                            <option value="paid">Paid</option>
                            <option value="waiting">Waiting</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#menu">
                            Open Menu
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" wire:ignore.self id="menu" tabindex="-1" role="dialog"
                            aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Menu List</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($menus as $menu)
                                            <div class="card">
                                                <div class="card-header">
                                                    <img src="{{ asset('storage/menu/' . $menu->photo) }}"
                                                        class="img-fluid"
                                                        style="max-width: 200px;max-height:200px;">
                                                </div>
                                                <div class="card-body">
                                                    <input type="number" class="form-control"
                                                        placeholder="{{ $menu->name }} Quantity"
                                                        wire:model='qty.{{ $menu->id }}'>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            wire:click='caculate'>Done</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($total)
                            <div class="alert alert-primary mt-3">Total Price: <b>{{ number_format($total) }}</b>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit" form="edit">
                    <i class="bx bx-paper-plane"></i> Edit
                </button>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@push('styles')
    @livewireStyles
@endpush
@push('scripts')
    @livewireScripts
@endpush
