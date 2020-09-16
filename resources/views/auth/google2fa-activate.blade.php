@extends('layouts.ui-app')

@section('content')
    <div class="uk-container">
        <div class="uk-card uk-card-default uk-border-rounded">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">GOOGLE 2FA ACTIVATION</h3>
                    </div>
                </div>
            </div>
            @if(!$activation_status && !session('status'))
                <div class="uk-card-body">
{{--                    <img class="" style="min-width: 300px" src="{{ $google2fa_url }}" alt="">--}}
                    {!!  $google2fa_url !!}
                </div>
            @else
                <div class="uk-card-body">
                    <div class="uk-margin">
                        <div class="uk-text-center uk-text-success uk-text-uppercase">
                            @if (session('status'))
                                {{ session('status') }}
                            @else
                                Google 2FA is already activated
                        </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        @if(!$activation_status && !session('status'))

            <div class="uk-card-footer">
                <form method="post" action="{{route('profile.2fa.activate')}}">
                    @csrf
                    <fieldset class="uk-fieldset">

                        <div class="uk-margin">
                            <input class="uk-input uk-border-rounded" type="number" name="pin" placeholder="PIN (6 digits)" autofocus>
                        </div>
                        @error('pin')
                        <div class="uk-margin">
                            <div class="uk-text-center uk-text-danger">{{ $message }}</div>
                        </div>
                        @enderror
                        @if (session('status'))
                            <div class="uk-margin">
                                <div class="uk-text-center uk-text-success uk-text-uppercase">{{ session('status') }}</div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="uk-margin">
                                <div class="uk-text-center uk-text-danger uk-text-uppercase">{{ session('error') }}</div>
                            </div>
                        @endif
                        @if(!session('status'))
                            <div class="uk-margin">
                                <button class="uk-button uk-button-primary uk-button-small uk-border-rounded uk-align-center">activate
                                </button>
                            </div>
                        @endif
                    </fieldset>
                </form>
            </div>
        @endif
    </div>

@endsection
