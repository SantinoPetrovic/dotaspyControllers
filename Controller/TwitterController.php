<?php
    // src/AppBundle/Controller/TwitterController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class TwitterController extends Controller {
    /**
    * @Route("/player/{playerID}/{playerNickName}/twitter")
    */
    public function numberAction($playerNickName, $playerID) {
        require_once($this->getParameter('PDOpath'));
        $sql = $db->prepare("SELECT * FROM player_twitter, player WHERE player_twitter.player_ID = :playerID AND player.nickname = :playerNickName");
        $sql->bindValue(':playerID', $playerID);
        $sql->bindValue(':playerNickName', $playerNickName);
        $sql->execute();
        $results = $sql->fetchAll();
        return $this->render(
           'social_media/twitter.html.twig',
           array('results' => $results)
        );
    }
}