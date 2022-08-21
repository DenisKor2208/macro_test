<?php $this->layout('templates/template', ['title' => 'Главная страница']) ?>

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
        <div class="table-responsive">
            <p class="h3">Один последний комментарий</p>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Наименование топика</th>
                    <th scope="col">Последний комментарий</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Дата</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($oneLastMessagesTopics as $value): ?>
                    <tr>
                        <th scope="row"><?= $value['id'] ?></th>
                        <td><?= $value['title'] ?></td>
                        <td><?= $value['comment'] ?></td>
                        <td><?= $value['login'] ?></td>
                        <td><?= $value['date_added'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="table-responsive">
            <p class="h3">Три последних комментария</p>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Наименование топика</th>
                    <th scope="col">Последний комментарий</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Дата</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($threeLastMessagesTopics as $value): ?>
                    <tr>
                        <th scope="row"><?= $value['id'] ?></th>
                        <td><?= $value['title'] ?></td>
                        <td><?= $value['comment'] ?></td>
                        <td><?= $value['login'] ?></td>
                        <td><?= $value['date_added'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php $this->push('scripts') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<?php $this->end() ?>

