@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.administrators')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('admin.title.list-administrators')}}

                </h3>


                <x-admin.link-btn href="{{ route('administrators.create') }}" class="btn btn-add">

                    {{__('admin.button.add')}}

                </x-admin.link-btn>

            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">id</div>
                    <div class="table-body__col">login</div>
                    <div class="table-body__col">role</div>

                    <div class="table-body__col table-body__col-actions">actions</div>

                </div>


                @foreach ($admins as $admin)

                <div class="table-body__row">
                    <div class="table-body__col">{{ $admin->id }}</div>
                    <div class="table-body__col">{{ $admin->login }}</div>
                    <div class="table-body__col">{{ $admin->role }}</div>


                    <div class="table-body__col table-body__col-actions">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('administrators.edit', $admin->id) }}" class="btn btn-edit">

                                {{__('Edit')}}

                            </x-admin.link-btn>

                            @if (Auth::guard('admin')->user()->id != $admin->id )

                            <x-admin.button class="btn btn-delete btn-modal-delete"
                                data-action="{{ route('administrators.destroy', $admin->id) }}" data-name="{{ $admin->login }}">

                                {{__('Delete')}}

                            </x-admin.button>
                            @endif

                        </div>

                    </div>


                </div>


                @endforeach

            </div>


        </div>

        {{-- ? pagination --}}
        {{-- <div class="pagination-box">
            {{ $admins->links() }}
        </div> --}}


        {{-- ? modal delete --}}
        <x-admin.modal-delete></x-admin.modal-delete>


    </div>


</div>

@endsection