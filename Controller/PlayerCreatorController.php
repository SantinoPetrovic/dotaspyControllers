<?php
// src/AppBundle/Controller/PlayerCreatorController.php

    namespace AppBundle\Controller;
    use AppBundle\Entity\Task;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

class PlayerCreatorController extends Controller {
    /**
     * @Route("/admin")
     */
    public function adminAction() {
        require_once($this->getParameter('PDOpath'));
        $sql = $db->prepare("SELECT * FROM player");
        $sql->execute();
        $results = $sql->fetchAll();
        return $this->render('social_media/player_register.html.twig', array(
            'results' => $results,
        ));
    }
}