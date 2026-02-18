@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.blog')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('admin.title.list-posts')}}

                </h3>


                <x-admin.link-btn href="{{ route('admin.posts.create') }}" class="btn btn-add">

                    {{__('admin.button.add')}}

                </x-admin.link-btn>

            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">id</div>
                    <div class="table-body__col">title</div>
                    <div class="table-body__col">slug</div>
                    <div class="table-body__col" style="max-width: 100px">published</div>
                    <div class="table-body__col" style="max-width: 120px">created</div>
                    <div class="table-body__col" style="max-width: 120px">updated</div>

                    <div class="table-body__col table-body__col-actions" style="min-width: 240px">actions</div>

                </div>


                @foreach ($posts as $post)

                <div class="table-body__row @if(!$post->published){{ __('no-published') }}@endif">
                    <div class="table-body__col">{{ $post->id }}</div>
                    <div class="table-body__col">{{ $post->title }}</div>
                    <div class="table-body__col">{{ $post->slug }}</div>
                    <div class="table-body__col" style="max-width: 100px">{{ $post->published ? 'true': 'false'}}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $post->created_at->format('d-m-Y') }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $post->updated_at->format('d-m-Y') }}</div>


                    <div class="table-body__col table-body__col-actions" style="min-width: 240px">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-show">

                                {{__('Show')}}

                            </x-admin.link-btn>

                            <x-admin.link-btn href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-edit">

                                {{__('Edit')}}

                            </x-admin.link-btn>

                            @if (hasRole('superadmin') )

                            <x-admin.button class="btn btn-delete btn-modal-delete"
                                data-action="{{ route('admin.posts.destroy', $post->id) }}" data-name="{{ $post->title }}">

                                {{__('Delete')}}

                            </x-admin.button>

                            @endif

                        </div>

                    </div>


                </div>


                @endforeach

            </div>

            {{-- ? pagination --}}
            @if (method_exists($posts, 'links'))

            <div class="pagination-box">
                {{ $posts->links() }}
            </div>

            @endif

        </div>



        {{-- ? modal delete --}}
        <x-admin.modal-delete></x-admin.modal-delete>


    </div>


</div>

@endsection