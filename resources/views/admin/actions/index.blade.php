@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.actions')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('admin.title.list-actions')}}

                </h3>


                <x-admin.link-btn href="{{ route('admin.actions.create') }}" class="btn btn-add">

                    {{__('admin.button.add')}}

                </x-admin.link-btn>

            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">id</div>
                    <div class="table-body__col">name</div>
                    <div class="table-body__col" style="max-width: 200px">slug</div>
                    <div class="table-body__col" style="max-width: 120px">date</div>

                    <div class="table-body__col table-body__col-actions">actions</div>

                </div>


                @foreach ($actions as $action)

                <div class="table-body__row">
                    <div class="table-body__col">{{ $action->id }}</div>
                    <div class="table-body__col">{{ $action->name }}</div>
                    <div class="table-body__col" style="max-width: 200px">{{ $action->slug }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $action->created_at->format('d-m-Y') }}</div>


                    <div class="table-body__col table-body__col-actions">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('admin.actions.edit', $action->id) }}" class="btn btn-edit">

                                {{__('Edit')}}

                            </x-admin.link-btn>

                            {{-- @if (hasRole('superadmin'))

                            <x-admin.button class="btn btn-delete btn-modal-delete"
                                data-action="{{ route('admin.actions.destroy', $action->id) }}"
                                data-name="{{ $action->id . ' ' . $action->name }}">

                                {{__('Delete')}}

                            </x-admin.button>
                            @endif --}}

                        </div>

                    </div>


                </div>


                @endforeach

            </div>


            {{-- ? pagination --}}
            @if (method_exists($actions, 'links'))

            <div class="pagination-box">
                {{ $actions->links() }}
            </div>

            @endif

        </div>



        {{-- ? modal delete --}}
        {{-- <x-admin.modal-delete></x-admin.modal-delete> --}}


    </div>


</div>

@endsection