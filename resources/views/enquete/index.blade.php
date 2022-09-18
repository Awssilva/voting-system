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

    <div class="container">
        <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/enquete" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="{{ route('enquete.create') }}" class="nav-link">Nova Enquete</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
        </ul>
        </header>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-10">
                <h1>Enquetes</h1>
            </div>
        </div>

        @if($status = Session::get('mensagem'))
            <div class="alert alert-warning">
                <h2>{{ $status }}</h2>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Data de início</th>
                    <th>Data de término</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enquetes as $enquete)
                <tr>
                    <td>{{ $enquete->titulo }}</td>
                    <td>{{ date('d/m/Y', strtotime($enquete->data_inicio)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($enquete->data_fim)) }}</td>
                    <td>
                        @if(date('Y-m-d') > $enquete->data_fim)
                            <span class="badge bg-danger"> Encerrada </span>
                        @elseif(date('Y-m-d') < $enquete->data_inicio)
                            <span class="badge bg-primary">Não iniciada</span>
                        @else
                            <span class="badge bg-warning text-dark">Em andamento</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            @if(date('Y-m-d') >= $enquete->data_inicio && date('Y-m-d') <= $enquete->data_fim)
                                <a class="btn btn-primary" href="{{ route('enquete.show', $enquete->id) }}">Votar</a>
                            @endif

                            <a class="btn btn-warning" href="{{ route('enquete.edit', $enquete->id) }}">Editar</a>
                            <form action="{{ route('enquete.destroy', $enquete->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
