@extends('admin.layouts.base')




@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.reviews')" />



    <div class="content-box">

        <div class="content-box-top">



            <x-admin.link href="{{ route('admin.reviews.index') }}" class="admin-link">

                <svg class="admin-link-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>


                <span>

                    {{__('admin.button.back')}}

                </span>

            </x-admin.link>

        </div>



        <div class="content__item">
            <div class="card">

                <h3 class="card__title title-h3">

                    {{__('admin.title.reviews-create')}}

                </h3>

                <div class="card-body">


                    <x-admin.errors />

                    <x-admin.form action="{{ route('admin.reviews.store') }}" method="POST" class="card-form">


                        <div class="card-body__group">

                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.name')}} </x-admin.label>

                                <x-admin.input name="name" style="max-width: 300px" />

                            </x-admin.form-item>

                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.surname') }} </x-admin.label>

                                <x-admin.input name="surname" style="max-width: 300px" />

                            </x-admin.form-item>
                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.rating') . ' ( 1 - 5 )' }} </x-admin.label>

                                <x-admin.input name="rating" type="number" style="max-width: 300px" />

                            </x-admin.form-item>


                            <div class="card-body__group summernote-editor">
                                <x-admin.form-item>
                                    <x-admin.label> {{__('admin.label.text')}}
                                    </x-admin.label>
                                    <x-admin.summernote name="text"></x-admin.summernote>                                
                                </x-admin.form-item>
                            </div>

                        </div>




                        <div class="buttons-box">

                            <x-admin.button type="submit" class="btn-create">

                                {{ __('admin.button.create') }}

                            </x-admin.button>

                        </div>



                    </x-admin.form>


                </div>

            </div>

        </div>







    </div>


</div>



@endsection