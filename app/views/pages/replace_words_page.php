<?php $this->layout('templates/template', ['title' => 'Замена слов']) ?>

<?php $this->push('head') ?>
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php $this->end() ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/main-page">Главная страница</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/replace-words">Замена слов</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/remove-words">Удаление слов</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/topics">Топики</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="row col-3">
            <h4 class="mb-3">Заменить слова в комментариях</h4>
            <div class="row g-3">
                <form action="/replace-words" method="post">
                    <div class="col-12 mb-5">
                        <label class="form-label">Searched word</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="searched_replace_1[]"
                                   placeholder="Example: word1">
                        </div>
                        <label class="form-label">Replace with</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="searched_replace_1[]"
                                   placeholder="Example: word2">
                        </div>
                    </div>
                    <div class="col-12 mb-5">
                        <label class="form-label">Searched word</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="searched_replace_2[]"
                                   placeholder="Example: word1">
                        </div>
                        <label class="form-label">Replace with</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="searched_replace_2[]"
                                   placeholder="Example: word2">
                        </div>
                    </div>
                    <div class="col-12 mb-5">
                        <label class="form-label">Searched word</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="searched_replace_3[]"
                                   placeholder="Example: word1">
                        </div>
                        <label class="form-label">Replace with</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="searched_replace_3[]"
                                   placeholder="Example: word2">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
        <div class="row col-6">
            <div class="table-responsive">
                <p class="h3">Все комментарии</p>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Комментарий</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($messages as $value): ?>
                        <tr>
                            <th scope="row"><?= $value['id'] ?></th>
                            <td><?= $value['comment'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->push('scripts') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<?php $this->end() ?>

