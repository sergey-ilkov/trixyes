@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.reviews')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('admin.title.list-reviews')}}

                </h3>


                <x-admin.link-btn href="{{ route('admin.reviews.create') }}" class="btn btn-add">

                    {{__('admin.button.add')}}

                </x-admin.link-btn>

            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">id</div>
                    <div class="table-body__col">name</div>
                    <div class="table-body__col">surname</div>
                    <div class="table-body__col" style="max-width: 50px">rating</div>
                    <div class="table-body__col" style="max-width: 120px">created</div>
                    <div class="table-body__col" style="max-width: 120px">updated</div>

                    <div class="table-body__col table-body__col-actions">actions</div>

                </div>


                @foreach ($reviews as $review)

                <div class="table-body__row">
                    <div class="table-body__col">{{ $review->id }}</div>
                    <div class="table-body__col">{{ $review->name }}</div>
                    <div class="table-body__col">{{ $review->surname }}</div>
                    <div class="table-body__col" style="max-width: 50px">{{ $review->rating }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $review->created_at->format('d-m-Y') }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $review->updated_at->format('d-m-Y') }}</div>


                    <div class="table-body__col table-body__col-actions">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-edit">

                                {{__('Edit')}}

                            </x-admin.link-btn>

                            @if (hasRole('superadmin'))

                            <x-admin.button class="btn btn-delete btn-modal-delete"
                                data-action="{{ route('admin.reviews.destroy', $review->id) }}"
                                data-name="{{ $review->id . ' ' . $review->name }}">

                                {{__('Delete')}}

                            </x-admin.button>
                            @endif

                        </div>

                    </div>


                </div>


                @endforeach

            </div>


            {{-- ? pagination --}}
            @if (method_exists($reviews, 'links'))

            <div class="pagination-box">
                {{ $reviews->links() }}
            </div>

            @endif

        </div>



        {{-- ? modal delete --}}
        <x-admin.modal-delete></x-admin.modal-delete>


    </div>


</div>

@endsection