<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

/**
 * this class site controller all logics come ti class
 * @package  app\controllers;
 */


class  SiteController extends Controller
{

    /**
     * call home file
     *
     * @return void
     */
    public  function home()
    {
        $params = [
            'name' => "THeCodeholic"
        ];
        return $this->render('home', $params);
    }

/**
 * call contact file
 *
 * @return void
 */
    public  function Contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }

}
