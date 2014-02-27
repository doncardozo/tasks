<?php

namespace TC\TasksBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class TasksRepository extends EntityRepository {

    public function getTasks() {

        $em = $this->getEntityManager()->getConnection();

        $result = $em->fetchAll("select id, name, description from tasks order by 1 desc");

        return $result;
    }

    public function createTask(\TC\TasksBundle\Entity\Tasks $task) {

        $em = $this->getEntityManager()->getConnection();
        $em->beginTransaction();

        try {

            $em->insert("tasks", array(
                'name' => $task->getName(),
                'description' => $task->getDescription()
            ));

            $id = $em->lastInsertId();

            foreach ($task->getTags() as $tag) {
                $em->insert("tags", array(
                    'task_id' => $id,
                    'name' => $tag->getName()
                ));
            }

            $em->commit();

            return $id;
        } catch (\Exception $ex) {
            $em->rollback();
        }
    }

}
