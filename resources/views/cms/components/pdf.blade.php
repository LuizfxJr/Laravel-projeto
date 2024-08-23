<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>

<body>
    <div class="container">

    </div>
    <section class="content" style="width: 90%;">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <i class="fas fa-solid fa-toolbox float-right"></i>
                            <h3 class="card-title ">Relatório de Equipamentos</h3>
                        </div>

                        <div class="card-body">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label>Tipo de Equipamento*</label>
                                            <br />
                                            <label>Permanente</label>
                                        </td>
                                        <td>
                                            <label>Nome do Equipamento*</label>
                                            <br />
                                            <label>Catraca</label>
                                        </td>
                                        <td>
                                            <label>Data de cadastro*</label>
                                            <br />
                                            <label>20/11/2022</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Fornecedor</label>
                                            <br />
                                            <label>Cordeiro e CIA</label>
                                        </td>
                                        <td>
                                            <label>CNPJ</label>
                                            <br />
                                            <label>10.000.200/0001/15</label>
                                        </td>
                                        <td>
                                            <label>Telefone</label>
                                            <br />
                                            <label>(11) 91232-1232</label>
                                        </td>
                                        <td>
                                            <label>Setor de Alocação</label>
                                            <br />
                                            <label>Setor 01 - Produção</label>
                                        </td>
                                        <td>
                                            <label>Responsável</label>
                                            <br />
                                            <label>Carlos Souza</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Informações adicionais</label>
                                            <br />
                                            <label>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                            </label>
                                        </td>
                                        <td>
                                            <label>CNPJ</label>
                                            <br />
                                            <label>10.000.200/0001/15</label>
                                        </td>
                                        <td>
                                            <label>Telefone</label>
                                            <br />
                                            <label>(11) 91232-1232</label>
                                        </td>
                                        <td>
                                            <label>Setor de Alocação</label>
                                            <br />
                                            <label>Setor 01 - Produção</label>
                                        </td>
                                        <td>
                                            <label>Responsável</label>
                                            <br />
                                            <label>Carlos Souza</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Inserir</button>
                            <a href="{{route('cms.equipment.index')}}" class="btn btn-default float-right">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <h1>This is a Heading</h1>
    <p>This is a paragraph.</p>

</body>

</html>