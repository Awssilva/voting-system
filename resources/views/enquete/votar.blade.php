<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enquetes</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container mt-5">
        @if($status = Session::get('mensagem'))
            <div class="alert alert-warning">
                <h2>{{ $status }}</h2>
            </div>
        @endif


        <div class="row">
            <div class="col-sm-10">
                <h1>Votar</h1>
            </div>
            <div class="col-sm-2">
                <div class="btn-group">
                    <a class="btn btn-warning" href="{{ route('enquete.index') }}">Voltar</a>
                </div>
            </div>
        </div>

        <div>
            <h2>{{ $enquete->titulo }}</h2>
            <h5 class="text-warning">*click em uma opção para votar*</h5>
            <ul class="list-group" style="width: 70%;">
                @foreach($opcoes as $opcao)
                    <li style="list-style: none;">
                        <a  style="text-decoration: none;" href="{{ route('enquete.votar', $opcao->id) }}">
                            <div class="bg-light p-3 mb-3">
                                <div class="row">
                                    <div class="col-sm-10">
                                        {{ $opcao->opcao }}
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="" style="text-align: right;">
                                            {{ $opcao->porcentagem }} %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        setTimeout(function(){
            location.reload();
        }, 5000);
    </script>

</body>
</html>
