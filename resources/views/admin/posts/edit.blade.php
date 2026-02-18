@extends('admin.layouts.base')




@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.blog')" />



    <div class="content-box">

        <div class="content-box-top">



            <x-admin.link href="{{ route('admin.posts.index') }}" class="admin-link">

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

                    {{__('admin.title.post-edit')}}

                </h3>

                <div class="card-body">


                    <x-admin.errors />

                    <x-admin.form action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data" method="PUT"
                        class="card-form">


                        <div class="card-body__group">


                            @foreach ($languages as $language )

                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.title') }} ({{ $language->code }}) </x-admin.label>

                                @if ($errors->has('title.' . $language->code))

                                <x-admin.input name="title[{{ $language->code }}]" class="input-error" 

                                    value="{{ old('title.' . $language->code) ? : $post->getTranslation('title', $language->code) }}"  
                                
                                    />
                                @else

                                <x-admin.input name="title[{{ $language->code }}]" 

                                    value="{{ old('title.' . $language->code) ? : $post->getTranslation('title', $language->code) }}"  

                                    />

                                @endif


                            </x-admin.form-item>
                                
                            @endforeach



                            @foreach ($languages as $language )

                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.slug') }} ({{ $language->code }}) </x-admin.label>

                                @if ($errors->has('slug.' . $language->code))

                                <x-admin.input name="slug[{{ $language->code }}]" class="input-error" 

                                    value="{{ old('slug.' . $language->code) ? : $post->getTranslation('slug', $language->code) }}"  
                                
                                    />
                                @else

                                <x-admin.input name="slug[{{ $language->code }}]" 

                                    value="{{ old('slug.' . $language->code) ? : $post->getTranslation('slug', $language->code) }}"  

                                    />

                                @endif


                            </x-admin.form-item>
                                
                            @endforeach



                      



                            {{-- <x-admin.form-item>

                                <x-admin.label class="label-group">
                                    {{ __('admin.label.slug') }}

                                    <span>
                                        <span>{{ __('admin.label.slug-url') }}</span>
                                        <span>{{ __('https://slugify.online') }}</span>
                                    </span>

                                </x-admin.label>

                                <x-admin.input name="slug" value="{{ $post->slug }}" />

                            </x-admin.form-item> --}}





                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.views') }} </x-admin.label>

                                <x-admin.input name="views" value="{{ $post->views }}" type="number" style="max-width: 200px" />

                            </x-admin.form-item>




                        </div>

                        @foreach ($languages as $language)
                     
                        <div class="card-body__group summernote-editor">
                            <x-admin.form-item>
                                <x-admin.label> {{__('admin.label.desc')}} ({{ $language->code }}) </x-admin.label>
                               
                                @if ($errors->has('description.' . $language->code))

                                <textarea name="description[{{ $language->code }}]" class="summernote textarea-error">
                                    {{ old('description.' . $language->code) ? : $post->getTranslation('description', $language->code) }}
                                </textarea>
                                
                                @else

                                <textarea name="description[{{ $language->code }}]" class="summernote">
                                    {{ old('description.' . $language->code) ? : $post->getTranslation('description', $language->code) }}
                                </textarea>
                                    
                                @endif

                            </x-admin.form-item>
                        </div>
                      

                        @endforeach

                       


                        {{-- ? image post --}}
                        <div class="card-body__group">
                            <div class="image-add-group">

                                <x-admin.form-item>

                                    <x-admin.label> {{__('admin.label.image')}} </x-admin.label>

                                    @if ($post->image)
                                    <x-admin.image class="picture-block">

                                        {{-- <img class="poster-loaded" src="{{ $post->image  }}" alt=""> --}}
                                        <img class="poster-loaded" src="{{ asset('storage/' . $post->image ) }}" alt="">

                                    </x-admin.image>
                                    @else

                                    <x-admin.image class="picture-block hidden"></x-admin.image>

                                    @endif



                                    <x-admin.input-file name="image" type="file" id="input-file"
                                        accept="image/png, image/jpeg, image/webp" />

                                </x-admin.form-item>

                            </div>

                        </div>

                        <x-admin.form-item>

                           <x-admin.label> {{ __('admin.label.alt_image') }} </x-admin.label>

                           <x-admin.input name="alt_image" value="{{ $post->alt_image }}" type="text"  />

                       </x-admin.form-item>


                        @foreach ($languages as $language)
                     
                        <div class="card-body__group summernote-editor">
                            <x-admin.form-item>
                                <x-admin.label> {{__('admin.label.body')}} ({{ $language->code }}) </x-admin.label>
                               
                                @if ($errors->has('body.' . $language->code))
                                
                                <textarea name="body[{{ $language->code }}]" class="summernote textarea-error">
                                    {{ old('body.' . $language->code) ? : $post->getTranslation('body', $language->code) }}
                                </textarea>
                                
                                @else

                                <textarea name="body[{{ $language->code }}]" class="summernote">
                                    {{ old('body.' . $language->code) ? : $post->getTranslation('body', $language->code) }}
                                </textarea>
                                    
                                @endif

                            </x-admin.form-item>
                        </div>
                      

                        @endforeach

                       



                        {{-- ? published  and slider--}}
                        <div class="card-body-box">

                            <div class="group-items">
                                <div class="group-item">                                
                                    <h4 class="card-body-box__title title-h4">{{ __('admin.title.published') }}</h4>
        
                                    <div class="card-body__group card-body__group-switch">
                                        <x-admin.form-item>
        
                                            <x-admin.checkbox name="published" :checked="$post->published" id="published" role="switch" />
        
                                            <x-admin.label for="published">
                                                <span></span>
                                            </x-admin.label>
                                        </x-admin.form-item>
                                    </div>
                                </div>
                                <div class="group-item">
                                    <h4 class="card-body-box__title title-h4">{{ __('admin.title.slider') }}</h4>
            
                                    <div class="card-body__group card-body__group-switch">
                                        <x-admin.form-item>
                                            <x-admin.checkbox name="slider" :checked="$post->slider" id="slider" role="switch" />
                                            {{--
                                            <x-admin.checkbox name="published" id="published" role="switch" checked /> --}}
                                            <x-admin.label for="slider">
                                                <span></span>
                                            </x-admin.label>
                                        </x-admin.form-item>
                                    </div>
                                </div>
                            </div>
                            


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