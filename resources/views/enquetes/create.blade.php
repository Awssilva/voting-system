<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Enquetes</title>
</head>
<body>
    
    <div class="container">

            <h1>NOVA ENQUETE</h1>

        @if($status = Session::get('mensagem'))
            <h2>{{ $status }}</h2>
        @endif

        @if($errors->any())
        <h2>Houveram alguns erros ao processar o formulário</h2>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form action="{{ route('enquetes.store') }}" method="post">
        @csrf

        <div class="mb-3 row">
          
            <label for="inputTitulo" class="col-sm-2 col-form-label">Título</label>
          
            <div class="col-sm-10">
                <input type="text" id="inputTitulo" class="form-control" name="titulo" placeholder="Digite o título">
            </div>
        </div>

        <div class="mb-3 row">

            <label for="inputDataInicio" class="col-sm-2 col-form-label">Data para início</label>

            <div class="col-sm-10">
                <input type="date" id="inputDataInicio" class="form-control" name="data_inicio" >
            </div>
        </div>

        <div class="mb-3 row">

            <label for="inputDataFim" class="col-sm-2 col-form-label">Data para o término</label>

            <div class="col-sm-10">
                <input type="date" id="inputDataFim" class="form-control" name="data_fim" >
            </div>
        </div>



        <div id="opcoes"></div>

        <!-- <tr>
            <td>Pergunta:</td>
            <td><input type="text" name="pergunta" id="pergunta" 
            placeholder="Cadastre uma perguntas"></td>
        </tr>
        <tr>
            <p>na verdade abaixo deve ter opções de respostas</p>
            <td>Resposta:</td>
            <td><input type="text" name="resposta" id="resposta"
            placeholder="Resposta"></td>
        </tr> -->

        <tr>
            <td>
                <input class="btn btn-success" type="button" id="addButton" value="Adicionar nova opção"/></td>
            <td>               
            <input class="btn btn-warning" type="button" id="removeButton" value="Remover"></td>
            <td>
                <input class="btn btn-danger" type="button"  id="resetButton" value="Remover último">
            </td>
        </tr>      
        

        <tr>
            <td>&nbsp;</td>
            <td><button type="submit">Gravar</button></td>
        </tr>

        </table>
        </form>

    </div>

    
    <script> 
    var idnum = 0  ;
    $(document).ready( function() {
        console.log('chegou aqui');
        
        $('#addButton').click( function () {


                var opcao =  ` 
                    <div class="cont mb-3 row" id="n`+(idnum+1)+`">
            
                    <label for="inputOpcao`+(idnum+1)+`" class="col-sm-2 col-form-label">Opção `+(idnum+1)+`</label>
            
            <div class="col-sm-10">
                <input type="text" id="inputOpcao`+(idnum+1)+`" class="form-control" name="opcao[]" placeholder="Digite a opção `+(idnum+1)+`">
            </div>
            </div> 
            `;


            // $('#opcoes').append("<div class='cont'id = 'row"+ idnum +"'><tr><td><label >Type</label></td><td><select><option value='1'>Audio</option><option value='2'>Video</option></select></td></tr><tr id='name'><td><label>Name</label></td><td><input  type='text' name='name'></td></tr></div>" );
            
            $('#opcoes').append(opcao);

            idnum++;
        });
        
        
        $('#resetButton').click( function () {
            $('.cont').remove()
            
        });
        
        $('#removeButton').click(function() {
            var rowName = '#n'+ (idnum+1)
            $(rowName).remove()
            idnum--;
        });
    
    });

    </script>



</body>
</html>