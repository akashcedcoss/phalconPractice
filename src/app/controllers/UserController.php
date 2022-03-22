<?php

use Phalcon\Mvc\Controller;


class UserController extends Controller
{
    public function IndexAction()
    {
        $this->view->users = Users::find();
    }
    
    public function signupAction()
    {
        $user = new Users();

        //assign value from the form to $user
        if($this->request->isPost()){
        $user->assign(
            $this->request->getPost(),
            [
                'name',
                'email',
                'password'
            ]
        );
    }

        

        // Store and check for errors
        $success = $user->save();

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $message = "Thanks for registering!";
            // echo $message;
        } else {
            $message = "Sorry, the following problems were generated:<br>"
                     . implode('<br>', $user->getMessages());
                    //  echo $message;
        }

        // passing a message to the view
        $this->view->message = $message;
    }


    
}