@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.sitemap')" />


    <div class="content-box">


     <div class="content__item">
        <div class="card">
            <div class="card-body-row">
                <x-admin.link-btn href="{{ route('home') . '/sitemap.xml' }}" target="_blank" class="btn btn-show">

                                
                    {{__('Show sitemap')}}

                            
                </x-admin.link-btn>
                                            
                <x-admin.link-btn href="{{ route('admin.sitemap.create') }}" target="_blank" class="btn btn-add">

                    {{__('Create sitemap')}}

                </x-admin.link-btn>
            </div>
        </div>
     </div>



       


    </div>


</div>

@endsection