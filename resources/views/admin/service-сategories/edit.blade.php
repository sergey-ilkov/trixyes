@extends('admin.layouts.base')




@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.service-categories')" />



    <div class="content-box">

        <div class="content-box-top">



            <x-admin.link href="{{ route('admin.service-categories.index') }}" class="admin-link">

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

                    {{__('admin.title.service-categories-edit')}}

                </h3>

                <div class="card-body">


                    <x-admin.errors />

                    <x-admin.form action="{{ route('admin.service-categories.update', $category->id) }}" method="PUT" class="card-form">


                        <div class="card-body__group">



                             @foreach ($languages as $language )

                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.name') }} ({{ $language->code }}) </x-admin.label>

                                @if ($errors->has('name.' . $language->code))

                                    <x-admin.input name="name[{{ $language->code }}]" class="input-error" 
                                        
                                        value="{{ old('name.' . $language->code) ? : $category->getTranslation('name', $language->code) }}"
                                         
                                        />
                                
                                @else

                             
                                    <x-admin.input name="name[{{ $language->code }}]" 
                                        
                                        value="{{ old('name.' . $language->code) ? : $category->getTranslation('name', $language->code) }}"
                                        
                                        />

                                @endif
                                

                            </x-admin.form-item>
                                
                            @endforeach

                            @foreach ($languages as $language )

                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.title') }} ({{ $language->code }}) </x-admin.label>

                                @if ($errors->has('title.' . $language->code))

                                    <x-admin.input name="title[{{ $language->code }}]" class="input-error" 

                                        value="{{ old('title.' . $language->code) ? : $category->getTranslation('name', $language->code) }}"

                                        />
                                
                                @else

                             
                                    <x-admin.input name="title[{{ $language->code }}]" 
                                        value="{{ old('title.' . $language->code) ? : $category->getTranslation('name', $language->code) }}"

                                        />

                                @endif
                                

                            </x-admin.form-item>
                                
                            @endforeach



                            @foreach ($languages as $language)
                     
                            <div class="card-body__group summernote-editor">
                                <x-admin.form-item>
                                    <x-admin.label> {{__('admin.label.desc')}} ({{ $language->code }}) </x-admin.label>
                                
                                    @if ($errors->has('description.' . $language->code))

                                    <textarea name="description[{{ $language->code }}]" class="summernote textarea-error">

                                      
                                        {{ old('description.' . $language->code) ? : $category->getTranslation('description', $language->code) }}

                                    </textarea>

                                    @else

                                    <textarea name="description[{{ $language->code }}]" class="summernote">

                                     
                                        {{ old('description.' . $language->code) ? : $category->getTranslation('description', $language->code) }}

                                    </textarea>

                                    @endif

                                </x-admin.form-item>
                            </div>
                                                
                            @endforeach










                            {{-- <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.name')}} </x-admin.label>

                                <x-admin.input name="name" value="{{ $category->name }}" style="max-width: 300px" />

                            </x-admin.form-item> --}}






                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.slug') }} <span style="color: #DC2626">( not change )</span> </x-admin.label>

                                <x-admin.input name="slug" value="{{ $category->slug }}" style="max-width: 300px" />

                            </x-admin.form-item>




                        </div>




                        <div class="buttons-box">

                            <x-admin.button type="submit" class="btn-create">

                                {{ __('admin.button.update') }}

                            </x-admin.button>

                        </div>



                    </x-admin.form>


                </div>

            </div>

        </div>







    </div>


</div>

<x-admin.css-script-summernote class="css-script-summernote"/>

@endsection