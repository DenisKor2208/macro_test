<?php

namespace App\Controller;

use App\exceptions\AccountIsBlockedException;
use App\exceptions\NotEnoughMoneyException;
use App\model\QueryBuilder;
use Aura\SqlQuery\QueryFactory;
use Delight\Auth\Auth;
use Exception;
use JasonGrimes\Paginator;
use League\Plates\Engine;
use Faker\Factory;
use PDO;
use SimpleMail;
use Tamtamchik\SimpleFlash\Flash;
use App\Controller\HelpController;

class TopicController
{

    private
        $templates,
        $qb,
        $pdo,
        $queryFactory;

    public function __construct(Engine $engine, QueryBuilder $qb, PDO $pdo, QueryFactory $queryFactory)
    {
        $this->templates = $engine;
        $this->qb = $qb;
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }

    /**
     * Получение главной страницы с топиками
     */
    public function index($vars)
    {
        $topics = $this->qb->getAll('topics');

        echo $this->templates->render('pages/topics/index',
            [
                'topics' => $topics
            ]);
    }

    /**
     * Страница добавления топика
     */
    public function create($vars)
    {
        echo $this->templates->render('pages/topics/create');
    }

    /**
     * Сохранение добавленного топика
     */
    public function store($vars)
    {
        $this->qb->insert($_POST,'topics');

        header('Location: /topics');
        die();
    }

    /**
     * Страница редактирования топика
     */
    public function edit($vars)
    {
        $topic = $this->qb->getOne('topics', $vars['id']);

        echo $this->templates->render('pages/topics/edit',
            [
                'topic' => $topic[0]
            ]);
    }

    /**
     * Сохранение измененного топика
     */
    public function update($vars)
    {
        $this->qb->update($_POST, $_POST['id'],'topics');

        header('Location: /topic-edit/' . $_POST['id']);
        die();
    }

    /**
     * Удаление топика
     */
    public function delete($vars)
    {
        $this->qb->delete('topics', $vars['id']);

        header('Location: /topics');
        die();
    }

}