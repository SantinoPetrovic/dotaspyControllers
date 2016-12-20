<?php
    // src/AppBundle/Controller/TwitchController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class TwitchController extends Controller {
    /**
    * @Route("/player/{playerID}/{playerNickName}/twitch")
    */
    public function numberAction($playerNickName, $playerID) {
        require_once($this->getParameter('PDOpath'));
        $sql = $db->prepare("SELECT twitch_id FROM player WHERE player_ID = :playerID AND nickname = :playerNickName");
        $sql->bindValue(':playerID', $playerID);
        $sql->bindValue(':playerNickName', $playerNickName);
        $sql->execute();
        $results = $sql->fetchAll();
        return $this->render(
           'social_media/twitch.html.twig',
           array('results' => $results)
        );
    }
}