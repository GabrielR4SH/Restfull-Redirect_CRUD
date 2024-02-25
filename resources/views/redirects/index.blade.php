<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layout')

    <div class="container rounded bg-dark text-light p-4 mt-4">
        <h3>CRUD</h3>
        <form action="{{ route('redirects.store') }}" method="POST">
            @csrf
            <div class="row mt-3">
                <div class="col">
                    <input type="text" class="form-control" name="url" placeholder="URL">
                </div>
              
            <div class="row mt-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-info">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    

    <div class="container mt-4">
        <h3 style="color: white;">Lista de Rotas</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">URL Destino</th>
                    <th scope="col">Ativo</th>
                    <th style="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($redirects as $redirect)
                    <tr>
                        <th scope="row">{{ $redirect->code }}</th>
                        <td>{{ $redirect->url_destino }}</td>
                        <td>{{ $redirect->ativo ? 'Sim' : 'Não' }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Deletar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
