<?php

namespace App\Controller;

use App\Services\ChuckNorris;
use App\Services\JokeApi;
// use App\Services\OfficialJokeApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JokesController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("ajax/jokes/fetchJokes", name="fetch_jokes", methods={"POST"})
     */
    public function fetchJokes(Request $request): JsonResponse
    {
        // CHECK IF THE POST METHOD HAS BEEN SUBMITTED. SYMFONY FRAMEWORK SHOULD BLOCK AND OTHER HEADER IF IT'S NOT A
        // POST METHOD
        if(!$_POST['joke_number']) {
            throw new \Exception("Bad Request", 400);
        }

        $num = (int)$_POST['joke_number'];

        // Get The Jokes From App\Services Located In src/Services Directory.
        $chuckNorris = ChuckNorris::fetchJokes($num);
        $jokeApi = JokeApi::fetchJokes($num);

        // Merge The Two Arrays To Provide One Data Source & Shuffle The Results.
        $array = array_merge($chuckNorris, $jokeApi);
        shuffle($array);

        // Return a JSON Content Type for AJAX To Display The Results.
        return $this->json(array_slice($array, 0, $num));
    }

    /**
     * @Route("ajax/jokes/addJokes", name="add_jokes", methods={"POST"})
     */
    public function addJokes()
    {
        // Todo: Submit data to the JokesAPI and also to the application
    }
}
