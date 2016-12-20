<?php
    // src/AppBundle/Controller/PlayerListController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class PlayerListController extends Controller {
    /**
    * @Route("/players")
    */
    public function numberAction() {
        require_once($this->getParameter('PDOpath'));

        $sql1 = $db->prepare("SELECT * FROM player");
        $sql1->execute();
        $results1 = $sql1->fetchAll();

        return $this->render(
           'social_media/playerList.html.twig',
           array(
            'results1' => $results1
            )
        );
    }
}