@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.services')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('admin.title.list-services')}}

                </h3>


                <x-admin.link-btn href="{{ route('admin.services.create') }}" class="btn btn-add">

                    {{__('admin.button.add')}}

                </x-admin.link-btn>

            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">id</div>
                    <div class="table-body__col">name</div>

                    @foreach ($categories as $category)                    
                        <div class="table-body__col" style="max-width: 100px">{{ $category->slug }}</div>                        
                    @endforeach

                    <div class="table-body__col" style="max-width: 100px">published</div>
                    <div class="table-body__col" style="max-width: 120px">created</div>
                    <div class="table-body__col" style="max-width: 120px">updated</div>

                    <div class="table-body__col table-body__col-actions">actions</div>

                </div>


                @foreach ($services as $service)

                <div class="table-body__row @if(!$service->published){{ __('no-published') }}@endif">
                    <div class="table-body__col">{{ $service->id }}</div>
                    <div class="table-body__col">{{ $service->name }}</div>

                    @foreach ($service->serviceCategories as $category)                    
                        <div class="table-body__col" style="max-width: 100px">{{ $category->pivot->rating }}</div>                        
                    @endforeach

                    <div class="table-body__col" style="max-width: 100px">{{ $service->published ? 'true': 'false'}}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $service->created_at->format('d-m-Y') }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $service->updated_at->format('d-m-Y') }}</div>


                    <div class="table-body__col table-body__col-actions">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-edit">

                                {{__('Edit')}}

                            </x-admin.link-btn>

                            {{-- @if (hasRole('superadmin'))

                            <x-admin.button class="btn btn-delete btn-modal-delete"
                                data-services="{{ route('admin.services.destroy', $service->id) }}"
                                data-name="{{ $service->id . ' ' . $service->name }}">

                                {{__('Delete')}}

                            </x-admin.button>
                            @endif --}}

                        </div>

                    </div>


                </div>


                @endforeach

            </div>


            {{-- ? pagination --}}
            @if (method_exists($services, 'links'))

            <div class="pagination-box">
                {{ $services->links() }}
            </div>

            @endif

        </div>



        {{-- ? modal delete --}}
        {{-- <x-admin.modal-delete></x-admin.modal-delete> --}}


    </div>


</div>

@endsection