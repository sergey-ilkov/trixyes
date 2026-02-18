@extends('admin.layouts.base')




@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.services')" />



    <div class="content-box">

        <div class="content-box-top">



            <x-admin.link href="{{ route('admin.services.index') }}" class="admin-link">

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

                    {{__('admin.title.services-create')}}

                </h3>

                <div class="card-body">


                    <x-admin.errors />

                    <x-admin.form action="{{ route('admin.services.store') }}" enctype="multipart/form-data" method="POST"
                        class="card-form">


                        {{-- ? name --}}

                        @foreach ($languages as $language )
                        <div class="card-body__group">
                        <x-admin.form-item>

                            <x-admin.label> {{ __('admin.label.name') }} ({{ $language->code }}) </x-admin.label>

                            @if ($errors->has('name.' . $language->code))

                                <x-admin.input name="name[{{ $language->code }}]" class="input-error" value="{{ old('name.' . $language->code) }}"  />
                                
                            @else
                             
                                <x-admin.input name="name[{{ $language->code }}]" value="{{ old('name.' . $language->code) }}"  />

                            @endif
                                
                        </x-admin.form-item>
                        </div>  
                        @endforeach



                        {{-- ? icon --}}
                        <div class="card-body__group">
                            <div class="image-add-group">
                                <x-admin.form-item>

                                    <x-admin.label> {{__('admin.label.icon')}} </x-admin.label>
                                    <x-admin.image class="picture-block hidden"></x-admin.image>
                                    <x-admin.input-file name="icon" type="file" id="input-file"
                                        accept="image/png, image/jpeg, image/webp" />

                                </x-admin.form-item>
                            </div>

                        </div>

                        <x-admin.form-item>

                           <x-admin.label> {{ __('admin.label.alt_image') }} </x-admin.label>

                           <x-admin.input name="alt_image" type="text"  />

                       </x-admin.form-item>




                        <div class="card-body-row">

                            {{-- ? interset --}}
                            <div class="card-body__group">
                                <x-admin.form-item>

                                    <x-admin.label> {{ __('admin.label.interset') }} </x-admin.label>
                                    <x-admin.input type="number" name="interset" min="0.01" max="100" step="0.01" style="width: 200px" />

                                </x-admin.form-item>

                            </div>

                            {{-- ? term --}}
                            <div class="card-body__group">
                                <x-admin.form-item>

                                    <x-admin.label> {{ __('admin.label.term') }} </x-admin.label>
                                    <x-admin.input type="number" name="term" min="1" step="1" style="width: 200px" />

                                </x-admin.form-item>

                            </div>



                            {{-- ? amount --}}
                            <div class="card-body__group">
                                <x-admin.form-item>

                                    <x-admin.label> {{ __('admin.label.amount') }} </x-admin.label>
                                    <x-admin.input type="number" name="amount" min="1" step="1" style="width: 200px" />

                                </x-admin.form-item>

                            </div>

                            {{-- ? promo_code --}}
                            <div class="card-body__group">
                                <x-admin.form-item>

                                    <x-admin.label> {{ __('admin.label.promo-code')}} </x-admin.label>
                                    <x-admin.input name="promo_code" style="width: 200px" />

                                </x-admin.form-item>
                            </div>




                            {{-- ? promo_discount --}}
                            <div class="card-body__group">
                                <x-admin.form-item>

                                    <x-admin.label> {{ __('admin.label.promo-discount')}} </x-admin.label>
                                    <x-admin.input type="number" name="promo_discount" min="1" step="1" style="width: 200px" />

                                </x-admin.form-item>
                            </div>

                            {{-- ? vote_rating --}}
                            <div class="card-body__group">
                                <x-admin.form-item>

                                    <x-admin.label> {{ __('admin.label.vote-rating')}} </x-admin.label>
                                    <x-admin.input type="number" name="vote_rating" min="1" max="10" step="1" style="width: 200px" />

                                </x-admin.form-item>
                            </div>

                            {{-- ? vote_count --}}
                            <div class="card-body__group">
                                <x-admin.form-item>

                                    <x-admin.label> {{ __('admin.label.vote-count')}} </x-admin.label>
                                    <x-admin.input type="number" name="vote_count" min="1" step="1" style="width: 200px" />

                                </x-admin.form-item>
                            </div>


                        </div>





                        {{-- ? rating service --}}
                        

                        <div class="card-body-row">

                            @foreach ($categories as $category)    
                                <div class="card-body__group">
                                    <x-admin.form-item>
    
                                        <x-admin.label> {{ $category->name }} </x-admin.label>
                                        <x-admin.input type="number" name="{{ $category->slug }}" min="0.01" max="10" step="0.01" style="width: 200px" />
    
                                    </x-admin.form-item>                                    
                                </div>
                            @endforeach
                        </div>
                                               
                        {{-- ? url --}}
                        <div class="card-body__group">
                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.url')}} </x-admin.label>
                                <x-admin.input type="url" name="url" />

                            </x-admin.form-item>
                        </div>

                        {{-- ? license --}}
                        @foreach ($languages as $language )
                        <div class="card-body__group">
                        <x-admin.form-item>

                            <x-admin.label> {{ __('admin.label.license') }} ({{ $language->code }}) </x-admin.label>

                            @if ($errors->has('license.' . $language->code))

                                <x-admin.input name="license[{{ $language->code }}]" class="input-error" value="{{ old('license.' . $language->code) }}"  />
                                
                            @else
                             
                                <x-admin.input name="license[{{ $language->code }}]" value="{{ old('license.' . $language->code) }}"  />

                            @endif
                                
                        </x-admin.form-item>
                        </div>
                        @endforeach

                     
                        {{-- ? comp_name --}}
                        @foreach ($languages as $language )
                        <div class="card-body__group">
                        <x-admin.form-item>

                            <x-admin.label> {{ __('admin.label.comp-name') }} ({{ $language->code }}) </x-admin.label>

                            @if ($errors->has('comp_name.' . $language->code))

                                <x-admin.input name="comp_name[{{ $language->code }}]" class="input-error" value="{{ old('comp_name.' . $language->code) }}"  />
                                
                            @else
                             
                                <x-admin.input name="comp_name[{{ $language->code }}]" value="{{ old('comp_name.' . $language->code) }}"  />

                            @endif
                                
                        </x-admin.form-item>
                        </div>   
                        @endforeach

                     

                        {{-- ? email --}}
                        <div class="card-body__group">
                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.email')}} </x-admin.label>
                                <x-admin.input type="email" name="email" style="max-width: 500px" />

                            </x-admin.form-item>
                        </div>

                        {{-- ? address --}}
                        @foreach ($languages as $language )
                        <div class="card-body__group">
                        <x-admin.form-item>

                            <x-admin.label> {{ __('admin.label.address') }} ({{ $language->code }}) </x-admin.label>

                            @if ($errors->has('address.' . $language->code))

                                <x-admin.input name="address[{{ $language->code }}]" class="input-error" value="{{ old('address.' . $language->code) }}"  />
                                
                            @else
                             
                                <x-admin.input name="address[{{ $language->code }}]" value="{{ old('address.' . $language->code) }}"  />

                            @endif
                                
                        </x-admin.form-item>
                        </div>    
                        @endforeach

                     
                        {{-- ? phone --}}
                        <div class="card-body__group">
                            <x-admin.form-item>

                                <x-admin.label> {{ __('admin.label.phone')}} </x-admin.label>
                                <x-admin.input name="phone" style="max-width: 500px" />

                            </x-admin.form-item>
                        </div>

                        {{-- ? published --}}
                        <div class="card-body-box">
                            <h4 class="card-body-box__title title-h4">{{ __('admin.title.published') }}</h4>

                            <div class="card-body__group card-body__group-switch">
                                <x-admin.form-item>

                                    <x-admin.checkbox name="published" id="published" role="switch" />

                                    <x-admin.label for="published">
                                        <span></span>
                                    </x-admin.label>
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