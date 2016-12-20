<?php
    // src/AppBundle/Controller/HomeController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class HomeController extends Controller {
    /**
    * @Route("/")
    */
    public function numberAction() {
    	require_once($this->getParameter('PDOpath'));
        $sql1 = $db->prepare("SELECT * FROM player_twitter ORDER BY RAND() LIMIT 1");
        $sql1->execute();
        $results1 = $sql1->fetchAll();
	    $screen_name = $results1[0]["screen_name"];

        $sql2 = $db->prepare("SELECT * FROM player WHERE facebook_id != '' ORDER BY RAND() LIMIT 1");
        $sql2->execute();
        $results2 = $sql2->fetchAll();
        $facebook_id = $results2[0]["facebook_id"];

        $sql3 = $db->prepare("SELECT * FROM player WHERE twitter_id = :screen_name");
        $sql3->bindValue(':screen_name', $screen_name);
        $sql3->execute();
        $results3 = $sql3->fetchAll();

        $sql4 = $db->prepare("SELECT * FROM player_matches ORDER BY match_timestamp DESC LIMIT 1");
        $sql4->execute();
        $results4 = $sql4->fetchAll();
        $playerID = $results4[0]["playerID"];

        $sql5 = $db->prepare("SELECT * FROM player WHERE facebook_id = :facebook_id");
        $sql5->bindValue(':facebook_id', $facebook_id);
        $sql5->execute();
        $results5 = $sql5->fetchAll();

        $sql6 = $db->prepare("SELECT * FROM player WHERE player_ID = :playerID");
        $sql6->bindValue(':playerID', $playerID);
        $sql6->execute();
        $results6 = $sql6->fetchAll();

        $sql9 = $db->prepare("SELECT * FROM player_gosugamers ORDER BY timestamp DESC LIMIT 5");
        $sql9->execute();
        $results9 = $sql9->fetchAll();

        $sql8 = $db->prepare("SELECT * FROM player_reddit ORDER BY timestamp DESC LIMIT 5;");
        $sql8->execute();
        $results8 = $sql8->fetchAll();

        return $this->render(
           'social_media/home.html.twig',
      	array(
		   'results1' => $results1,
		   'results2' => $results2,
           'results3' => $results3,
           'results4' => $results4,
           'results5' => $results5,
           'results6' => $results6,
           'results8' => $results8,
           'results9' => $results9
		)
        );
    }
}