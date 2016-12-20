<?php
    // src/AppBundle/Controller/TermsController.php
    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Response;

    class TermsController extends Controller {
    /**
    * @Route("/terms")
    */
    public function numberAction() {
        return $this->render(
           'social_media/terms.html.twig'
        );
    }
}