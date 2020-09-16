@extends('layouts.ui-app')

@section('content')
    <div class="uk-container">
        <div class="uk-card uk-card-default uk-border-rounded">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">GOOGLE 2FA VERIFICATION</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-card-footer">
                <form method="post" action="{{route('profile.2fa.verify')}}">
                @csrf
                <fieldset class="uk-fieldset">

                    <div class="uk-margin">
                        <input class="uk-input uk-border-rounded" type="number" name="2fa_code"
                               placeholder="PIN (6 digits)" autofocus>
                    </div>
                    @error('message')
                    <div class="uk-margin">
                        <div class="uk-text-center uk-text-danger">{{ $message ?? '' }}</div>
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
                            <button class="uk-button uk-button-primary uk-button-small uk-border-rounded uk-align-center">Authenticate
                            </button>
                        </div>
                    @endif
                </fieldset>
            </form>
        </div>
    </div>
@endsection
