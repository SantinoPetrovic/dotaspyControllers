<?php
    // src/AppBundle/Controller/SearchController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class SearchController extends Controller {
    /**
    * @Route("/search/{searchValue}")
    */
    public function numberAction($searchValue) {
        require_once($this->getParameter('PDOpath'));

        //Twitter SQL call
        $sql1 = $db->prepare("SELECT * FROM player WHERE nickname LIKE :searchValue");
        $sql1->bindValue(':searchValue', "%".$searchValue."%");
        $sql1->execute();
        $results1 = $sql1->fetchAll();
        $searchValueObj = (object) array('searchValue' => $searchValue);
        $number = 0;
        foreach ($results1 as $amount) {
            $number++; 
        }
        $numberObj = (object) array('number' => $number);
        return $this->render(
           'social_media/search.html.twig',
           array(
            'results1' => $results1,
            'searchValueObj' => $searchValueObj,
            'numberObj' => $numberObj
            )
        );
    }
}