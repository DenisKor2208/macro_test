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

class MessageController
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
     * Получение главной страницы с комментариями
     */
    public function mainPage($vars)
    {
        $oneLastMessagesTopics = $this->qb->getOneLastUserCommentsTopics();
        $threeLastMessagesTopics = $this->qb->getThreeLastUserCommentsTopics();

        echo $this->templates->render('pages/main_page',
            [
                'oneLastMessagesTopics' => $oneLastMessagesTopics,
                'threeLastMessagesTopics' => $threeLastMessagesTopics
            ]);
    }

    /**
     * Получение страницы комментариев с возможностью заменой слов
     */
    public function replaceWordsPage($vars)
    {
        $messages = $this->qb->getComments();

        echo $this->templates->render('pages/replace_words_page',
            [
                'messages' => $messages
            ]);
    }

    /**
     * Получение страницы комментариев с возможностью удаления слов
     */
    public function removeWordsPage($vars)
    {
        $messages = $this->qb->getComments();

        echo $this->templates->render('pages/remove_words_page',
            [
                'messages' => $messages
            ]);
    }

    /**
     * Замена слов
     */
    public function replaceWordsChange($vars)
    {
        if (!empty($_POST)) {
            foreach ($_POST as $value) {
                $replace_words[$value[0]] = $value[1];
            }

            $result = $this->qb->getComments();

            foreach ($result as &$item) {
                $origin_string = $item['comment'];
                foreach ($replace_words as $key => $value) {
                    $item['comment'] = str_replace($key, $value, $item['comment']);
                }
                if (strcmp($origin_string, $item['comment']) != 0) {
                    $this->qb->update(['comment' => $item['comment']], $item['id'], 'topics_messages');
                }
            }
        }

        header('Location: /replace-words');
        die();

    }

    /**
     * Удаление слов
     */
    public function removeWordsChange($vars)
    {
        if (!empty($_POST)) {
            $remove_words = explode(',', $_POST['remove_words']);
            array_walk($remove_words, function (&$value) {
                $value = trim($value);
            });

            $result = $this->qb->getComments();

            foreach ($result as $item) {
                $result_string = str_replace($remove_words, "", $item['comment']);
                if (strcmp($item['comment'], $result_string)) {
                    $result_string = trim(str_replace("  ", " ", $result_string));
                    $this->qb->update(['comment' => $result_string], $item['id'], 'topics_messages');
                }
            }

        }
        header('Location: /remove-words');
        die();
    }
}