<?php
    // src/AppBundle/Controller/TwitterController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class SocialMediaController extends Controller {
    /**
    * @Route("/player/{playerID}/{playerNickName}")
    */
    public function numberAction($playerNickName, $playerID) {
        require_once($this->getParameter('PDOpath'));

        //Twitter SQL call
        $sql1 = $db->prepare("SELECT * FROM player_twitter, player WHERE player_twitter.player_ID = :playerID AND player.nickname = :playerNickName");
        $sql1->bindValue(':playerID', $playerID);
        $sql1->bindValue(':playerNickName', $playerNickName);
        $sql1->execute();
        $results1 = $sql1->fetchAll();
        if( count( array_filter( $results1)) == 0) {
            return $this->render(
               'social_media/404.html.twig'
            );
        }
        else {
            //Facebook and Twitch SQL call
            $sql2 = $db->prepare("SELECT facebook_id, twitch_id FROM player WHERE player_ID = :playerID AND nickname = :playerNickName");
            $sql2->bindValue(':playerID', $playerID);
            $sql2->bindValue(':playerNickName', $playerNickName);
            $sql2->execute();
            $results2 = $sql2->fetchAll();

            $sql3 = $db->prepare("SELECT * FROM player_wiki WHERE player_ID = :playerID");
            $sql3->bindValue(':playerID', $playerID);
            $sql3->execute();
            $results3 = $sql3->fetchAll();

            $sql4 = $db->prepare("SELECT * FROM player_matches WHERE playerID = :playerID ORDER BY match_timestamp DESC");
            $sql4->bindValue(':playerID', $playerID);
            $sql4->execute();
            $results4 = $sql4->fetchAll();

            $sql5 = $db->prepare("SELECT * FROM player WHERE player_ID = :playerID");
            $sql5->bindValue(':playerID', $playerID);
            $sql5->execute();
            $results5 = $sql5->fetchAll();

            $sql6 = $db->prepare("SELECT oddshot_link FROM player_oddshot WHERE player_ID = :playerID ORDER BY player_oddshot.oddshot_link DESC");
            $sql6->bindValue(':playerID', $playerID);
            $sql6->execute();
            $results6 = $sql6->fetchAll();

            $teamSql = $db->prepare("SELECT * FROM player_wiki WHERE player_ID = :playerID");
            $teamSql->bindValue(':playerID', $playerID);
            $teamSql->execute();
            $resultTeamSql = $teamSql->fetchAll();
            $team = $resultTeamSql[0]["team"];

            $sql7 = $db->prepare("SELECT * FROM tournaments WHERE team = :team");
            $sql7->bindValue(':team', $team);
            $sql7->execute();
            $results7 = $sql7->fetchAll();

            $sql8 = $db->prepare("SELECT * FROM player_reddit WHERE player_ID = :playerID ORDER BY timestamp DESC");
            $sql8->bindValue(':playerID', $playerID);
            $sql8->execute();
            $results8 = $sql8->fetchAll();

            $sql9 = $db->prepare("SELECT * FROM player_gosugamers WHERE player_ID = :playerID ORDER BY timestamp DESC");
            $sql9->bindValue(':playerID', $playerID);
            $sql9->execute();
            $results9 = $sql9->fetchAll();

            return $this->render(
               'social_media/social_media.html.twig',
               array(
                'results1' => $results1,
                'results2' => $results2,
                'results3' => $results3,
                'results4' => $results4,
                'results5' => $results5,
                'results6' => $results6,
                'results7' => $results7,
                'results8' => $results8,
                'results9' => $results9
                )
            );
        }
    }
}