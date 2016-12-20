<?php
    // src/AppBundle/Controller/AboutController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class AboutController extends Controller {
    /**
    * @Route("/about")
    */
    public function numberAction() {
        return $this->render(
           'social_media/about.html.twig'
        );
    }
}