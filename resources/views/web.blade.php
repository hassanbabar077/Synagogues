<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>CHECKING PERMISSSIONS</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
<h1>HELLO</h1>
                <div class="card-body">
                    @if (auth()->user()->roles->isEmpty())
                        <button>Guest</button>
                    @else
                        @if (auth()->user()->hasRole('administrator'))
                        <button>Administrator</button>
                        @endif

                        @if (auth()->user()->hasRole('viewer'))
                        <button>Viewer</button>
                        @endif

                        @if (auth()->user()->hasRole('contentmanager'))
                        <button>Content Manager</button>
                        @endif
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

</body>
</html>
