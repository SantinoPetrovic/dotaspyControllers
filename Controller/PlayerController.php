
// src/AppBundle/Controller/PlayerController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class PlayerController extends Controller {
        /**
        * @Route("/player/{playerID}/{playerNickName}")
        */
        public function numberAction($playerNickName, $playerID) {
            require_once($this->getParameter('PDOpath'));
            $sql = $db->prepare("SELECT * FROM player WHERE player_ID = :playerID AND nickname = :playerNickName");
            $sql->bindValue(':playerID', $playerID);
            $sql->bindValue(':playerNickName', $playerNickName);
            $sql->execute();
            $results = $sql->fetchAll();
            return $this->render(
                'social_media/player.html.twig',
                array('results' => $results)
            );
        }
    // ...
    }