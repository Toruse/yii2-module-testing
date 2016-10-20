<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tests`.
 */
class m161019_115236_create_tests_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tests', [
            'id' => $this->primaryKey(),
            'name' => $this->string(500),
            'description' => $this->text(),
        ]);
        $this->createTable('questions', [
            'id' => $this->primaryKey(),
            'title' => $this->string(1000),
            'type' => "ENUM('one','multiple') NOT NULL DEFAULT 'one'",
        ]);
        $this->createTable('answers', [
            'id' => $this->primaryKey(),
            'id_question' => $this->integer()->null(),
            'text' => $this->text(),
            'type' => "ENUM('right','wrong') NOT NULL DEFAULT 'wrong'",
        ]);
        $this->createTable('questions_tests', [
            'id' => $this->primaryKey(),
            'id_test' => $this->integer(),
            'id_question' => $this->integer(),
        ]);

        $this->createIndex('id_test', 'questions_tests', 'id_test');
        $this->createIndex('id_question', 'questions_tests', 'id_question');
        $this->createIndex('id_question', 'answers', 'id_question');

        $this->addForeignKey('fk-questions_tests-id_test', 'questions_tests', 'id_test', 'tests', 'id', 'CASCADE');
        $this->addForeignKey('fk-questions_tests-id_question', 'questions_tests', 'id_question', 'questions', 'id', 'CASCADE');
        $this->addForeignKey('fk-answers-id_question', 'answers', 'id_question', 'questions', 'id', 'CASCADE');

        $this->insertData();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('answers');
        $this->dropTable('questions_tests');
        $this->dropTable('questions');
        $this->dropTable('tests');
    }

    private function insertData()
    {
        $this->insert('tests', [
            'id' => 1,
            'name' => 'Пробный тест',
            'description' => 'Набор вопросов для проверки работы тестов.'
        ]);

        $this->insert('questions', [
            'id' => 1,
            'title' => 'Сколько пальцев на руке?',
            'type' => 'one'
        ]);
        $this->insert('questions', [
            'id' => 2,
            'title' => 'Сколько дней в году?',
            'type' => 'multiple'
        ]);
        $this->insert('questions', [
            'id' => 3,
            'title' => 'Как называется ближайшая звезда к земле?',
            'type' => 'one'
        ]);

        $this->insert('answers', [
            'id' => 1,
            'id_question' => 1,
            'text' => '10',
            'type' => 'wrong'
        ]);
        $this->insert('answers', [
            'id' => 2,
            'id_question' => 1,
            'text' => '5',
            'type' => 'right'
        ]);
        $this->insert('answers', [
            'id' => 3,
            'id_question' => 1,
            'text' => '21',
            'type' => 'wrong'
        ]);
        $this->insert('answers', [
            'id' => 4,
            'id_question' => 1,
            'text' => '20',
            'type' => 'wrong'
        ]);

        $this->insert('answers', [
            'id' => 5,
            'id_question' => 2,
            'text' => '365',
            'type' => 'right'
        ]);
        $this->insert('answers', [
            'id' => 6,
            'id_question' => 2,
            'text' => '355',
            'type' => 'wrong'
        ]);
        $this->insert('answers', [
            'id' => 7,
            'id_question' => 2,
            'text' => '366',
            'type' => 'right'
        ]);
        $this->insert('answers', [
            'id' => 8,
            'id_question' => 2,
            'text' => '360',
            'type' => 'wrong'
        ]);

        $this->insert('answers', [
            'id' => 9,
            'id_question' => 3,
            'text' => 'Луна',
            'type' => 'wrong'
        ]);
        $this->insert('answers', [
            'id' => 10,
            'id_question' => 3,
            'text' => 'Проксима',
            'type' => 'wrong'
        ]);
        $this->insert('answers', [
            'id' => 11,
            'id_question' => 3,
            'text' => 'Полярная звезда',
            'type' => 'wrong'
        ]);
        $this->insert('answers', [
            'id' => 12,
            'id_question' => 3,
            'text' => 'Солнце',
            'type' => 'right'
        ]);

        $this->insert('questions_tests', [
            'id' => 1,
            'id_test' => 1,
            'id_question' => 1
        ]);
        $this->insert('questions_tests', [
            'id' => 2,
            'id_test' => 1,
            'id_question' => 2
        ]);
        $this->insert('questions_tests', [
            'id' => 3,
            'id_test' => 1,
            'id_question' => 3
        ]);
    }
}
