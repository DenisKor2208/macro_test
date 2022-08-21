<?php

namespace App\Model;

use Aura\SqlQuery\QueryFactory;
use PDO;

Class QueryBuilder {

    private $pdo, $queryFactory;

    public function __construct(PDO $pdo, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }

    /**
     * Получение 1 последнего комментария к каждому топику
     */
    public function getOneLastUserCommentsTopics()
    {
        $select = "
            SELECT t.id, t.title, t.text, m1.comment, u.login, m1.date_added 
            FROM topics t, topics_messages m1, users u
            WHERE (
                SELECT count(*) 
                FROM topics_messages m2 
                WHERE m1.topics_id=m2.topics_id 
                  AND m2.date_added > m1.date_added) < 1
              AND u.id = m1.users_id
              AND t.id = m1.topics_id
            ORDER BY t.id, m1.date_added DESC
            ";

        $pdo = $this->pdo;
        $sth = $pdo->prepare($select);
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Получение 3 последних комментариев к каждому топику
     */
    public function getThreeLastUserCommentsTopics()
    {
        $select = "
            SELECT t.id, t.title, t.text, m1.comment, u.login, m1.date_added 
            FROM topics t, topics_messages m1, users u
            WHERE (
                SELECT count(*) 
                FROM topics_messages m2 
                WHERE m1.topics_id=m2.topics_id 
                  AND m2.date_added > m1.date_added) < 3
              AND u.id = m1.users_id
              AND t.id = m1.topics_id
            ORDER BY t.id, m1.date_added DESC
            ";

        $pdo = $this->pdo;
        $sth = $pdo->prepare($select);
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Получение всех комментариев
     */
    public function getComments()
    {
        $select = "
            SELECT m.id, m.comment
            FROM topics_messages m
            ";

        $pdo = $this->pdo;
        $sth = $pdo->prepare($select);
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Обновление записей новыми данными.
     */
    public function update($data, $id, $table)
    {
        $queryFactory = $this->queryFactory;
        $update = $queryFactory->newUpdate();
        $update
            ->table($table)
            ->cols($data)
            ->where('id = :id')
            ->bindValue('id', $id);

        $pdo = $this->pdo;
        $sth = $pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
    }

    /**
     * Получение всех записей из таблицы
     */
    public function getAll($table)
    {
        $queryFactory = $this->queryFactory;
        $select = $queryFactory->newSelect();
        $select->cols(['*']) -> from($table) -> orderBy(['id ASC']) ;

        $pdo = $this->pdo;
        $sth = $pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Получение одной записи из таблицы по id
     */
    public function getOne($table, $id)
    {
        $queryFactory = $this->queryFactory;
        $select = $queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $pdo = $this->pdo;
        $sth = $pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Удаление одной записи по id из таблицы
     */
    public function delete($table, $id)
    {
        $queryFactory = $this->queryFactory;
        $delete = $queryFactory->newDelete();

        $delete
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $pdo = $this->pdo;
        $sth = $pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
    }

    /**
     * Создание новых записей в таблице
     */
    public function insert($data, $table)
    {
        $queryFactory = $this->queryFactory;
        $insert = $queryFactory->newInsert();
        $insert
            ->into($table)
            ->cols($data);

        $pdo = $this->pdo;
        $sth = $pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
    }

}