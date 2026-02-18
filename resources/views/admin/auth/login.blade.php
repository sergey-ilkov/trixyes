@extends('admin.layouts.auth')





@section('auth-content')



<div class="auth-form-wrapper">




    @if (isset($blocking))

    <div class="alert alert-error">

        {{ $blocking }}

    </div>

    @else


    <h3 class="auth-form__title"> {{ __('admin.form.title') }} </h3>



    <div class="auth-form-box">

        <x-admin.errors />

        <x-admin.form action="{{ route('admin.authenticate') }}" method="POST" class="auth-form">


            <x-admin.form-item>

                <x-admin.label required> {{__('admin.form.login')}} </x-admin.label>

                <x-admin.input name="login" />

            </x-admin.form-item>



            <x-admin.form-item>

                <x-admin.label required> {{__('admin.form.password')}} </x-admin.label>

                <x-admin.input type="password" name="password" />

            </x-admin.form-item>


            <x-admin.button type="submit" class="btn-auth">

                {{__('admin.form.btn-sign-in')}}

            </x-admin.button>

        </x-admin.form>

    </div>



    @endif


</div>

@endsection